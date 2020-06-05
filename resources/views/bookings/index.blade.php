@extends('layouts.home')
@section('title')
    Customer Application Form
@endsection
@section('links')
    <!-- Theme CSS -->
    <link href="{{asset('css/navbar.css')}}" rel="stylesheet">
    <link href="{{asset('css/toolkit-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/application-startup.css')}}" rel="stylesheet">
    <!--  custom form style link -->
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <link href="{{asset('css/error.css')}}" rel="stylesheet">

    <!--  fontawesome link -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
@endsection
@section('style')
    <style>
        .header {
            position: absolute;
            top: -14px;
            left: 1%;
            padding: 0% 2px;
            margin: 0%;
            background: white !important;
        }

        .borderdiv {
            position: relative;
            padding: 32px;
            border-radius: 10px;
            border: 2px solid #75b3e2;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
    </style>
@endsection
@section('content')

    <div class="container-fluid profile-bg">
        <!-- navbar start -->
    @include('partials.navbar')
    <!-- navbar ends -->
        <div class="p-4">
            <div class="container emp-profile mt-3">
                @include('partials.errors')
                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group font-weight-bold">
                        <label for="name">Patient Full Name:</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name"
                               value="">
                    </div>

                    <div class="form-group font-weight-bold">
                        <label for="phone_no">Phone Number:</label>
                        <input type="number" class="form-control" name="phone_no" placeholder="Enter Phone number"
                               value="">
                    </div>
                    <div class="form-group font-weight-bold">
                        <label for="age">Age:</label>
                        <input type="number" class="form-control" name="age" placeholder="Age"
                               value="">
                    </div>
                    <div class="form-group font-weight-bold">
                        <label for="gender">Gender:</label>
                        <input type="text" class="form-control" name="gender" placeholder="Gender"
                               value="">
                    </div>


                    <div class="borderdiv">
                        <label class="header font-weight-bold bg-light">Address</label>
                        <div class="row">
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control" name="permanent_street"
                                       placeholder="Street name">
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control" name="permanent_landmark"
                                       placeholder="Landmark">
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control" name="permanent_city" placeholder="city">
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control" name="permanent_state" placeholder="State">
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control" name="permanent_country" placeholder="Country">
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control" name="permanent_police"
                                       placeholder="Police station">
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control" name="permanent_post" placeholder="Post office">
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control" name="permanent_pincode"
                                       placeholder="Postal/Zip Code">
                            </div>
                        </div>
                    </div>
                    <div class="form-group font-weight-bold">
                        <label for="gender">Total Family Member ( Both M/F):</label>
                        <input type="text" class="form-control" name="gender" placeholder="Gender"
                               value="">
                    </div>
                    <div class="form-group font-weight-bold">
                        <label for="gender">Relation with the Guardian :</label>
                        <input type="text" class="form-control" name="gender"
                               value="">
                    </div>
                    <div class="form-group font-weight-bold">
                        <label for="gender">Name of the Guardian:</label>
                        <input type="text" class="form-control" name="gender"
                               value="">
                    </div>
                    <div class="form-group font-weight-bold">
                        <label for="shifts">Duty Shift of the Nurse:</label>
                        <select name="shifts" class="form-control">
                            <option value="">Day Shift</option>
                            <option value="">Night Shift</option>
                            <option value="">24 hours</option>
                        </select>
                    </div>
                    <div class="form-group font-weight-bold">
                        <label for="service">Service :</label>
                        <select name="service" class="form-control">
                            <option value="">Nursing Aide</option>
                            <option value="">Nursing Attendant</option>
                            <option value="">Others</option>
                        </select>
                    </div>
                    <div class="form-group font-weight-bold">
                        <label for="no_of_days">Period of Required (Days):</label>
                        <select name="no_of_days" class="form-control">
                            <option value="">30</option>
                            <option value="">60</option>
                            <option value="">other</option>
                        </select>
                    </div>
                    <div class="form-group font-weight-bold">
                        <label for="patients_history">Patient's History :</label>
                        <textarea name="patients_history" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group font-weight-bold">
                        <label for="doctots_and_hospital">Doctor and Hospital:</label>
                        <textarea name="doctots_and_hospital" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <br>
                    <button class="btn btn-primary" type="submit">Submit</button>

                </form>
            </div>
        </div>
@endsection
