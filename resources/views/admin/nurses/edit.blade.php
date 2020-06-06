@extends('layouts.admin')
@section('title')
    Edit User
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

    <div class="container emp-profile mt-3">
        @include('partials.errors')
        <form action="{{ route('admin.nurse.update', $nurse->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group font-weight-bold">
                <label for="name">Full Name:</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Name"
                       value="{{$nurse->user->name}}">
            </div>

            <div class="form-group font-weight-bold">
                <label for="phone_no">Phone Number:</label>
                <input type="number" class="form-control" name="phone_no" placeholder="Enter Phone number"
                       value="{{$nurse->user->phone_no}}">
            </div>

            <div class="form-group font-weight-bold">
                <label for="age">Age</label>
                <input type="number" class="form-control" name="age"   value="{{$nurse->age}}" placeholder="Enter Age">
            </div>

            <div >
                <img src="{{ $nurse->user->photo?asset("/storage/".$nurse->user->photo->photo_location) :'http://placehold.it/64x64'}}" width="20%" height="30%" />
            </div>

            <div class="form-group font-weight-bold">
                <label for="image">Upload Profile Pic: </label>
                <input type="file" class="form-control" name="image">
            </div>

            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Working Or On Leave</label>
                <div class="form-group font-weight-bold">
                    <label for="active">Active</label>
                    <select  name="active">
                        <option value="1">active</option>
                        <option value="0">on leave</option>
                    </select>
                </div>
            </div>


            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Permanent Address</label>
                <div class="row">
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="permanent_street" placeholder="Street name"
                               value="{{$nurse->user->addresses->first() ? $nurse->user->addresses->first()->street : ""}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="permanent_landmark" placeholder="Landmark"
                               value="{{$nurse->user->addresses->first() ? $nurse->user->addresses->first()->landmark : ""}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="permanent_city" placeholder="city"
                               value="{{$nurse->user->addresses->first() ? $nurse->user->addresses->first()->city : ""}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="permanent_state" placeholder="State"
                               value="{{$nurse->user->addresses->first() ? $nurse->user->addresses->first()->state : ""}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="permanent_country" placeholder="Country"
                               value="{{$nurse->user->addresses->first() ? $nurse->user->addresses->first()->country : ""}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="permanent_police" placeholder="Police station"
                               value="{{$nurse->user->addresses->first() ? $nurse->user->addresses->first()->police_station : ""}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="permanent_post" placeholder="Post office"
                               value="{{$nurse->user->addresses->first() ? $nurse->user->addresses->first()->post_office : ""}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="permanent_pincode" placeholder="Pin Code"
                               value="{{$nurse->user->addresses->first() ? $nurse->user->addresses->first()->pin_code : ""}}">
                    </div>
                </div>
            </div>

            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Current Address</label>
                <div class="row">
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="current_street" placeholder="Street name"
                               value="{{$nurse->user->addresses->last() ? $nurse->user->addresses->last()->street : ""}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="current_landmark" placeholder="Landmark"
                               value="{{$nurse->user->addresses->last() ? $nurse->user->addresses->last()->landmark : ""}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="current_city" placeholder="City"
                               value="{{$nurse->user->addresses->last() ? $nurse->user->addresses->last()->city : ""}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="current_state" placeholder="State"
                               value="{{$nurse->user->addresses->last() ? $nurse->user->addresses->last()->state : ""}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="current_country" placeholder="Country"
                               value="{{$nurse->user->addresses->last() ? $nurse->user->addresses->last()->country : ""}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="current_police" placeholder="Police station"
                               value="{{$nurse->user->addresses->last() ? $nurse->user->addresses->last()->police_station : ""}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="current_post" placeholder="Post office"
                               value="{{$nurse->user->addresses->last() ? $nurse->user->addresses->last()->post_office : ""}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control" name="current_pincode" placeholder="Pin Code"
                               value="{{$nurse->user->addresses->last() ? $nurse->user->addresses->last()->pin_code : ""}}">
                    </div>
                </div>
            </div>

            <div class="borderdiv">
                <label class="header font-weight-bold bg-light text-dark ">Identification And Qualification Details</label>
                <div class="form-group font-weight-bold">
                    <label for="pan_image">Pan card: </label>
                    <input type="file" class="form-control-file" name="pan_image">
                </div>
                <div class="form-group font-weight-bold">
                    <label for="aadhar_image">Aadhar card: </label>
                    <input type="file" class="form-control-file" name="adhar_image">
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
                <div class="form-group font-weight-bold">
                    <label for="qualification">Other Qualification Certificate: </label>
                    <input type="file" class="form-control-file" name="other_qualification">
                </div>
            </div>
            <br>
            <button class="btn profile-edit-btn" type="submit">Update</button>

        </form>
    </div>

@endsection
