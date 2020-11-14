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

    <link href="{{asset('css/hireform.css')}}" rel="stylesheet">
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
    <div style="background-color: #4e73df;">
        <!-- navbar start -->
    @include('partials.navbar')
    <!-- navbar ends -->
    </div>
    <div class="wrapper rounded-lg">
        <div class="wrapper_form rounded-lg">
            @include('partials.errors')
            <form action="{{ route('users.patient.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h1>Customer Application Form</h1>
                <div class="border rounded p-4" style="font-family: sans-serif;justify-content: center">
                    <strong><h4 style="font-weight: bolder">Terms and Conditions:</h4></strong> <h5 style="letter-spacing: 0.5px; color: black">( Registration Fees : 500/-, Advance Payment Requested: Cash/
                    Cheque/ Online
                    Payment, Rate for one Nurse Per month (Day or Night shift) is Rs. 250x30=7500 (Rs) only, Rate for
                    one
                    Nurse for 24 Hours Duty per month is 450x30=13,500 (Rs) only, Customers should refrain from
                    misbehavior
                    to avoid complain against themselves, Customers should be responsible for overtime service. The
                    authority of the sisters is not responsible for it; Service does not include work like Washing,
                    Cleaning, Cooking, Marketing, Travelling and Attending other patients or for any personal use of the
                    sisters; A sister is available till the patient is there only. She is not appointed for serving or
                    helping the patient’s guardian or other relatives; Holiday: Our Service is not available on Bohag
                    Bihu,
                        Magh Bihu, Durga Puja and other Traditional Occasion.)</h5>
                </div>
                <!-- One "tab" for each step in the form: -->
                <div class="tab">

                    <div class="borderdiv">
                        <label class="header font-weight-bold bg-light">Patient personal Details</label>
                    <div class="row">
                        <div class="col-lg-6 p-2">
                            <div class="form-group font-weight-bold">
                                <label for="patient_name">Patient Full Name:</label>
                                <input required type="text" class="form-control" name="patient_name"
                                       placeholder="Enter Name"
                                       value="{{old('patient_name')}}">
                            </div>
                        </div>

                        <div class="col-lg-6 p-2">
                            <div class="form-group font-weight-bold">
                                <label for="phone_no">Phone Number:</label>
                                <input required type="number" class="form-control" name="phone_no"
                                       placeholder="Enter Phone number"
                                       value="{{old('phone_no')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group font-weight-bold">
                        <label for="image">Upload Patient Pic: </label>
                        <input type="file" class="form-control" name="image">
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
                                <select class="form-control" name="permanent_city">
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

                </div>

                <div class="tab">
                    <div class="borderdiv">
                        <label class="header font-weight-bold bg-light">Family Details</label>
                        <div class="row">
                            <div class="col-lg-4 p-2">
                                <div class="form-group font-weight-bold">
                                    <label for="family_members">Total Family Member ( Both M/F):</label>
                                    <input required type="text" class="form-control" name="family_members"
                                           value="{{old('family_members')}}">
                                </div>
                            </div>
                            <div class="col-lg-4 p-2">
                                <div class="form-group font-weight-bold">
                                    <label for="relation_guardian">Relation with the Guardian :</label>
                                    <input required type="text" class="form-control" name="relation_guardian"
                                           value="{{old('relation_guardian')}}">
                                </div>
                            </div>
                            <div class="col-lg-4 p-2">
                                <div class="form-group font-weight-bold">
                                    <label for="guardian_name">Name of the Guardian:</label>
                                    <input required type="text" class="form-control" name="guardian_name"
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
                                    <select name="shift" required class="form-control">
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
                                    <select required name="service_id" class="form-control">
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
                        <label class="header font-weight-bold bg-light">Patient Additional Info</label>
                        <div class="row">
                            <div class="col-lg-6 p-2">
                                <div class="form-group font-weight-bold">
                                    <label for="patient_history">Patient's History :</label>
                                    <textarea required name="patient_history"  rows="5"
                                              class="form-control">{{old('patient_history')}}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-6 p-2">
                                <div class="form-group font-weight-bold">
                                    <label for="patient_doctor">Doctor and Hospital:</label>
                                    <textarea required name="patient_doctor" rows="5"
                                              class="form-control">{{old('patient_doctor')}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div style="overflow:auto;">
                    <div style="float:right;">
                        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                    </div>
                </div>
                <div style="overflow:auto;">
                    <center>
                        <div>
                            <button type="submit" id="submitBtn">Submit</button>
                        </div>
                    </center>

                </div>
                <!-- Circles which indicates the steps of the form: -->
                <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                </div>
            </form>

        </div>
    </div>


@endsection
@section('scripts')
    <script src="{{asset('js/hireform.js')}}"></script>
@endsection
