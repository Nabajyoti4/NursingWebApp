<?php

namespace App\Http\Controllers\AdminController;

use App\City;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class AdminEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $employees = Employee::latest()->paginate();
        $roles = Role::all();
        $cities = City::all();
        return view('admin.employees.index', compact('employees', 'roles', 'cities'));
    }



    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filter(Request $request){
        $data = $request->only('city', 'role');

        $employees = (new \App\Employee)->filter($data);

        $roles = Role::all();
        $cities = City::all();
        return view('admin.employees.index', compact('employees', 'roles', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //retireve user id from request
        $user_id = $request->user_id;

        // create a employee id for nurse
        if (Employee::all()->last()) {
            $last = Employee::all()->last();
            $emp_id = 'E' . (1001 + $last->id);
        } else {
            $emp_id = 'E' . (1001);
        }
        // create the new nurse record
        Employee::create(['user_id' => $user_id,
            'employee_id' => $emp_id
        ]);

        $employees = Employee::latest()->paginate();
        return redirect()
            ->route('admin.employee.index', compact('employees'))
            ->with('success', 'Employee Created Successfully!');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
