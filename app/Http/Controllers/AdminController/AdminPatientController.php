<?php

namespace App\Http\Controllers\AdminController;
use App\NurseJoinRequest;
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $admin = Auth::user();


            if($admin->role == 'super'){
                $patientAll = Patient::latest()->get();
                $ppatients = array();//pending
                $apatients = array();//approved
                $rpatients = array();//rejected
                foreach ($patientAll as $patient) {
                        if ($patient->status == 0){
                            array_push($rpatients, $patient);

                        }elseif ($patient->status == 1){
                            array_push($apatients, $patient);
                        }else{
                            array_push($ppatients, $patient);
                        }
                }
                return view('admin.requests.patient.index', compact('ppatients','apatients','rpatients'));

            }else{
                $patientAll = Patient::all();
                $ppatients = array();//pending
                $apatients = array();//approved
                $rpatients = array();//rejected
                foreach ($patientAll as $patient) {
                    if (($patient->getAddress()) == ($admin->addresses->first()->city)) {
                        if ($patient->status == 0){
                            array_push($rpatients, $patient);

                        }elseif ($patient->status == 1){
                            array_push($apatients, $patient);
                        }else{
                            array_push($ppatients, $patient);
                        }
                    }
                }
                return view('admin.requests.patient.index', compact('ppatients','apatients','rpatients'));
            }



    }

    /**
     *  patients that are approved
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function approved()
    {
        //
        $search = request()->get('patient');
        $admin = Auth::user();

        if ($search){
            $patients = Patient::select('*')
                ->where("patient_name","LIKE","%{$search}%")
                ->where('status',1)
                ->get();

            if($admin->role == 'super'){
                return view('admin.patients.index', compact('patients'));
            }else{
                // check if the collection have any data
                if($patients->isEmpty()){
                    return view('admin.patients.index', compact('patients'));
                }else{
                    // get the address of the requested PATIENT
                    // check if the address of the candidate is same as admin
                    if (($patients->first()->getAddress()) == ($admin->addresses->first()->city)) {
                        return view('admin.patients.index', compact('patients'));
                    }else{
                        $patients = collect([]);
                        return view('admin.patients.index', compact('patients'));
                    }
                }
            }

        }

        else{
            if($admin->role == 'super'){
                $patients = Patient::latest()->get();
                return view('admin.patients.index', compact('patients'));

            }else{
                $patientAll = Patient::all();
                $patients = array();

                foreach ($patientAll as $patient) {
                    if (($patient->getAddress()) == ($admin->addresses->first()->city)) {
                        array_push($patients, $patient);
                    }
                }

                return view('admin.patients.index', compact('patients'));
            }

        }

    }


    public function receipt($id){
        $patient = Patient::findOrFail($id);
        return view('admin.requests.patient.receipt', compact('patient'));
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
