<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Nurse;
use App\Psalary;
use App\Tsalary;
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
        $serverDateTime = Carbon::now();
        $search = request()->get('search');
        $admin = Auth::user();
        $currentMonth = date('m');

        if ($search) {
            if (Nurse::where("employee_id", $search)->get()->isEmpty()) {
                $salariess = collect([]);
                return view('admin.salary.search', compact('salariess'));
            } else {
                $nurse = Nurse::where("employee_id", $search)->get()->first();

                if (Tsalary::where('nurse_id', $nurse->id)->get()->isNotEmpty()){
                    $salariess = Tsalary::whereMonth('created_at', $currentMonth)->whereYear('created_at', $serverDateTime->year)->where('nurse_id', $nurse->id)
                        ->get();
                }elseif (Psalary::where('nurse_id', $nurse->id)->get()->isNotEmpty()){
                    $salariess = Psalary::whereMonth('created_at', $currentMonth)->whereYear('created_at', $serverDateTime->year)->where('nurse_id', $nurse->id)
                        ->get();
                }else{
                    $salariess = collect([]);
                }
                return view('admin.salary.search', compact('salariess'));
            }

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
                $psalaries = Psalary::whereMonth('created_at', $currentMonth)->whereYear('created_at', $serverDateTime->year)->whereIn('nurse_id', $pnurses)
                    ->get();

                //temporary
                $tsalaries = Tsalary::whereMonth('created_at', $currentMonth)->whereYear('created_at', $serverDateTime->year)->whereIn('nurse_id', $tnurses)
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
                $psalaries = Psalary::whereMonth('created_at', $currentMonth)->whereYear('created_at', $serverDateTime->year)->whereIn('nurse_id', $pnurses)
                    ->get();

                //temporary
                $tsalaries = Tsalary::whereMonth('created_at', $currentMonth)->whereYear('created_at', $serverDateTime->year)->whereIn('nurse_id', $tnurses)
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
    public function create($permanent)
    {
        $admin = Auth::user();
        $nurses = array();
        if ($permanent == 0) {
            $nursesAll = Nurse::where('permanent', '0')->get();
            foreach ($nursesAll as $nurse) {
                if (($nurse->user->addresses->first()->city) == ($admin->addresses->first()->city)) {
                        array_push($nurses, $nurse);
                }}
        } else {
            $nursesAll = Nurse::where('permanent', 1)->get();
            foreach ($nursesAll as $nurse) {
                if (($nurse->user->addresses->first()->city) == ($admin->addresses->first()->city)) {
                        array_push($nurses, $nurse);
                }}
        }
        return view('admin.salary.create', compact('nurses', 'permanent'));
    }

    public function calculateTemporaryTotal($data)
    {
        $data['total'] = $data['per_day_rate'] * $data['full_day'] + $data['special_allowance'] + $data['ta_da'] + ($data['half_day'] * ($data['per_day_rate'] / 2));
        //deduction payment
        $data['deduction'] = $data['hra'] + $data['bonus'] + $data['advance'];
        $data['net'] = $data['total'] - $data['deduction'];
        return $data;
    }

    public function calculatePermanentTotal($data)
    {
        $data['total'] = $data['per_day_rate'] * $data['full_day'] + $data['special_allowance'];
        //ESIC (4% of Total Tsalary)
        $data['esic'] = $data['basic'] * (4 / 100);

        $data['deduction'] = $data['hra'] + $data['bonus'] + $data['esic'] + $data['pf'] + $data['advance'];
        $data['net'] = $data['total'] - $data['deduction'];
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|
     */
    public function store(Request $request)
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
//            'month_days' => 'integer',
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
            $data = $this->calculatePermanentTotal($data);
            //create salary entry for the nurse
            Psalary::create([
                'basic' => $data['basic'],
                'nurse_id' => $data['nurse_id'],
                'per_day_rate' => $data['per_day_rate'],
                'payable_days' => $data['full_day'],
                'special_allowance' => $data['special_allowance'],
                'hra' => $data['hra'],
                'esic' => $data['esic'],
                'pf' => $data['pf'],
                'bonus' => $data['bonus'],
                'advance' => $data['advance'],
                'total' => $data['total'],
                'deduction' => $data['deduction'],
                'net' => $data['net'],
                'month_days' => $total_days
            ]);
        } else {
            $data = $this->calculateTemporaryTotal($data);


            //create salary entry for the nurse
            Tsalary::create([
                'basic' => $data['basic'],
                'nurse_id' => $data['nurse_id'],
                'per_day_rate' => $data['per_day_rate'],
                'full_day' => $data['full_day'],
                'half_day' => $data['half_day'],
                'special_allowance' => $data['special_allowance'],
                'ta_da' => $data['ta_da'],
                'hra' => $data['hra'],
                'bonus' => $data['bonus'],
                'advance' => $data['advance'],
                'total' => $data['total'],
                'deduction' => $data['deduction'],
                'net' => $data['net']
            ]);
        }

        session()->flash('success', 'Data Created Successfully');
        return redirect()->route('admin.salary.salaries', $data['nurse_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function tedit($id)
    {
        $salary = Tsalary::where('id',$id)->get()->first();
        $nurse = Nurse::where('id', $salary->nurse_id)->get()->first();
        return view('admin.salary.temporary.edit', compact('salary', 'nurse'));
    }

    public function pedit($id)
    {
        $salary = Psalary::where('id',$id)->get()->first();
        $nurse = Nurse::where('id', $salary->nurse_id)->get()->first();
        return view('admin.salary.permanent.edit', compact('salary', 'nurse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function permanentUpdate(Request $request, $id)
    {
        //get the data
        $data = $request->validate([
            'nurse_id' => 'required',
            'basic' => 'required',
            'full_day' => 'integer',
            'special_allowance' => 'integer',
            'ta_da' => 'integer',
            'hra' => 'integer',
            'advance' => 'integer',
            'pf' => 'integer',
            'month_days' => 'integer',
        ]);
        //calculate per day rate
        $total_days = Carbon::now()->daysInMonth;
        $data['per_day_rate'] = ($data['basic'] / $total_days);
        //calculate the bonus
        $data['bonus'] = $data['basic'] * (2 / 100);
        //total payment for permanent nurse
        $data = $this->calculatePermanentTotal($data);
        //find the perticular addresss
        $psalary = Psalary::findOrFail($id);

        //net payment
        $data['net'] = $data['total'] - $data['deduction'];
        $psalary->update([
            'basic' => $data['basic'],
            'nurse_id' => $data['nurse_id'],
            'per_day_rate' => $data['per_day_rate'],
            'payable_days' => $data['full_day'],
            'special_allowance' => $data['special_allowance'],
            'hra' => $data['hra'],
            'esic' => $data['esic'],
            'pf' => $data['pf'],
            'bonus' => $data['bonus'],
            'advance' => $data['advance'],
            'total' => $data['total'],
            'deduction' => $data['deduction'],
            'net' => $data['net']
        ]);


        session()->flash('success', 'Data updated successfully');
        return redirect()->route('admin.salary.salaries', $data['nurse_id']);
    }

    public function temporaryUpdate(Request $request, $id)
    {  //get the data
        $data = $request->validate([
            'nurse_id' => 'required',
            'basic' => 'required',
            'per_day_rate' => 'integer',
            'full_day' => 'integer',
            'half_day' => 'integer',
            'special_allowance' => 'integer',
            'ta_da' => 'integer',
            'hra' => 'integer',
            'advance' => 'integer',
            'bonus' => 'integer',

            'month_days' => 'integer',
        ]);
        $data = $this->calculateTemporaryTotal($data);
        //salary
        $tsalary = Tsalary::findOrFail($id);
        $tsalary->update([
            'basic' => $data['basic'],
            'nurse_id' => $data['nurse_id'],
            'per_day_rate' => $data['per_day_rate'],
            'full_day' => $data['full_day'],
            'half_day' => $data['half_day'],
            'special_allowance' => $data['special_allowance'],
            'ta_da' => $data['ta_da'],
            'hra' => $data['hra'],
            'bonus' => $data['bonus'],
            'advance' => $data['advance'],
            'total' => $data['total'],
            'deduction' => $data['deduction'],
            'net' => $data['net']
        ]);

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


    public function salaries($id)
    {
        $psalaries = Psalary::where('nurse_id', $id)->get();
        $tsalaries = Tsalary::where('nurse_id', $id)->get();
        $nurse = Nurse::findOrFail($id);
        if ($nurse->permanent == 1) {
            return view('admin.salary.permanent.salary', compact('psalaries', 'tsalaries', 'nurse'));
        } else {
            return view('admin.salary.temporary.salary', compact('psalaries', 'tsalaries', 'nurse'));
        }
    }

    /**
     * display temporary nurses
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function temporarynurses()
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
    public function permanentnurses()
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
