<?php

namespace App\Http\Controllers\AdminController;
use App\Address;
use App\Booking;
use App\City;
use App\NurseJoinRequest;
use App\Patient;
use App\Photo;
use App\Reject;
use App\Service;
use App\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Comparator\Book;

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


    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function receipt($id){
        $patient = Patient::findOrFail($id);
        return view('admin.requests.patient.receipt', compact('patient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        //
        $services = Service::all();
        $cities = City::all();
        return view('admin.patients.create', compact('services', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //filter the data
        $data = $request->only(['patient_name', 'image', 'email','phone_no', 'age',
            'gender', 'address_id', 'family_members', 'guardian_name',
            'relation_guardian', 'shift', 'days', 'service_id',
            'patient_history', 'patient_doctor','permanent_city',
            'permanent_landmark','permanent_street','permanent_post','permanent_country',
            'permanent_pincode','permanent_police','permanent_state',]);

        //create a new user using mail
        $validateData = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_no' => ['required', 'min:10|numeric'],
        ]);

        $user = User::create([
            'name' => $data['patient_name'],
            'email' => $validateData['email'],
            'phone_no' => $validateData['phone_no'],
            'password' => Hash::make($data['phone_no']),
        ]);

        //if patient ha sany image
        if ($request->hasFile('image')) {
            $image = $request->image->store('users', 'public');
                $photo = Photo::create(['photo_location' => $image]);
                $user['photo_id'] = $photo->id;
        }


        //add address details in address table for user
        $current_address = Address::create(['user_id' => $user->id,
            'city' => $data['permanent_city'],
            'state' => $data['permanent_state'],
            'pin_code' => $data['permanent_pincode'],
            'country' => $data['permanent_country'],
            'landmark' => $data['permanent_landmark'],
            'street' => $data['permanent_street'],
            'police_station' => $data['permanent_police'],
            'post_office' => $data['permanent_post']

        ]);
        $permanent_address = Address::create(['user_id' => $user->id,
            'city' => $data['permanent_city'],
            'state' => $data['permanent_state'],
            'pin_code' => $data['permanent_pincode'],
            'country' => $data['permanent_country'],
            'landmark' => $data['permanent_landmark'],
            'street' => $data['permanent_street'],
            'police_station' => $data['permanent_police'],
            'post_office' => $data['permanent_post']
        ]);

        $user['current_address_id'] = $current_address->id;
        $user['permanent_address_id'] = $permanent_address->id;

        //Now create a new patient request
        $last = Patient::all()->last();
        if($last){
            $patient_id = 'P' . (1001 + $last->id);
        }else{
            $patient_id = 'P' . (1001);
        }

        Patient::create(['user_id' => $user->id,
            'patient_name' => $data['patient_name'],
            'patient_id' => $patient_id,
            'photo_id' => $photo->id,
            'phone_no' => $data['phone_no'],
            'age' => $data['age'],
            'gender' => $data['gender'],
            'address_id' => $permanent_address->id,
            'family_members' => $data['family_members'],
            'guardian_name' => $data['guardian_name'],
            'relation_guardian' => $data['relation_guardian'],
            'shift' => $data['shift'],
            'days' => $data['days'],
            'service_id' => $data['service_id'],
            'patient_history' => $data['patient_history'],
            'patient_doctor' => $data['patient_doctor']
        ]);


        // after all request are done save the changes to user table
        $user->save();


        return redirect()
            ->route('admin.patient.index')
            ->with('success','Patient created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //
        $patient = Patient::findOrFail($id);
        $user = User::findOrFail($patient->user_id);


        //delete photo
        Storage::disk('public')->delete($user->photo->photo_location);
        Storage::disk('public')->delete($patient->photo->photo_location);

        // delete user address
        Address::findOrFail($user->permanent_address_id)->delete();
        Address::findOrFail($user->current_address_id)->delete();

        

        //delete
        $user->delete();
        $patient->delete();

        return redirect()->back()
            ->with('success', 'Patient Record Deleted');

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

    /**
     * @param Patient $patient
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(Patient $patient)
    {
        $patient->status=1;

        $patient->save();
        session()->flash('success', 'Patient Approved');
        return redirect()->back();
    }


    public function money_receipt($id){
        $booking = Booking::where('patient_id', $id)->get()->first();
        return view('admin.patients.money-receipt', compact('booking'));
    }




}
