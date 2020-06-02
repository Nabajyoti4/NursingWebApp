@extends('layouts.home')
@section('title')
    Edit User
@endsection
@section('links')
    <!-- Theme CSS -->
    <link href="{{asset('css/navbar.css')}}" rel="stylesheet">
    <link href="{{asset('css/toolkit-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/application-startup.css')}}" rel="stylesheet">
    <!--  custom form style link -->
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
@endsection
@section('style')
    <style>
        .header {
            position: absolute;
            top: -14px;
            left: 1%;
            padding: 0% 2px;
            margin: 0%;
            background: white!important;
        }

        .borderdiv {
            position: relative;
            padding: 32px;
            border-radius: 2px;
            border: 2px solid #dde4ea;
            margin-top: 2rem;
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
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group font-weight-bold">
                    <label for="name">Full Name:</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Name"
                           value="{{$user->name}}">
                </div>

                <div class="form-group font-weight-bold">
                    <label for="phone_no">Phone Number:</label>
                    <input type="number" class="form-control" name="phone_no" placeholder="Enter Phone number"
                           value="{{$user->phone_no}}">
                </div>


                <div class="form-group font-weight-bold">
                    <label for="image">Upload Profile Pic: </label>
                    <input type="file" class="form-control" name="image">
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
                            <input type="text" class="form-control" name="current_district" placeholder="District">
                        </div>
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="current_state" placeholder="State">
                        </div>
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="current_country" placeholder="Country">
                        </div>
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="current_pincode" placeholder="Pin Code">
                        </div>
                    </div>
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
                            <input type="text" class="form-control" name="permanent_district" placeholder="District">
                        </div>
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="permanent_state" placeholder="State">
                        </div>
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="permanent_country" placeholder="Country">
                        </div>
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="permanent_pincode" placeholder="Pin Code">
                        </div>
                    </div>
                </div>
                <br>
                <button class="btn profile-edit-btn" type="submit">Update</button>

            </form>
        </div>
        </div>
@endsection
