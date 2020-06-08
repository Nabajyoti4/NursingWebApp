<?php

namespace App\Http\Controllers\Patient;

use App\Address;
use App\Http\Controllers\Controller;
use App\Patient;
use App\Service;
use Illuminate\Http\Request;


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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $services = Service::all();
        return view('patientapplication.index', compact('services'));
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
        $data = $request->only(['patient_name', 'photo_id', 'phone_no', 'age',
        'gender', 'address_id', 'family_members', 'guardian_name',
        'relation_guardian', 'shift', 'days', 'service_id',
        'patient_history', 'patient_doctor','permanent_city',
         'permanent_landmark','permanent_street','permanent_post','permanent_country',
            'permanent_pincode','permanent_police','permanent_state',]);

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


        Patient::create([
        ]);



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
