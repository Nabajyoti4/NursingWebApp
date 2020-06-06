<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Nurse;
use App\Qualification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminNurseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $nurses = Nurse::all();

        return view('admin.nurses.index', compact('nurses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.nurses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //retireve user id from request
        $user_id = $request->user_id;

        //find the user fro user model
        $user = User::findOrFail($user_id);

        // update the user role to nurse
        $user->update(['role' => 'nurse']);

        // reteive the values from request
        $data = $request->only(['nurse_age','pan_image', 'voter_image', 'adhar_image', 'license_image','qualification', 'other_qualification']);

        // create a employee id for nurse
        $last = Nurse::all()->last();
       if($last){
           $emp_id = 'E' . (1001 + $last->id);
        }else{
           $emp_id = 'E' . (1001);
       }

        // store the image in storage
        $directoy = Hash::make($emp_id.$user_id);
        $pan = $data['pan_image']->store($directoy, 'public');
        $voter = $data['voter_image']->store($directoy, 'public');
        $adhar = $data['adhar_image']->store($directoy, 'public');
        $license = $data['license_image']->store($directoy, 'public');
        $qualification= $data['qualification']->store($directoy, 'public');
        $other_qualification = $data['other_qualification']->store($directoy, 'public');





       // create a qualification details record for the new nurse in qualification table
       $qualification = Qualification::create(['pan_card' => $pan,
           'voter_card' => $voter,
           'adhar_card' => $adhar,
           'license_card' => $license,
           'qualification' => $qualification,
           'other_qualification' => $other_qualification]);

       $nurse_age = $data['nurse_age'];
       // create the new nurse record
       Nurse::create(['user_id' => $user_id,
           'employee_id' => $emp_id,
           'age' => $nurse_age,
           'qualification_id' => $qualification->id,
           ]);

       $nurses = Nurse::all();
       return redirect()
           ->route('admin.nurse.index', compact('nurses'))
           ->with('success','Nurse Created  successfully!');;;





    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $nurse = Nurse::findOrFail($id);
        return view('admin.nurses.edit', compact('nurse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
