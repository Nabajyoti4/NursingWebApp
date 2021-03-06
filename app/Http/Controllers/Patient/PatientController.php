<?php

namespace App\Http\Controllers\Patient;

use App\Address;
use App\City;
use App\Http\Controllers\Controller;
use App\Nurse;
use App\Patient;
use App\Photo;
use App\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;


class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        return view('patientapplication.index', compact('services', 'cities'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //
        $data = $request->only(['patient_name', 'photo_id', 'phone_no', 'age',
        'gender', 'address_id', 'family_members', 'guardian_name',
        'relation_guardian', 'shift', 'days', 'service_id',
        'patient_history', 'patient_doctor','permanent_city',
         'permanent_landmark','permanent_street','permanent_post','permanent_country',
            'permanent_pincode','permanent_police','permanent_state','office_location']);

        $user= Auth::user();


        // store the address of patient
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

        if($user->permanent_address_id === null){
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

            $user['current_address_id'] = $current_address->id;
            $user['permanent_address_id'] = $permanent_address->id;
        }

        // store the image
        $image = $request->image->store('patients', 'public');
        $photo = Photo::create(['photo_location' => $image]);

        //patient id
        $last = Patient::all()->last();

        if($last){
            $patient_id = 'P' . (1001 + $last->id);
        }else{
            $patient_id = 'P' . (1001);
        }
        // create a new record for patient
        $patient = Patient::create(['user_id' => $user->id,
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
            'patient_doctor' => $data['patient_doctor'],
            'office_location' => strtolower($data['office_location'])
        ]);



        // select all the admins to send the request to them
        $adminAll = User::where('role', 'admin')->get();

        //save user
        $user->save();

        $admins = array();
        foreach ($adminAll as $admin) {
            if($admin->addresses->first()->city == $patient->getAddress())
                array_push($admins, $admin);
        }

        //Notification::send($admins, new \App\Notifications\PatientRequest($patient));


        return redirect()
            ->route('users.index')
            ->with('patient','patient request sended successfully!');

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
