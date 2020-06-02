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
            background: white!important;
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
                    <label class="header font-weight-bold bg-light">Permanent Address</label>
                    <div class="row">
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="permanent_street" placeholder="Street name"
                                   value="{{$user->addresses->first() ? $user->addresses->first()->street : ""}}">
                        </div>
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="permanent_landmark" placeholder="Landmark"
                                   value="{{$user->addresses->first() ? $user->addresses->first()->landmark : ""}}">
                        </div>
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="permanent_city" placeholder="city"
                                   value="{{$user->addresses->first() ? $user->addresses->first()->city : ""}}">
                        </div>
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="permanent_state" placeholder="State"
                                   value="{{$user->addresses->first() ? $user->addresses->first()->state : ""}}">
                        </div>
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="permanent_country" placeholder="Country"
                                   value="{{$user->addresses->first() ? $user->addresses->first()->country : ""}}">
                        </div>
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="permanent_police" placeholder="Police station"
                                   value="{{$user->addresses->first() ? $user->addresses->first()->police_station : ""}}">
                        </div>
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="permanent_post" placeholder="Post office"
                                   value="{{$user->addresses->first() ? $user->addresses->first()->post_office : ""}}">
                        </div>
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="permanent_pincode" placeholder="Pin Code"
                                   value="{{$user->addresses->first() ? $user->addresses->first()->pin_code : ""}}">
                        </div>
                    </div>
                </div>

                <div class="borderdiv">
                    <label class="header font-weight-bold bg-light">Current Address</label>
                    <div class="row">
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="current_street" placeholder="Street name"
                                   value="{{$user->addresses->last() ? $user->addresses->last()->street : ""}}">
                        </div>
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="current_landmark" placeholder="Landmark"
                                   value="{{$user->addresses->last() ? $user->addresses->last()->landmark : ""}}">
                        </div>
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="current_city" placeholder="City"
                                   value="{{$user->addresses->last() ? $user->addresses->last()->city : ""}}">
                        </div>
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="current_state" placeholder="State"
                                   value="{{$user->addresses->last() ? $user->addresses->last()->state : ""}}">
                        </div>
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="current_country" placeholder="Country"
                                   value="{{$user->addresses->last() ? $user->addresses->last()->country : ""}}">
                        </div>
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="current_police" placeholder="Police station"
                                   value="{{$user->addresses->last() ? $user->addresses->last()->police_station : ""}}">
                        </div>
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="current_post" placeholder="Post office"
                                   value="{{$user->addresses->last() ? $user->addresses->last()->post_office : ""}}">
                        </div>
                        <div class="col-lg-4 p-2">
                            <input type="text" class="form-control" name="current_pincode" placeholder="Pin Code"
                                   value="{{$user->addresses->last() ? $user->addresses->last()->pin_code : ""}}">
                        </div>
                    </div>
                </div>
                <br>
                <button class="btn profile-edit-btn" type="submit">Update</button>

            </form>
        </div>
        </div>
@endsection
