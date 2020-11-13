@extends('layouts.admin')
@section('title')
    Create Patient
@endsection

@section('links')

    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <link href="{{asset('css/error.css')}}" rel="stylesheet">

@endsection

@section('style')
    <style>
        .borderdiv {
            position: relative;
            padding: 32px;
            border-radius: 10px;
            border: 2px solid #75b3e2;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
        .header {
            position: absolute;
            top: -14px;
            left: 1%;
            padding: 0% 2px;
            margin: 0%;
            background: white !important;
        }
    </style>
@endsection

@section('content')

    <div class="container emp-profile mt-3">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Patient Create Form</h3>
        </div>
        @include('partials.errors')
        <form action="{{ route('admin.patient.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Patient personal Details</label>
            <div class="row">
                <div class="col-lg-6 p-2">
                    <div class="form-group font-weight-bold">
                        <label for="patient_name">Patient Full Name:</label>
                        <input required type="text" class="form-control" name="patient_name" placeholder="Enter Name"
                               value="{{old('patient_name')}}">
                    </div>
                </div>

                <div class="col-lg-6 p-2">
                    <div class="form-group font-weight-bold">
                        <label for="phone_no">Phone Number:</label>
                        <input type="number" required name="phone_no" class="input form-control @error('phone_no') is-invalid @enderror" placeholder="Phone" value="{{old('phone_no')}}">
                        @error('phone_no')
                        <div class="invalid-feedback mt-5" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 p-2">
                    <div class="form-group font-weight-bold">
                        <label for="email">Email:</label>
                    <input id="email" type="text" class="input form-control @error('email') is-invalid @enderror" name="email"
                           value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                    @error('email')
                    <div class="invalid-feedback mt-5" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                    </div>
                </div>

                <div class="col-lg-6 p-2">
            <div class="form-group font-weight-bold">
                <label for="image">Upload Patient Pic: </label>
                <input type="file" class="form-control" name="image">
            </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6 p-2">
                    <div class="form-group font-weight-bold">
                        <label for="age">Age:</label>
                        <input required type="number" class="form-control" name="age" placeholder="Age"
                               value="{{old('age')}}">
                    </div>
                </div>
                <div class="col-lg-6 p-2">
                    <div class="form-group font-weight-bold">
                        <label for="gender">Gender:</label>
                        <select required name="gender" class="form-control">
                            <option value="">Select Gender</option>
                            <option value="Male" class="form-control">Male</option>
                            <option value="Female" class="form-control">Female</option>
                        </select>
                    </div>
                </div>
            </div>
            </div>

            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Address</label>
                <div class="row">
                    <div class="col-lg-4 p-2">
                        <input required type="text" class="form-control" name="permanent_street"
                               placeholder="Street name" value="{{old('permanent_street')}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input required type="text" class="form-control" name="permanent_landmark"
                               placeholder="Landmark" value="{{old('permanent_landmark')}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <select class="form-control" name="permanent_city" >
                            <option value="">Select City</option>
                            @foreach($cities as $city)
                                <option value="{{$city->city}}">{{$city->city}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 p-2">
                        <input required type="text" class="form-control" name="permanent_state"
                               placeholder="State" value="{{old('permanent_state')}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input required type="text" class="form-control" name="permanent_country"
                               placeholder="Country" value="{{old('permanent_country')}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input required type="text" class="form-control" name="permanent_police"
                               placeholder="Police station" value="{{old('permanent_police')}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input required type="text" class="form-control" name="permanent_post"
                               placeholder="Post office" value="{{old('permanent_post')}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input required type="text" class="form-control" name="permanent_pincode"
                               placeholder="Postal/Zip Code" value="{{old('permanent_pincode')}}">
                    </div>
                </div>
            </div>

            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Family Details</label>
            <div class="row">
                <div class="col-lg-4 p-2">
                    <div class="form-group font-weight-bold">
                        <label for="family_members">Total Family Member ( Both M/F):</label>
                        <input type="text" class="form-control" name="family_members"
                               value="{{old('family_members')}}">
                    </div>
                </div>
                <div class="col-lg-4 p-2">
                    <div class="form-group font-weight-bold">
                        <label for="relation_guardian">Relation with the Guardian :</label>
                        <input type="text" class="form-control" name="relation_guardian"
                               value="{{old('relation_guardian')}}">
                    </div>
                </div>
                <div class="col-lg-4 p-2">
                    <div class="form-group font-weight-bold">
                        <label for="guardian_name">Name of the Guardian:</label>
                        <input type="text" class="form-control" name="guardian_name"
                               value="{{old('guardian_name')}}">
                    </div>
                </div>
            </div>
            </div>

            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Service Details</label>
            <div class="row">
                <div class="col-lg-4 p-2">
                    <div class="form-group font-weight-bold">
                        <label for="shift">Duty Shift of the Nurse:</label>
                        <select required name="shift" class="form-control">
                            <option value="">Select Shift</option>
                            <option value="day">Day Shift</option>
                            <option value="night">Night Shift</option>
                            <option value="full">24 hours</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 p-2">
                    <div class="form-group font-weight-bold">
                        <label for="service_id">Service :</label>
                        <select required name="service_id" required class="form-control">
                            <option value="">Select Service</option>
                            @foreach($services as $service)
                                <option value="{{$service->id}}">{{ $service->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 p-2">
                    <div class="form-group font-weight-bold">
                        <label for="days">Period of Required (Days):</label>
                        <select required type="number" name="days" class="form-control">
                            <option value="30">30</option>
                        </select>
                    </div>
                </div>


            </div>
            </div>


            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Patient Info</label>
            <div class="row">
                <div class="col-lg-6 p-2">
            <div class="form-group font-weight-bold">
                <label for="patient_history">Patient's History :</label>
                <textarea name="patient_history" cols="30" rows="5"
                          class="form-control">{{old('patient_history')}}</textarea>
            </div>
                </div>

                <div class="col-lg-6 p-2">
            <div class="form-group font-weight-bold">
                <label for="patient_doctor">Doctor and Hospital:</label>
                <textarea name="patient_doctor" cols="30" rows="5"
                          class="form-control">{{old('patient_doctor')}}</textarea>
            </div>
                </div>
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-primary w-50" type="submit">Create</button>
            </div>


        </form>
    </div>

@endsection
