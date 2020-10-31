@extends('layouts.admin')
@section('title')
    Patient Profile
@endsection

@section('links')
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <link href="{{asset('css/error.css')}}" rel="stylesheet">
@endsection

@section('style')
    <style>


        h4 {
            text-transform: initial;
        }

        p{
            font-size: 12px;
            color: #1b1e21;
        }

        .text-dark{
            color: black;
        }

        span {
            font-size: 1.2rem;
            text-transform: capitalize;
        }

        .receipt{
            border: 1px solid black;!important;
            padding: 20px;
            background-color: white;
        }

        .receipt-heading{
            color: green;

        }

        .receipt-heading__title{
            font-weight: bolder;
        }

        .receipt-heading__description{
            font-weight: bolder;
        }


    </style>
@endsection

@section('content')
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Patient Details</h6>
        <span><b>Status:</b>
            @if($patient->status == 1)
                Approved
            @elseif($patient->status == 0)
                Disapproved
            @else
                Pending
            @endif</span>
    </div>

    <div class="container p-3 receipt">
        <!--header-->
        <div class="row">
            <div class="col-lg-3">
                <img src="{{asset('img/AArogya-new-edit-1.png')}}"
                     style="width: 150px; height: 60px; background: #fff; padding: 2px; border-radius: 4px; color: #28669F;"
                     alt="">
            </div>
            <div class="col-lg-6 text-center receipt-heading ">
               <h1 class="receipt-heading__title bold">AAROGYA</h1>
                <h4 class="receipt-heading__sub">HOME CARE NURSING SERVICE (24 x 7) HRS</h4>
                <h6 class="receipt-heading__description bold">HEAD OFFICE : MANDAKINI BIBAH BHAWAN, KOTOKY PUKHURI</h6>
                <h6 class="receipt-heading__description bold">BYE PASS TINI ALI, JORHAT</h6>
                <h6 class="receipt-heading__description bold">GOVT. REGISTERED, ASSAM</h6>
            </div>
            <div class="col-lg-3 text-right">
                Ph.No 9101786597 <br> 8753955565<br>6002450239
            </div>
        </div>

        <hr style="background-color: black">
        <!--terms and condition-->
        <div class="row">
        <div class="col-lg">
            <!--date and serial number-->
            <div class="row">
                <div class="col-lg-6">
                    SL.NO.
                </div>
                <div class="col-lg-6 text-right">
                    Date
                </div>
            </div>

            <!--terms-->
            <h3 class="text-dark font-weight-bold"><u>TERMS AND CONDITIONS</u></h3>
            <p>1. Registration Fees : 500/-</p>
            <p>2. Advance Payment Requested: Cash/ Cheque/ Online Payment</p>
            <p>3. Rate for one Nurse Per month (Day or Night shift) is Rs. 250x30=7500 (Rs) only</p>
            <p>4. Rate for one Nurse for 24 Hours Duty per month is 450x30=13,500 (Rs) only</p>
            <p>5. Customers should refrain from misbehavior to avoid complain against themselves</p>
            <p>6. Customers should be responsible for overtime service. The authority of the sisters is not responsible for it</p>
            <p>7. Service does not include work like Washing, Cleaning, Cooking, Marketing, Travelling and Attending other patients or for any personal use of the sisters</p>
            <p>8. A sister is available till the patient is there only. She is not appointed for serving or helping the patient’s guardian or other relatives</p>
            <p>9. <strong><u>Holiday :</u></strong> Our Service is not available on Bohag Bihu, Magh Bihu, Durga Puja and other Traditional Occasion.)</p>
        </div>
        </div>

        <!--form-->
        <div class="row mt-5">
            <div class="col-lg-12">
                <h3 class="text-dark font-weight-bold"><u>CUSTOMER APPLICATION FORM</u></h3>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-4">
                <h6 class="text-dark">1. Patient Name : Mr/Mrs/Miss</h6>
            </div>
            <div class="col-lg-8">
                : {{$patient->patient_name}}
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-4 text-right">
            </div>
            <div class="col-lg-1">
                <h6 class="text-dark">(i) Age : </h6>
            </div>
            <div class="col-lg-1">
                <h6 class="text-dark">{{$patient->age}} </h6>
            </div>
            <div class="col-lg-2">
                <h6 class="text-dark">(ii) Gender :  </h6>
            </div>
            <div class="col-lg-2 text-left">
                <h6 class="text-dark"> Male
                    @if($patient->gender == "Male")
                        <i class="fa fa-check-circle"
                           style="color: greenyellow"></i>
                   @endif
                </h6>
            </div>
            <div class="col-lg-2 text-left">
                <h6 class="text-dark"> Female
                    @if($patient->gender == "Female")
                        <i class="fa fa-check-circle"
                           style="color: greenyellow"></i>
                @endif
                </h6>

            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-4">
                <h6 class="text-dark">2. Address</h6>
            </div>
            <div class="col-lg-8">
                : {{$patient->getAddress()}}
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-4">
                <h6 class="text-dark">3. Phone Number</h6>
            </div>
            <div class="col-lg-8">
                : {{$patient->phone_no}}
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-4">
                <h6 class="text-dark">4. Family's Member (Both G/F)</h6>
            </div>
            <div class="col-lg-8">
                : {{$patient->family_members}}
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-4">
                <h6 class="text-dark">5. Name of the Guardian</h6>
            </div>
            <div class="col-lg-8">
                : {{$patient->guardian_name}}
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-4">
                <h6 class="text-dark">6. Duty Shift of the Nurse</h6>
            </div>
            <div class="col-lg-3">
                : (i) Day Shift
                @if($patient->shift === "day")
                    <i class="fa fa-check-circle"
                       style="color: greenyellow"></i>
                @endif
            </div>
            <div class="col-lg-3">
                : (ii) Night Shift
                @if($patient->shift === "night")
                    <i class="fa fa-check-circle"
                       style="color: greenyellow"></i>
                @endif
            </div>
            <div class="col-lg-2">
                : (i) 24 hours
                @if($patient->shift === "full")
                    <i class="fa fa-check-circle"
                       style="color: greenyellow"></i>
                @endif
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-4">
                <h6 class="text-dark">7. Period of Required</h6>
            </div>
            <div class="col-lg-8">
                :30 days (minimum) {{$patient->days}}
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-4">
                <h6 class="text-dark">8. Service</h6>
            </div>
            <div class="col-lg-3">
                : (i) Nursing Aide
                @if(\App\Service::findOrFail($patient->service->id)->title === "Nursing Aide")
                    <i class="fa fa-check-circle"
                       style="color: greenyellow"></i>
                @endif
            </div>
            <div class="col-lg-3">
                : (ii) Nursing Attendent
                @if(\App\Service::findOrFail($patient->service->id)->title === "Nursing Attendent")
                    <i class="fa fa-check-circle"
                       style="color: greenyellow"></i>
                @endif
            </div>
            <div class="col-lg-2">
                : (iii) Other
                @if(\App\Service::findOrFail($patient->service->id)->title === "Other")
                    <i class="fa fa-check-circle"
                       style="color: greenyellow"></i>
                @endif
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-4">
                <h6 class="text-dark">9. Patient's History</h6>
            </div>
            <div class="col-lg-8">
                : {{$patient->patient_history}}
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-4">
                <h6 class="text-dark">10. Doctor and Hospital</h6>
            </div>
            <div class="col-lg-8">
                : {{$patient->patient_doctor}}
            </div>
        </div>

        <!--decalration-->
        <div class="row mt-5">
            <div class="col-lg text-center">
                <h3 class="text-dark font-weight-bold"><u>GUARDIAN DECLARATION OF PATIENT</u></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <p style="font-size: 20px">&nbsp;&nbsp;&nbsp;&nbsp;I {{$patient->patient_name}} heartly apply "Home Care Nursing Service" for myself and I agree to the all terms & conditions which are mentioned above
                and i shall Co-operative myself for quickly recovery of my patient.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 text-dark">
                Date
            </div>
            <div class="col-lg-6 text-right text-dark">
                Full Signature of the Guardian
            </div>
        </div>

        <hr style="background-color: black">
        <!--office use-->
        <div class="row">
            <div class="col-lg text-center">
                <h3 class="text-dark font-weight-bold">OFFICE USE ONLY</h3>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-6 text-dark">
                Signature of In-Charge
            </div>
            <div class="col-lg-6 text-right text-dark">
                Authorised Signature<br>
                <p style="font-size: 15px">for, AAROGYA HOME CARE NURSING SERVICE</p>
            </div>
        </div>
    </div>

@endsection
