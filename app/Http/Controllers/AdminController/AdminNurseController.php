<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Nurse;
use App\NurseQualification;
use App\Photo;
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
     * @return \Illuminate\Http\Response
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
        $pan_photo = $data['pan_image']->store($emp_id.$user_id, 'public');
        $voter_photo = $data['voter_image']->store($emp_id.$user_id, 'public');
        $adhar_photo = $data['adhar_image']->store($emp_id.$user_id, 'public');
        $license_photo = $data['license_image']->store($emp_id.$user_id, 'public');
        $qualification_photo = $data['qualification']->store($emp_id.$user_id, 'public');
        $other_qualification_photo = $data['other_qualification']->store($emp_id.$user_id, 'public');


        // hash the name to make it more secure
       $pan = time() . Hash::make($pan_photo);
       $voter = time() . Hash::make($voter_photo);
       $adhar = time() . Hash::make( $adhar_photo );
       $license = time() . Hash::make($license_photo);
       $qual = time() . Hash::make( $qualification_photo );
       $other_qual = time() . Hash::make($other_qualification_photo);



       // create a qualification details record for the new nurse in qualification table
       $qualification = NurseQualification::create(['pan_card' => $pan,
           'voter_card' => $voter,
           'adhar_card' => $adhar,
           'license_card' => $license,
           'qualification' => $qual,
           'other_qualification' => $other_qual]);

       $nurse_age = $data['nurse_age'];

       // create the new nurse record
       Nurse::create(['user_id' => $user_id,
           'age' => $nurse_age,
           'employee_id' => $emp_id,
           'qualification_id' => $qualification->id,
           ]);

       return view('admin.nurses.index')->with('success','Nurse Created  successfully!');;





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
        $user = User::findOrFail($id);
        return view('admin.nurses.create', compact('user'));
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
