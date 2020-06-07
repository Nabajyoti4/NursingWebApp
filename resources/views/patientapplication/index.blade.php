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
    <div style="background-color: #511b72;">
        <!-- navbar start -->
    @include('partials.navbar')
    <!-- navbar ends -->
    </div>
    <div class="wrapper">
        <div class="wrapper_form">
                @include('partials.errors')
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <h1>Custom Application Form</h1>
                    <!-- One "tab" for each step in the form: -->
                    <div class="tab">
                        <div class="form-group font-weight-bold">
                            <label for="name">Patient Full Name:</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name"
                                   value="">
                        </div>

                        <div class="form-group font-weight-bold">
                            <label for="phone_no">Phone Number:</label>
                            <input type="number" class="form-control" name="phone_no"
                                   placeholder="Enter Phone number"
                                   value="">
                        </div>
                        <div class="form-group font-weight-bold">
                            <label for="age">Age:</label>
                            <input type="number" class="form-control" name="age" placeholder="Age"
                                   value="">
                        </div>
                        <div class="form-group font-weight-bold">
                            <label for="gender">Gender:</label>
                            <select name="gender" class="form-control">
                                <option value="" class="form-control">Male</option>
                                <option value="" class="form-control">Female</option>
                            </select>
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
                                    <input type="text" class="form-control" name="permanent_city"
                                           placeholder="city">
                                </div>
                                <div class="col-lg-4 p-2">
                                    <input type="text" class="form-control" name="permanent_state"
                                           placeholder="State">
                                </div>
                                <div class="col-lg-4 p-2">
                                    <input type="text" class="form-control" name="permanent_country"
                                           placeholder="Country">
                                </div>
                                <div class="col-lg-4 p-2">
                                    <input type="text" class="form-control" name="permanent_police"
                                           placeholder="Police station">
                                </div>
                                <div class="col-lg-4 p-2">
                                    <input type="text" class="form-control" name="permanent_post"
                                           placeholder="Post office">
                                </div>
                                <div class="col-lg-4 p-2">
                                    <input type="text" class="form-control" name="permanent_pincode"
                                           placeholder="Postal/Zip Code">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="tab">
                        <div class="form-group font-weight-bold">
                            <label for="familymemberno">Total Family Member ( Both M/F):</label>
                            <input type="text" class="form-control" name="familymemberno"
                                   value="">
                        </div>
                        <div class="form-group font-weight-bold">
                            <label for="relation">Relation with the Guardian :</label>
                            <input type="text" class="form-control" name="guardianrelation"
                                   value="">
                        </div>
                        <div class="form-group font-weight-bold">
                            <label for="guardianname">Name of the Guardian:</label>
                            <input type="text" class="form-control" name="guardianname"
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
                            <textarea name="doctots_and_hospital" id="" cols="30" rows="10"
                                      class="form-control"></textarea>
                        </div>
                    </div>
                    <div style="overflow:auto;">
                        <div style="float:right;">
                            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                            <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                        </div>
                    </div>
                    <!-- Circles which indicates the steps of the form: -->
                    <div style="text-align:center;margin-top:40px;">
                        <span class="step"></span>
                        <span class="step"></span>
                    </div>
                </form>
            <div>
                <strong>Terms and Conditions:</strong> ( Registration Fees : 500/-, Advance Payment Requested: Cash/ Cheque/ Online
                Payment, Rate for one Nurse Per month (Day or Night shift) is Rs. 250x30=7500 (Rs) only, Rate for one
                Nurse for 24 Hours Duty per month is 450x30=13,500 (Rs) only, Customers should refrain from misbehavior
                to avoid complain against themselves, Customers should be responsible for overtime service. The
                authority of the sisters is not responsible for it; Service does not include work like Washing,
                Cleaning, Cooking, Marketing, Travelling and Attending other patients or for any personal use of the
                sisters; A sister is available till the patient is there only. She is not appointed for serving or
                helping the patient’s guardian or other relatives; Holiday: Our Service is not available on Bohag Bihu,
                Magh Bihu, Durga Puja and other Traditional Occasion.)
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script src="{{asset('js/hireform.js')}}"></script>
@endsection
