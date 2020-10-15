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
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Name"
                               value="{{$user->name}}">
                        @error('name')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group font-weight-bold">
                        <label for="phone_no">Phone Number:</label>
                        <input type="number" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" placeholder="Enter Phone number"
                               value="{{$user->phone_no}}">
                        @error('phone_no')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>


                    <div class="form-group font-weight-bold">
                        <label for="image">Upload Profile Pic: </label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror"  name="image">
                        @error('image')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div style="background-color:#22778a;border-radius:10px;"><h4 style="color:white; padding:10px;">
                            Please insert the Current Address Correctly As this address will be used in Booking
                            purposes</h4></div>
                    <div class="borderdiv">
                        <label class="header font-weight-bold bg-light">Current Address</label>
                        <div class="row">
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control @error('current_street') is-invalid @enderror" name="current_street" placeholder="Street name"
                                       value="{{$user->addresses->first() ? $user->addresses->first()->street : ""}}">
                                @error('current_street')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control @error('current_landmark') is-invalid @enderror" name="current_landmark" placeholder="Landmark"
                                       value="{{$user->addresses->first() ? $user->addresses->first()->landmark : ""}}">
                                @error('current_landmark')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control @error('current_city') is-invalid @enderror" name="current_city" placeholder="City"
                                       value="{{$user->addresses->first() ? $user->addresses->first()->city : ""}}">
                                @error('current_city')
                                <div class="invalid-feedback mt-2 alert-danger" role="alert">
                                    <strong class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control @error('current_state') is-invalid @enderror" name="current_state" placeholder="State"
                                       value="{{$user->addresses->first() ? $user->addresses->first()->state : ""}}">
                                @error('current_state')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control @error('current_country') is-invalid @enderror" name="current_country" placeholder="Country"
                                       value="{{$user->addresses->first() ? $user->addresses->first()->country : ""}}">
                                @error('current_country')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control @error('current_police') is-invalid @enderror" name="current_police"
                                       placeholder="Police station"
                                       value="{{$user->addresses->first() ? $user->addresses->first()->police_station : ""}}">
                                @error('current_police')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control @error('current_post') is-invalid @enderror" name="current_post" placeholder="Post office"
                                       value="{{$user->addresses->first() ? $user->addresses->first()->post_office : ""}}">
                                @error('current_post')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control @error('current_pincode') is-invalid @enderror" name="current_pincode" placeholder="Pin Code"
                                       value="{{$user->addresses->first() ? $user->addresses->first()->pin_code : ""}}">
                                @error('current_pincode')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="borderdiv">
                        <label class="header font-weight-bold bg-light">Permanent Address</label>
                        <div class="row">
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control @error('permanent_street') is-invalid @enderror" name="permanent_street"
                                       placeholder="Street name"
                                       value="{{$user->addresses->last() ? $user->addresses->last()->street : ""}}">
                                @error('permanent_street')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control @error('permanent_landmark') is-invalid @enderror" name="permanent_landmark" placeholder="Landmark"
                                       value="{{$user->addresses->last() ? $user->addresses->last()->landmark : ""}}">
                                @error('permanent_landmark')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control @error('permanent_city') is-invalid @enderror" name="permanent_city" placeholder="city"
                                       value="{{$user->addresses->last() ? $user->addresses->last()->city : ""}}">
                                @error('permanent_city')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control @error('permanent_state') is-invalid @enderror" name="permanent_state" placeholder="State"
                                       value="{{$user->addresses->last() ? $user->addresses->last()->state : ""}}">
                                @error('permanent_state')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control @error('permanent_country') is-invalid @enderror" name="permanent_country" placeholder="Country"
                                       value="{{$user->addresses->last() ? $user->addresses->last()->country : ""}}">
                                @error('permanent_country')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control @error('permanent_police') is-invalid @enderror" name="permanent_police"
                                       placeholder="Police station"
                                       value="{{$user->addresses->last() ? $user->addresses->last()->police_station : ""}}">
                                @error('permanent_police')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control @error('permanent_post') is-invalid @enderror" name="permanent_post" placeholder="Post office"
                                       value="{{$user->addresses->last() ? $user->addresses->last()->post_office : ""}}">
                                @error('permanent_post')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control  @error('permanent_pincode') is-invalid @enderror" name="permanent_pincode" placeholder="Pin Code"
                                       value="{{$user->addresses->last() ? $user->addresses->last()->pin_code : ""}}">
                                @error('permanent_pincode')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <button class="btn profile-edit-btn" type="submit">Update</button>

                </form>
            </div>
        </div>
@endsection
