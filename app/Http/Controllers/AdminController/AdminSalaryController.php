<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Nurse;
use App\Salary;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|
     */
    public function index()
    {
        $search = request()->get('search');
        $admin = Auth::user();
        $currentMonth = date('m');

        if ($search) {
            $nurses = Nurse::where("employee_id", $search)->get();
            $nurses_ids = array();
            foreach ($nurses as $nurse) {
                array_push($nurses_ids, $nurse->id);
            }
            $salariess = DB::table("salaries")
                ->whereRaw('MONTH(created_at) = ?', [$currentMonth])->whereIn('nurse_id', $nurses_ids)
                ->get();
            return view('admin.salary.search', compact('salariess'));
        } else {
            if ($admin->role == 'super') {
                //$days = Carbon::now()->daysInMonth;

                $nurses = Nurse::all();
                $pnurses = array();
                $tnurses = array();
                foreach ($nurses as $nurse) {
                    if ($nurse->permanent == 1) {
                        array_push($pnurses, $nurse->id);
                    } else {
                        array_push($tnurses, $nurse->id);
                    }
                }
                // permanent
                $psalaries = DB::table("salaries")
                    ->whereRaw('MONTH(created_at) = ?', [$currentMonth])->whereIn('nurse_id', $pnurses)
                    ->get();

                //temporary
                $tsalaries = DB::table("salaries")
                    ->whereRaw('MONTH(created_at) = ?', [$currentMonth])->whereIn('nurse_id', $tnurses)
                    ->get();
                return view('admin.salary.index', compact('psalaries', 'tsalaries'));
            } else {
                $nurses = Nurse::all();

                $pnurses = array();
                $tnurses = array();
                foreach ($nurses as $nurse) {
                    if (($nurse->user->addresses->first()->city) == ($admin->addresses->first()->city)) {
                        if ($nurse->permanent == 1) {
                            array_push($pnurses, $nurse->id);
                        } else {
                            array_push($tnurses, $nurse->id);
                        }
                    }
                }
                // permanent
                $psalaries = DB::table("salaries")
                    ->whereRaw('MONTH(created_at) = ?', [$currentMonth])->whereIn('nurse_id', $pnurses)
                    ->get();

                //temporary
                $tsalaries = DB::table("salaries")
                    ->whereRaw('MONTH(created_at) = ?', [$currentMonth])->whereIn('nurse_id', $tnurses)
                    ->get();
                return view('admin.salary.index', compact('psalaries', 'tsalaries'));

            }
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|
     */
    public
    function create($permanent)
    {
        if ($permanent == 0) {
            $nurses = Nurse::where('permanent', '0')->get();
        } else {
            $nurses = Nurse::where('permanent', 1)->get();
        }
        return view('admin.salary.create', compact('nurses', 'permanent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|
     */
    public
    function store(Request $request)
    {
        //get the data
        $data = $request->validate([
            'nurse_id' => 'required',
            'basic' => 'required',
            'full_day' => 'integer',
            'half_day' => 'integer',
            'special_allowance' => 'integer',
            'ta_da' => 'integer',
            'hra' => 'integer',
            'advance' => 'integer',
            'pf' => 'integer',
        ]);

        //find whether the nurse is permanent or temporary
        $nurse = Nurse::findOrFail($data['nurse_id']);
        //calculate per day rate
        $total_days = Carbon::now()->daysInMonth;

        $data['per_day_rate'] = ($data['basic'] / $total_days);
        //calculate the bonus
        $data['bonus'] = $data['basic'] * (2 / 100);
        //total payment for permanent nurse
        if ($nurse->permanent == 1) {
            $data['total'] = $data['per_day_rate'] * $data['full_day'] + $data['special_allowance'];
            //ESIC (4% of Total Salary)
            $data['esic'] = $data['basic'] * (4 / 100);

            $data['deduction'] = $data['hra'] + $data['bonus'] + $data['esic'] + $data['pf'] + $data['advance'];

        } else {
            $data['total'] = $data['per_day_rate'] * $data['full_day'] + $data['special_allowance'] + $data['ta_da']
                + ($data['half_day'] * ($data['per_day_rate'] / 2));

            //deduction payment
            $data['deduction'] = $data['hra'] + $data['bonus'] + $data['advance'];
        }
        $data['net'] = $data['total'] - $data['deduction'];
        //create salary entry for the nurse
        Salary::create($data);
        session()->flash('success', 'Data Created Successfully');
        return redirect()->route('admin.salary.salaries', $data['nurse_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param $timestamp
     * @return \Illuminate\Http\Response|
     */
    public
    function edit($id)
    {
        $salary = Salary::findOrFail($id)->get()->first();
        $nurse = Nurse::where('id', $salary->nurse_id)->get()->first();
        return view('admin.salary.edit', compact('salary', 'nurse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        //get the data
        $data = $request->validate([
            'nurse_id' => 'required',
            'basic' => 'required',
            'full_day' => 'integer',
            'half_day' => 'integer',
            'special_allowance' => 'integer',
            'ta_da' => 'integer',
            'hra' => 'integer',
            'advance' => 'integer',
            'pf' => 'integer',
        ]);
        $nurse = Nurse::findOrFail($data['nurse_id']);

        //salary
        $salary = Salary::findOrFail($id);
        //calculate per day rate
        $total_days = Carbon::now()->daysInMonth;
        $data['per_day_rate'] = ($data['basic'] / $total_days);
        //calculate the bonus
        $data['bonus'] = $data['basic'] * (2 / 100);
        //total payment for permanent nurse
        if ($nurse->permanent == 1) {
            $data['total'] = $data['per_day_rate'] * $data['full_day'] + $data['special_allowance'];
            //ESIC (4% of Total Salary)
            $data['esic'] = $data['basic'] * (4 / 100);

            $data['deduction'] = $data['hra'] + $data['bonus'] + $data['esic'] + $data['pf'] + $data['advance'];

        } else {
            $data['total'] = $data['per_day_rate'] * $data['full_day'] + $data['special_allowance'] + $data['ta_da']
                + ($data['half_day'] * ($data['per_day_rate'] / 2));

            //deduction payment
            $data['deduction'] = $data['hra'] + $data['bonus'] + $data['advance'];
        }


        //net payment
        $data['net'] = $data['total'] - $data['deduction'];


        //create salary entry for the nurse
        $salary->update($data);

        session()->flash('success', 'Data updated successfully');
        return redirect()->route('admin.salary.salaries', $data['nurse_id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }


    public
    function salaries($id)
    {
        $salaries = Salary::where('nurse_id', $id)->get();
        $nurse = Nurse::findOrFail($id);
        return view('admin.salary.temporary.salary', compact('salaries', 'nurse'));
    }

    /**
     * display temporary nurses
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public
    function temporarynurses()
    {

        $search = request()->get('temp');
        $admin = Auth::user();

        if ($search) {
            $nurses = Nurse::select('*')
                ->where("employee_id", "LIKE", "%{$search}%")
                ->where('permanent', 0)
                ->get();
            if ($admin->role == 'super') {
                return view('admin.nurses.index', compact('nurses'));
            } else {
                if ($nurses->isEmpty()) {
                    return view('admin.salary.temporary.index', compact('nurses'));
                } else {
                    $user = User::where('id', $nurses->first()->user_id)->first();

                    if (($user->addresses->first()->city) == ($admin->addresses->first()->city)) {
                        return view('admin.salary.temporary.index', compact('nurses'));
                    } else {
                        $nurses = collect([]);
                        return view('admin.salary.temporary.index', compact('nurses'));
                    }
                }
            }


        } else {
            if ($admin->role == 'super') {
                $nurses = Nurse::where('permanent', 0)->get();
                return view('admin.salary.temporary.index', compact('nurses'));
            } else {
                $nurseAll = Nurse::where('permanent', 0)->get();
                $nurses = array();

                foreach ($nurseAll as $nurse) {
                    if (($nurse->user->addresses->first()->city) == ($admin->addresses->first()->city)) {
                        array_push($nurses, $nurse);
                    }
                }
                return view('admin.salary.temporary.index', compact('nurses'));
            }
        }


    }

    /**
     * display permanent nurses
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public
    function permanentnurses()
    {
        $search = request()->get('perm');
        $admin = Auth::user();

        if ($search) {
            $nurses = Nurse::select('*')
                ->where("employee_id", "LIKE", "%{$search}%")
                ->where('permanent', 1)
                ->get();


            if ($admin->role == 'super') {
                return view('admin.salary.permanent.index', compact('nurses'));
            } else {
                if ($nurses->isEmpty()) {
                    return view('admin.salary.permanent.index', compact('nurses'));
                } else {
                    $user = User::where('id', $nurses->first()->user_id)->first();

                    if (($user->addresses->first()->city) == ($admin->addresses->first()->city)) {
                        return view('admin.salary.permanent.index', compact('nurses'));
                    } else {
                        $nurses = collect([]);
                        return view('admin.salary.permanent.index', compact('nurses'));
                    }
                }
            }


        } else {
            if ($admin->role == 'super') {
                $nurses = Nurse::where('permanent', 1)->get();
                return view('admin.salary.permanent.index', compact('nurses'));
            } else {
                $nurseAll = Nurse::where('permanent', 1)->get();
                $nurses = array();

                foreach ($nurseAll as $nurse) {
                    if (($nurse->user->addresses->first()->city) == ($admin->addresses->first()->city)) {
                        array_push($nurses, $nurse);
                    }
                }
                return view('admin.salary.permanent.index', compact('nurses'));
            }
        }

    }


}
