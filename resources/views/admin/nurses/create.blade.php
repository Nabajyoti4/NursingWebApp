@extends('layouts.admin')
@section('title')
    Create Nurse
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
            background: white !important;
        }

        .borderdiv {
            position: relative;
            padding: 32px;
            border-radius: 10px;
            border: 2px solid #75b3e2;
            margin-top: 2rem;
        }
    </style>
@endsection

@section('content')

    <div class="container emp-profile mt-3">
        @include('partials.errors')
{{--        <form action="{{ route('admin.nusrse.update', $user->id) }}" method="POST" enctype="multipart/form-data">--}}
        <form action="">
            @csrf
            @method('PATCH')
            <div class="form-group font-weight-bold">
                <label for="name">Full Name:</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Name">
            </div>

            <div class="form-group font-weight-bold">
                <label for="phone_no">Phone Number:</label>
                <input type="number" class="form-control" name="phone_no" placeholder="Enter Phone number">
            </div>


            <div class="form-group font-weight-bold">
                <label for="image">Upload Profile Pic: </label>
                <input type="file" class="form-control-file" name="image">
            </div>


            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Permanent Address</label>
                <div class="row">
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="permanent_street" placeholder="Street name">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="permanent_landmark" placeholder="Landmark">
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
                        <input type="text" class="form-control" name="permanent_police" placeholder="Police station">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="permanent_post" placeholder="Post office">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="permanent_pincode" placeholder="Pin Code">
                    </div>
                </div>
            </div>

            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Current Address</label>
                <div class="row">
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="current_street" placeholder="Street name">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="current_landmark" placeholder="Landmark">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="current_city" placeholder="City">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="current_state" placeholder="State">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="current_country" placeholder="Country">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="current_police" placeholder="Police station">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="current_post" placeholder="Post office">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="current_pincode" placeholder="Pin Code">
                    </div>
                </div>
            </div>
            <div class="form-group font-weight-bold">
                <label for="pan_image">Pan card: </label>
                <input type="file" class="form-control-file" name="pan_image">
            </div>
            <div class="form-group font-weight-bold">
                <label for="aadhar_image">Aadhar card: </label>
                <input type="file" class="form-control-file" name="aadhar_image">
            </div>
            <div class="form-group font-weight-bold">
                <label for="voter_image">Voter ID card: </label>
                <input type="file" class="form-control-file" name="voter_image">
            </div>

            <div class="form-group font-weight-bold">
                <label for="license_image">License: </label>
                <input type="file" class="form-control-file" name="license_image">
            </div>
            <div class="form-group font-weight-bold">
                <label for="qualification">Highest Qualification Certificate: </label>
                <input type="file" class="form-control-file" name="qualification">
            </div>
            <br>
            <button class="btn btn-primary" type="submit">Create</button>

        </form>
    </div>

@endsection
