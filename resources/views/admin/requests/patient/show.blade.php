@extends('layouts.admin')
@section('title')
    Patient Profile
@endsection

@section('links')
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <link href="{{asset('css/error.css')}}" rel="stylesheet">
@endsection

@section('style')
    <style>
        .header {
            position: absolute;
            top: -14px;
            left: 1%;
            padding: 0% 2px;
            margin: 0%;
            background: rgb(242, 247, 250) !important;
        }

        .font {
            display: inline-block;
            width: 8rem;
        }

        h4 {
            text-transform: initial;
        }

        span {
            font-size: 1.2rem;
            text-transform: capitalize;
        }

        .borderdiv {
            position: relative;
            top: -20px;
            padding: 1rem;

            border-radius: .2rem;
            border: .2rem solid #75b3e2;
            margin-top: 2rem;
        }
    </style>
@endsection

@section('content')
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Patient Details</h6>
        <span><b>Status:</b>
            @if($patient->status == 1)
                Approved
            @elseif($patient->status == 0)
                Disapproved
            @else
                Pending
            @endif</span>
    </div>

    <div class="container p-3">
        <div class="row bg-light">
            <div class="col-xs-12 col-lg-4">
                <img
                    src="{{ $patient->photo?asset("/storage/".$patient->photo->photo_location) :'http://placehold.it/64x64'}}"
                    width="70%" alt="avatar">
                <div class="pt-5">
                    <h3>{{$patient->patient_id}}</h3>
                    <hr>
                    <h3>{{$patient->patient_name}}</h3>
                    <hr>
                    <h4><i class="fas fa-mobile-alt"></i> {{$patient->phone_no}}</h4>
                    <hr>
                </div>
                <br>
            </div>
            <div class="col-xs-12 col-lg-6 ">
                <div class="borderdiv">
                    <h5 class="header font-weight-bold bg-light">Address</h5>
                    <div>
                        <h5 class="font">Street</h5>
                        <span>: {{$patient->user->address($patient->user->getCAddressId($patient->user->id))->street}}</span>
                    </div>
                    <div>
                        <h5 class="font">Landmark</h5>
                        <span>: {{$patient->user->address($patient->user->getCAddressId($patient->user->id))->landmark}}</span>
                    </div>
                    <div>
                        <h5 class="font">City</h5>
                        <span>: {{$patient->user->address($patient->user->getCAddressId($patient->user->id))->city}}</span>
                    </div>
                    <div>
                        <h5 class="font">State</h5>
                        <span>: {{$patient->user->address($patient->user->getCAddressId($patient->user->id))->state}}</span>
                    </div>
                    <div>
                        <h5 class="font">Country</h5>
                        <span>: {{$patient->user->address($patient->user->getCAddressId($patient->user->id))->country}}</span>
                    </div>
                    <div>
                        <h5 class="font">Pin Code</h5>
                        <span>: {{$patient->user->address($patient->user->getCAddressId($patient->user->id))->pin_code}}</span>
                    </div>
                </div>
                <div class="borderdiv">
                    <h5 class="header font-weight-bold bg-light">Booked By User</h5>
                    <h3>{{$patient->user->name}}</h3>
                    <h4><i class="fas fa-mobile-alt"></i> {{$patient->user->phone_no}}</h4>
                    <h4><i class="fas fa-envelope"></i> {{$patient->user->email}}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="borderdiv">
                    <h5 class="header font-weight-bold bg-light">Personal Details</h5>
                    <div>
                        <span><b>Age:</b> {{$patient->age}}</span>
                    </div>
                    <div>
                        <span><b>Gender:</b> {{$patient->gender}}</span>
                    </div>
                    <div>
                        <span><b>Total Family Member ( Both M/F):</b> {{$patient->family_members}}</span>
                    </div>
                    <div>
                        <span><b>Relation with the Guardian:</b> {{$patient->relation_guardian}}</span>
                    </div>
                    <div>
                        <span><b>Name of the Guardian:</b> {{$patient->guardian_name}}</span>
                    </div>
                    <div>
                        <span><b>Duty Shift of the Nurse:</b> {{$patient->shift}}</span>
                    </div>
                    <div>
                        <span><b>Service:</b> {{$patient->service->title}}</span>
                    </div>
                    <div>
                        <span><b>Period of Required (Days):</b> {{$patient->days}}</span>
                    </div>
                    <div>
                        <span><b>Patient's History:</b> {{$patient->patient_history}}</span>
                    </div>
                    <div>
                        <span><b>Doctor and Hospital:</b> {{$patient->patient_doctor}}</span>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                @if($patient->status !=1)
                    <form action="{{route('patient.approve',$patient->id)}}" method="post">
                        @csrf
                        <button class="btn btn-primary" type="submit">Approve</button>
                    </form>
                @endif
            </div>
        </div>
    </div>

@endsection
