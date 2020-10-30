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
                <input type="number" class="form-control" name="age" value="{{$nurse->age}}" placeholder="Enter Age">
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
                        <option value="{{$nurse->is_active == 1 ? 1 : 0}}">{{$nurse->is_active == 1 ? "active" : "On leave"}}</option>
                        <option value="1">active</option>
                        <option value="0">on leave</option>
                    </select>
                </div>
            </div>


            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Permanent Address<span class="required">*</span></label>
                <div class="row">
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('permanent_street') is-invalid @enderror"
                               name="permanent_street"
                               placeholder="Street name"
                               value="{{$permanent_add->street ?? ""}}">
                        @error('permanent_street')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('permanent_landmark') is-invalid @enderror"
                               name="permanent_landmark" placeholder="Landmark"
                               value="{{$permanent_add->landmark ?? ""}}">
                        @error('permanent_landmark')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('permanent_city') is-invalid @enderror"
                               name="permanent_city" placeholder="City"
                               value="{{$permanent_add->city ?? ""}}">
                        @error('permanent_city')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('permanent_state') is-invalid @enderror"
                               name="permanent_state" placeholder="State"
                               value="{{$permanent_add->state ?? ""}}">
                        @error('permanent_state')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('permanent_country') is-invalid @enderror"
                               name="permanent_country" placeholder="Country"
                               value="{{$permanent_add->country ?? ""}}">
                        @error('permanent_country')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('permanent_police') is-invalid @enderror"
                               name="permanent_police"
                               placeholder="Police station"
                               value="{{$permanent_add->police_station ?? ""}}">
                        @error('permanent_police')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('permanent_post') is-invalid @enderror"
                               name="permanent_post" placeholder="Post office"
                               value="{{$permanent_add->post_office ?? ""}}">
                        @error('permanent_post')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control  @error('permanent_pincode') is-invalid @enderror"
                               name="permanent_pincode" placeholder="Pin Code"
                               value="{{$permanent_add->pin_code ?? ""}}">
                        @error('permanent_pincode')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="borderdiv">
                <label class="header font-weight-bold bg-light text-dark ">Identification And Qualification Details</label>
                <div class="form-group font-weight-bold">
                    <label for="identification">Pan card/Passport/Aadhar card/Driving License ( Identification ) </label>
                    <input type="file" class="form-control-file w-25" name="identification">
                </div>

                <div class="form-group font-weight-bold">
                    <label for="address">Aadhar card/Driving License/Voter ( Address Proof )</label>
                    <input type="file" class="form-control-file w-25" name="address">
                </div>

                <div class="form-group font-weight-bold">
                    <label for="education">Education Qualification</label>
                    <input required type="text" value="{{$nurse->qualification->education}}" class="form-control-file w-25" name="education" placeholder="eg : 10th pass">
                </div>

                <div class="form-group font-weight-bold">
                    <label for="other">Other Qualification</label>
                    <input required type="text" value="{{$nurse->qualification->other}}" class="form-control-file w-25" name="other">
                </div>
            </div>
            <br>
            <button class="btn btn-primary" type="submit">Update</button>

        </form>
    </div>

@endsection
