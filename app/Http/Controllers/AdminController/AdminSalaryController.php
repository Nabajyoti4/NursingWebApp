<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Nurse;
use App\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $days = Carbon::now()->daysInMonth;
        dd($days);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($permanent)
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
     * @return \Illuminate\Http\Response
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
            'esic' => 'integer',
            'pf' => 'integer',
        ]);
        //calculate per day rate
        $total_days = Carbon::now()->daysInMonth;
        $data['per_day_rate'] = ($data['basic'] / $total_days);
        //total payment
        $data['total'] = $data['per_day_rate'] * $data['full_day'] + $data['special_allowance'] + $data['ta_da']
            + ($data['half_day'] * ($data['per_day_rate'] / 2));
        //calculate the bonus
        $data['bonus'] = $data['basic'] * (2/100);

        //deduction payment
        $data['deduction'] = $data['hra'] + $data['bonus'] + $data['advance'];
        //net payment
        $data['net'] = $data['total'] - $data['deduction'];

        //create salary entry for the nurse
        Salary::create($data);

        return redirect()->route('admin.salary.salaries',$data['nurse_id']);
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salary = Salary::findOrFail($id)->get()->first();
        $nurse = Nurse::where('id',$salary->nurse_id)->get()->first();
        $permanent = 0;
        return view('admin.salary.edit',compact('salary','nurse','permanent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
            'esic' => 'integer',
            'pf' => 'integer',
        ]);
        //salary
        $salary = Salary::findOrFail($id);
        //calculate per day rate
        $total_days = Carbon::now()->daysInMonth;
        $data['per_day_rate'] = ($data['basic'] / $total_days);
        //total payment
        $data['total'] = $data['per_day_rate'] * $data['full_day'] + $data['special_allowance'] + $data['ta_da']
            + ($data['half_day'] * ($data['per_day_rate'] / 2));
        //calculate the bonus
        $data['bonus'] = $data['basic'] * (2/100);

        //deduction payment
        $data['deduction'] = $data['hra'] + $data['bonus'] + $data['advance'];
        //net payment
        $data['net'] = $data['total'] - $data['deduction'];

        //create salary entry for the nurse
        $salary->update($data);

        return redirect()->route('admin.salary.salaries',$data['nurse_id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

//$days = Carbon::now()->daysInMonth;
    public function temporarynurses()
    {
        $nurses = Nurse::where('permanent', 0)->get();
        return view('admin.salary.temporary.index', compact('nurses'));

    }

    public function salaries($id)
    {
        $salaries = Salary::where('nurse_id', $id)->get();
        $nurse = Nurse::findOrFail($id);
        return view('admin.salary.temporary.salary', compact('salaries', 'nurse'));

    }
}
