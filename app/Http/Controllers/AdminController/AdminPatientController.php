<?php

namespace App\Http\Controllers\AdminController;
use App\Patient;
use App\Reject;
use App\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AdminPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|
     */
    public function index()
    {
        //
        $search = request()->get('patient');

        if ($search){
            $patients = Patient::where("name","LIKE","%{$search}%")->get();
        }

        else{
            $patientAll = Patient::all();
            $patients = array();

            foreach ($patientAll as $patient) {
                if (($patient->getAddress()->city ) == (Auth::user()->addresses->first()->city)) {
                    array_push($patients, $patient);
                }
            }

        }

        return view('admin.requests.patient.index', compact('patients'));
    }

    /**
     *  patients that are approved
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function approved()
    {
        //
        $search = request()->get('patient');

        if ($search){
            $patients = Patient::all()
                ->where("name","LIKE","%{$search}%")
                ->where('status',1)
                ->get();
        }

        else{
            $patientAll = Patient::all();
            $patients = array();

            foreach ($patientAll as $patient) {
                if (($patient->getAddress()->city ) == (Auth::user()->addresses->first()->city)) {
                    array_push($patients, $patient);
                }
            }

        }

        return view('admin.patients.index', compact('patients'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $patient = Patient::findOrFail($id);
        return view('admin.requests.patient.show', compact('patient'));
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


    /**
     * to send reject message for nurse hire to user
     * @param Request $request
     */
    public function disapprove(Request $request, $id){

        $data = $request->only(['tag', 'reason']);

        $patient = Patient::findOrFail($id);

        $patient->status = 0;
        $patient->save();

        Reject::create(['patient_id' => $id,
            'tag' => $data['tag'],
            'reason' => $data['reason']]);

        $user = User::findOrFail($patient->user_id);

        Notification::send($user, new \App\Notifications\PatientRequestCancel($request, $patient));

        return redirect()->back();


    }

    // method approve the patient
    public function approve(Patient $patient)
    {
        $patient->status=1;
        $patient->save();
        session()->flash('success', 'Patient Approved');
        return redirect()->back();
    }



}
