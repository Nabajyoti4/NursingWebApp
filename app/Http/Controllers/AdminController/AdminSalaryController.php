<?php

namespace App\Http\Controllers\AdminController;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Nurse;
use App\Psalary;
use App\Tsalary;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $serverDateTime = Carbon::now();
        $lastMonth =  $serverDateTime->subMonth()->format('Y-m');

        $search = request()->get('search');
        $searchMonth = request()->get('searchMonth');
        $admin = Auth::user();
        $currentMonth = date('m');

        if ($search) {
            if (Nurse::where("employee_id", $search)->get()->isEmpty()) {
                $salariess = collect([]);
                return view('admin.salary.search', compact('salariess','lastMonth'));
            } else {
                $nurse = Nurse::where("employee_id", $search)->get()->first();

                if (Tsalary::where('nurse_id', $nurse->employee_id)->get()->isNotEmpty()) {
                    $salariess = Tsalary::where('month_days', $lastMonth)->where('nurse_id', $nurse->employee_id)
                        ->get();
                } elseif (Psalary::where('nurse_id', $nurse->id)->get()->isNotEmpty()) {
                    $salariess = Psalary::where('month_days', $lastMonth)->where('nurse_id', $nurse->employee_id)
                        ->get();
                } else {
                    $salariess = collect([]);
                }
                return view('admin.salary.search', compact('salariess','lastMonth'));
            }

        } else {
            if ($admin->role == 'super') {
                //$days = Carbon::now()->daysInMonth;
                $nurses = Nurse::all();
                $pnurses = array();
                $tnurses = array();
                foreach ($nurses as $nurse) {
                    if ($nurse->permanent == 1) {
                        array_push($pnurses, $nurse->employee_id);
                    } else {
                        array_push($tnurses, $nurse->employee_id);
                    }
                }
                if ($searchMonth) {

                    // permanent
                    $psalaries = Psalary::where('month_days', $searchMonth)
                        ->get();

                    //temporary
                    $tsalaries = Tsalary::where('month_days', $searchMonth)
                        ->get();

                    $lastMonth=Carbon::create($searchMonth)->format('F');
                    return view('admin.salary.index', compact('psalaries', 'tsalaries','lastMonth'));
                }

                // permanent
                $psalaries = Psalary::where('month_days', $lastMonth)->whereYear('created_at', $serverDateTime->year)
                    ->get();

                //temporary
                $tsalaries = Tsalary::where('month_days', $lastMonth)->whereYear('created_at', $serverDateTime->year)
                    ->get();
                return view('admin.salary.index', compact('psalaries', 'tsalaries','lastMonth'));
            } else {
                $nurses = Nurse::all();

                $pnurses = array();
                $tnurses = array();
                foreach ($nurses as $nurse) {
                    if (($nurse->user->addresses->first()->city) == ($admin->addresses->first()->city)) {
                        if ($nurse->permanent == 1) {
                            array_push($pnurses, $nurse->employee_id);
                        } else {
                            array_push($tnurses, $nurse->employee_id);
                        }
                    }
                }
                if ($searchMonth) {

                    // permanent
                    $psalaries = Psalary::where('month_days', $searchMonth)->whereYear('created_at', Carbon::create($searchMonth)->year)->whereIn('nurse_id', $tnurses)
                        ->get();

                    //temporary
                    $tsalaries = Tsalary::where('month_days', $searchMonth)->whereYear('created_at', Carbon::create($searchMonth)->year)->whereIn('nurse_id', $tnurses)
                        ->get();
                    $lastMonth=Carbon::create($searchMonth)->format('F');

                    return view('admin.salary.index', compact('psalaries', 'tsalaries','lastMonth'));
                }
                // permanent
                $psalaries = Psalary::where('month_days', $lastMonth)->whereYear('created_at', $serverDateTime->year)->whereIn('nurse_id', $tnurses)
                    ->get();

                //temporary
                $tsalaries = Tsalary::where('month_days', $lastMonth)->whereYear('created_at', $serverDateTime->year)->whereIn('nurse_id', $tnurses)
                    ->get();

                return view('admin.salary.index', compact('psalaries', 'tsalaries','lastMonth'));

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
                array_push($nurses, $nurse);
            }
        } else {
            $nursesAll = Nurse::where('permanent', 1)->get();
            $employeeAll = Employee::all();
            foreach ($nursesAll as $nurse) {
                array_push($nurses, $nurse);
            }
            foreach ($employeeAll as $emp) {
                array_push($nurses, $emp);
            }
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
        $data['total'] = $data['per_day_rate'] * $data['full_day'] + $data['special_allowance'] + $data['ta_da'] + ($data['half_day'] * ($data['per_day_rate'] / 2));
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
            'full_day' => 'nullable|integer',
            'half_day' => 'nullable|integer',
            'special_allowance' => 'nullable|integer',
            'ta_da' => 'nullable|integer',
            'hra' => 'nullable|integer',
            'advance' => 'nullable|integer',
            'pf' => 'integer',
            'month_days' => 'required',
            'payment_mode' => 'nullable|string',
            'shift' => 'nullable|string',
            'area' => 'nullable|string',
        ]);
        if (Employee::where('employee_id', 'like', "{$data["nurse_id"]}%")->get()->first()) {
            $permanent = 1;

        }  if (Nurse::where('employee_id', $data["nurse_id"])->get()->first())  {
        //find whether the nurse is permanent or temporary
        $nurse = Nurse::where('employee_id', $data['nurse_id'])->get()->first();
        $permanent = $nurse->permanent;
    }

        //calculate per day rate

        $total_days = Carbon::create($data['month_days'])->daysInMonth;


        $data['per_day_rate'] = ($data['basic'] / $total_days);
        //calculate the bonus
        $data['bonus'] = $data['basic'] * (2 / 100);
        //total payment for permanent nurse
        if ($permanent == 1) {
            $data = $this->calculatePermanentTotal($data);
            //create salary entry for the nurse
            Psalary::create([
                'basic' => $data['basic'],
                'nurse_id' => $data['nurse_id'],
                'month_days' => $data['month_days'],
                'per_day_rate' => $data['per_day_rate'],
                'full_day' => $data['full_day'],
                'half_day' => $data['half_day'],
                'special_allowance' => $data['special_allowance'],
                'hra' => $data['hra'],
                'esic' => $data['esic'],
                'pf' => $data['pf'],
                'bonus' => $data['bonus'],
                'advance' => $data['advance'],
                'total' => $data['total'],
                'deduction' => $data['deduction'],
                'net' => $data['net'],
                'payment_mode' => $data['payment_mode'],
                'shift' => $data['shift'],
                'area'=>$data['area'],
            ]);
        } else {
            $data = $this->calculateTemporaryTotal($data);

            //create salary entry for the nurse
            Tsalary::create([
                'basic' => $data['basic'],
                'nurse_id' => $data['nurse_id'],
                'month_days' => $data['month_days'],
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
                'net' => $data['net'],
                'payment_mode' => $data['payment_mode'],
                'shift' => $data['shift'],
                'area'=>$data['area'],
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
        $salary = Tsalary::where('id', $id)->get()->first();
        $nurse = Nurse::where('id', $salary->nurse_id)->get()->first();
        return view('admin.salary.temporary.edit', compact('salary', 'nurse'));
    }

    public function pedit($id)
    {
        $salary = Psalary::where('id', $id)->get()->first();
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
            'half_day' => 'integer',
            'special_allowance' => 'nullable|integer',
            'ta_da' => 'nullable|integer',
            'hra' => 'nullable|integer',
            'advance' => 'integer',
            'pf' => 'integer',
            'month_days' => 'date',
            'remarks' => 'nullable|string',
            'area' => 'nullable|string',
            'payment_received_date' => 'nullable|string',
            'payment_mode' => 'nullable|string',
            'shift' => 'nullable|string',
        ]);
        //calculate per day rate

        $total_days = Carbon::create($data['month_days'])->daysInMonth;

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
            'month_days' => $data['month_days'],
            'per_day_rate' => $data['per_day_rate'],
            'full_day' => $data['full_day'],
            'half_day' => $data['half_day'],
            'special_allowance' => $data['special_allowance'],
            'hra' => $data['hra'],
            'ta_da' => $data['ta_da'],
            'esic' => $data['esic'],
            'pf' => $data['pf'],
            'bonus' => $data['bonus'],
            'advance' => $data['advance'],
            'total' => $data['total'],
            'deduction' => $data['deduction'],
            'net' => $data['net'],
            'area' => $data['area'],
            'remarks' => $data['remarks'],
            'payment_received_date' => $data['payment_received_date'],
            'payment_mode' => $data['payment_mode'],
            'shift' => $data['shift'],


        ]);


        session()->flash('success', 'Data updated successfully');
        return redirect()->route('admin.salary.salaries', $data['nurse_id']);
    }

    public function temporaryUpdate(Request $request, $id)
    {  //get the data
        $data = $request->validate([
            'nurse_id' => 'required',
            'basic' => 'required',
            'month_days' => 'date',
            'per_day_rate' => 'integer',
            'full_day' => 'integer',
            'half_day' => 'integer',
            'special_allowance' => 'nullable|integer',
            'ta_da' => 'nullable|integer',
            'hra' => 'nullable|integer',
            'advance' => 'nullable|integer',
            'bonus' => 'integer',
            'remarks' => 'nullable|string',
            'area' => 'nullable|string',
            'payment_received_date' => 'nullable|string',
            'payment_mode' => 'nullable|string',
            'shift' => 'nullable|string',
        ]);

        $total_days = Carbon::create($data['month_days'])->daysInMonth;


        $data['per_day_rate'] = ($data['basic'] / $total_days);
        //calculate the bonus
        $data['bonus'] = $data['basic'] * (2 / 100);

        $data = $this->calculateTemporaryTotal($data);
        //salary
        $tsalary = Tsalary::findOrFail($id);
        $tsalary->update([
            'basic' => $data['basic'],
            'nurse_id' => $data['nurse_id'],
            'month_days' => $data['month_days'],
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
            'net' => $data['net'],
            'area' => $data['area'],
            'remarks' => $data['remarks'],
            'payment_received_date' => $data['payment_received_date'],
            'payment_mode' => $data['payment_mode'],
            'shift' => $data['shift'],

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


    public function salaries($employee_id)
    {
        $psalaries = Psalary::where('nurse_id', $employee_id)->get();
        $tsalaries = Tsalary::where('nurse_id', $employee_id)->get();
        if (Nurse::where('employee_id', $employee_id)->get()->first()) {
            $nurse = Nurse::where('employee_id', $employee_id)->get()->first();
            $permanent = $nurse->permanent;

        }
        if (Employee::where('employee_id', 'like', "{$employee_id}%")->get()->first()) {
            $nurse=Employee::where('employee_id', $employee_id)->get()->first();
            $permanent = 1;


        }

        if ($permanent == 1) {
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
        $emps=collect([]);
        if ($search) {
            $nurses = Nurse::select('*')
                ->where("employee_id", "LIKE", "%{$search}%")
                ->where('permanent', 1)
                ->get();


            if ($admin->role == 'super') {
                return view('admin.salary.permanent.index', compact('nurses','emps'));
            } else {
                if ($nurses->isEmpty()) {
                    return view('admin.salary.permanent.index', compact('nurses','emps'));
                } else {
                    $user = User::where('id', $nurses->first()->user_id)->first();

                    if (($user->addresses->first()->city) == ($admin->addresses->first()->city)) {
                        return view('admin.salary.permanent.index', compact('nurses','emps'));
                    } else {
                        $nurses = collect([]);
                        return view('admin.salary.permanent.index', compact('nurses','emps'));
                    }
                }
            }


        } else {
            if ($admin->role == 'super') {
                $nurses = Nurse::where('permanent', 1)->get();
                $emps = Employee::all();
                return view('admin.salary.permanent.index', compact('nurses','emps'));
            } else {
                $nurseAll = Nurse::where('permanent', 1)->get();
                $nurses = array();

                foreach ($nurseAll as $nurse) {
                    if (($nurse->user->addresses->first()->city) == ($admin->addresses->first()->city)) {
                        array_push($nurses, $nurse);
                    }
                }
                return view('admin.salary.permanent.index', compact('nurses','emps'));
            }
        }

    }

    public function Tinovice($employee_id)
    {
        $salary = Tsalary::findOrFail($employee_id);
        return view('admin.salary.temporary.invoice', compact('salary'));
    }

    public function Pinovice($employee_id)
    {
        $salary = Psalary::findOrFail($employee_id);
        return view('admin.salary.temporary.invoice', compact('salary'));
    }
    public function Tdestroy($id){
        Tsalary::findOrFail($id)->delete();
        return redirect()->back()->with('success','deleted');

    }
    public function Pdestroy($id){
        Psalary::findOrFail($id)->delete();
        return redirect()->back()->with('success','deleted');

    }

    public function nurseSalaryFinder($id){

        if(Employee::where('employee_id',$id)->get()->first()){
            $nurse = Employee::where('employee_id',$id)->get()->first();
            $salary = Psalary::where('nurse_id',$nurse->employee_id)->latest()->get()->first();
            return $salary;
        }else{
            $nurse = Nurse::where('employee_id',$id)->get()->first();
            //temporary
            if ($nurse->permanent == 0){
                $salary = Tsalary::where('nurse_id',$nurse->employee_id)->latest()->get()->first();
                return $salary;
            }else{
                $salary = Psalary::where('nurse_id',$nurse->employee_id)->latest()->get()->first();
                return $salary;
            }
        }
    }
}
