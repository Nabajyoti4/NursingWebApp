@extends('layouts.home')

@section('title')
    Nurse Profile
@endsection

@section('links')
    <!-- Theme CSS -->
    <link href="{{asset('css/navbar.css')}}" rel="stylesheet">
    <link href="{{asset('css/toolkit-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/application-startup.css')}}" rel="stylesheet">
    <!--  custom form style link -->
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <!--  fontawesome link -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

@endsection

@section('style')
    <style>
        span {
            text-transform: capitalize;
        }

        .header {
            position: absolute;
            top: -13px;
            left: 0%;
            padding: 0% 2px;
            margin: 0%;
            background: #fff;
        }

        .borderdiv {
            position: relative;
            padding-top: 1rem;
            border-radius: 2px;
            border-top: 2px solid #4883b6;
            margin-top: 2rem;
        }

        .font {
            display: inline-block;
            width: 102px;
        }

    </style>
@endsection
@section('content')
    <div class="container-fluid profile-bg">
        @include('partials.navbar')
        <div class="container p-3">
            <div class="row p-5 bg-light">
                <div class="col-xs-12 col-lg-4">
                    <img src="{{asset('/storage/'.$user->photo->photo_location)}}" class="avatar img-thumbnail" width="250px"
                         alt="avatar">
                    <div class="pt-5">
                        <h3>{{$user->name}}</h3>
                        <hr>
                        <h4><i class="fas fa-mobile-alt"></i> {{$user->phone_no}}</h4>
                        <hr>
                        <h4><i class="fas fa-envelope"></i> {{$user->email}}</h4>
                    </div>

                </div>
                <div class="col-xs-12 col-lg-6 ">
                    <div class="bg-light">
                        <div class="borderdiv">

                            <h5 class="header font-weight-bold bg-light">Qualification</h5>
                            <div>
                                <h5>HSLC</h5>
                            </div>
                            <hr>
                            <div>
                                <h5>HS</h5>
                            </div>
                            <hr>
                            <div>
                                <h5>NURSING</h5>
                            </div>

                        </div>
                        <div class="borderdiv">
                            <h5 class="header font-weight-bold bg-light">Current Address</h5>
                            <div>
                                <h5 class="font">Street</h5>
                                <span>:{{$user->addresses->last() ? $user->addresses->last()->street : "Fill the current Address"}}</span>
                            </div>
                            <div>
                                <h5 class="font">Landmark</h5>
                                <span>:{{$user->addresses->last() ? $user->addresses->last()->landmark : "Fill the current Address"}}</span>
                            </div>
                            <div>
                                <h5 class="font">City</h5>
                                <span>:{{$user->addresses->last() ? $user->addresses->last()->city : "Fill the current Address"}}</span>
                            </div>
                            <div>
                                <h5 class="font">State</h5>
                                <span>:{{$user->addresses->last() ? $user->addresses->last()->state : "Fill the current Address"}}</span>
                            </div>
                            <div>
                                <h5 class="font">Country</h5>
                                <span>:{{$user->addresses->last() ? $user->addresses->last()->country : "Fill the current Address"}}</span>
                            </div>
                            <div>
                                <h5 class="font">Pin Code</h5>
                                <span>:{{$user->addresses->last() ? $user->addresses->last()->pin_code : "Fill the current Address"}}</span>
                            </div>
                        </div>
                        <div class="borderdiv">
                            <h5 class="header font-weight-bold bg-light">Permanent Address</h5>
                            <div>
                                <h5 class="font">Street</h5>
                                <span>:{{$user->addresses->first() ? $user->addresses->first()->street : "Fill the Permanent Address"}}</span>
                            </div>
                            <div>
                                <h5 class="font">Landmark</h5>
                                <span>:{{$user->addresses->first() ? $user->addresses->first()->landmark : "Fill the Permanent Address"}}</span>
                            </div>
                            <div>
                                <h5 class="font">City</h5>
                                <span>:{{$user->addresses->first() ? $user->addresses->first()->city : "Fill the Permanent Address"}}</span>
                            </div>
                            <div>
                                <h5 class="font">State</h5>
                                <span>:{{$user->addresses->first() ? $user->addresses->first()->state : "Fill the Permanent Address"}}</span>
                            </div>
                            <div>
                                <h5 class="font">Country</h5>
                                <span>:{{$user->addresses->first() ? $user->addresses->first()->country : "Fill the Permanent Address"}}</span>
                            </div>
                            <div>
                                <h5 class="font">Pin Code</h5>
                                <span>:{{$user->addresses->first() ? $user->addresses->first()->pin_code : "Fill the Permanent Address"}}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
