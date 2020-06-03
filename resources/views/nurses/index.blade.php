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
            border-top: 2px solid #dde4ea;
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
                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-thumbnail" width="250px"
                     alt="avatar">
                <div class="pt-5">
                    <h3>Raju Moni Borah</h3>
                    <h4>{Phone Number}</h4>
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
                            <h5 class="font">Street</h5><span>:</span>
                        </div>
                        <div>
                            <h5 class="font">Landmark</h5><span>:</span>
                        </div>
                        <div>
                            <h5 class="font">District</h5><span>:</span>
                        </div>
                        <div>
                            <h5 class="font">State</h5><span>:</span>
                        </div>
                        <div>
                            <h5 class="font">Country</h5><span>:</span>
                        </div>
                        <div>
                            <h5 class="font">Pin Code</h5><span>:</span>
                        </div>
                    </div>
                    <div class="borderdiv">
                        <h5 class="header font-weight-bold bg-light">Permanent Address</h5>
                        <div>
                            <h5 class="font">Street</h5><span>:</span>
                        </div>
                        <div>
                            <h5 class="font">Landmark</h5><span>:</span>
                        </div>
                        <div>
                            <h5 class="font">District</h5><span>:</span>
                        </div>
                        <div>
                            <h5 class="font">State</h5><span>:</span>
                        </div>
                        <div>
                            <h5 class="font">Country</h5><span>:</span>
                        </div>
                        <div>
                            <h5 class="font">Pin Code</h5><span>:</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
