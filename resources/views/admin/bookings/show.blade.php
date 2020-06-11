@extends('layouts.admin')
@section('title')
    Nurse Profile
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
            width: 105px;
        }

        h4 {
            text-transform: initial;
        }

        span {
            text-transform: capitalize;
        }

        .borderdiv {
            position: relative;
            top: -20px;
            padding: 32px;

            border-radius: 10px;
            box-shadow: 10px 10px 5px #aaaaaa;
            margin-top: 2rem;
        }

    </style>
@endsection

@section('content')
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Booking Details Of {{$book->patient->patient_name}}</h6>
    </div>

    <div class="p-4">
        <div class="container emp-profile mt-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img
                            src="{{ $book->patient->photo_id?asset("/storage/".$book->patient->photo->photo_location) :'http://placehold.it/64x64'}}"
                            width="100%" alt="avatar">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5>
                            {{$book->patient->patient_name}}
                        </h5>
                        <h6>
                            {{"Role"}}
                        </h6>
                        <ul class="nav nav-tabs pt-5" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="false">User Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="nurse-tab" data-toggle="tab" href="#nurse" role="tab" aria-controls="nurse" aria-selected="false">Nurse Alloted Details</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('users.edit', $book->id) }}" style="text-decoration: none">
                        <div  class="profile-edit-btn text-center">Edit Profile</div>
                    </a>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12 p-5">
                    <div class="tab-content profile-tab" id="myTabContent">

                        <!--Patient info-->
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$book->patient->patient_name}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$book->patient->patient_name}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Phone</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$book->patient->patient_name}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Permanent Address</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$book->patient->address_id? $book->patient->getAddress(): "Fill the Permanent Address"}}</p>
                                </div>
                            </div>

                        </div>

                        <!--client or User info-->
                        <div class="tab-pane fade" id="user" role="tabpanel" aria-labelledby="user-tab">



                        </div>

                        <!--Nurse Allotef for patient info-->
                        <div class="tab-pane fade" id="nurse" role="tabpanel" aria-labelledby="nurse-tab">



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
