<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        Patient Receipt
    </title>

    <!-- Custom styles for this template-->
    {{--    <link rel="stylesheet" href="{{asset('css/app.css')}}">--}}
    <link href="{{asset('css/adminPanel.min.css')}}" rel="stylesheet">
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <link rel="stylesheet" href="{{asset('css/dataTables.min.css')}}">
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <link href="{{asset('css/error.css')}}" rel="stylesheet">


</head>
<style>
    tr:hover {
        background: #ffffff;
        transition: all .1s;
        color: #5d5656;
    }

    h4 {
        text-transform: initial;
    }

    p {
        font-size: 12px;
        color: #1b1e21;
    }

    .text-dark {
        color: black;
    }

    span {
        font-size: 1.2rem;
        text-transform: capitalize;
    }

    .receipt {
        border: 1px solid black;
    !important;
        padding: 20px;
        background-color: white;
    }

    .receipt-heading {
        color: green;

    }

    .receipt-heading__title {
        font-weight: bolder;
    }

    .receipt-heading__description {
        font-weight: bolder;
    }

</style>
<body>

<!-- Page Wrapper -->
<span id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
         @include('partials.admin_navbar')
        <!-- End of navbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

    <div class="container  receipt mt-4 " >
        <!--header-->
        <div class="row">
            <div class="col-sm-2">
                <img src="{{asset('img/AArogya-new-edit-1.png')}}"
                     style="width: 150px; height: 60px; background: #fff; padding: 2px; border-radius: 4px; color: #28669F;"
                     alt="">
            </div>
            <div class="col-sm-8 text-center receipt-heading d-flex justify-content-center">
               <div>
                    <h3 class="receipt-heading__sub font-weight-bold mt-5" style="text-align:initial;">AAROGYA HOME CARE NURSING SERVICE</h3>
                 <h6 class="receipt-heading__description font-weight-bold" style="color: #709b14;text-align:initial;">A Unit of GIYANMOY FOUNDATION registered under Section 8 of Companies Act 2013</h6>
                <h6 class="receipt-heading__description font-weight-bold" style="color: #709b14;text-align:initial;">Registered No. :U85100AS2021NPL021070 , License No. :123920</h6>
                @if($patient->getFullAddress()->city == 'sivasagar' ||$booking->patient->getFullAddress()->city == 'SIVASAGAR' )
                       <h6 class="receipt-heading__description font-weight-bold" style="color: #1b4b72;text-align:initial;">BRANCH OFFICE :
                        OLD AMALAPATTY ,
                        HARAKANTA NAZIR PATH SIVASAGAR, PIN- 785640, ASSAM</h6>
                   @elseif($patient->getFullAddress()->city == 'dibrugarh'||$booking->patient->getFullAddress()->city == 'DIBRUGARH')
                       <h6 class="receipt-heading__description font-weight-bold" style="color: #1b4b72;text-align:initial;">BRANCH OFFICE :
                        SASHAN PARA ROAD, NEAR SANKAR DEV HOSPITAL,
                        DIBRUGARH, PIN- 786003, ASSAM</h6>
                   @else
                       <h6 class="receipt-heading__description font-weight-bold" style="color: #1b4b72;text-align:initial;">BRANCH OFFICE :
                        MBB COMPLEX, KOTOKY
                        PUKHURI,
                        JORHAT, PIN- 785006, ASSAM</h6>
                   @endif
               </div>
            </div>
            <div class="col-sm-2 text-right">
                Ph No.<br>9101786597 <br> 8753955565<br>6002450239
            </div>
        </div>

        <hr style="background-color: black">
        <!--terms and condition-->
        <div class="row">
        <div class="col-lg">
            <!--date and serial number-->
            <div class="row">
                <div class="col-sm-6">
                    SL.NO. <span
                        style="color: red">{{\App\Booking::where('patient_id', $patient->id)->get()->first()->serial}}</span>
                </div>
                <div class="col-sm-6 text-right">
                    Date : {{$patient->created_at}}
                </div>
            </div>

            <!--terms-->
            <h3 class="text-dark font-weight-bold"><u>TERMS AND CONDITIONS</u></h3>
            <h5>1. Registration Fees : 500/-</h5>
            <h5>2. Advance Payment Requested: Cash/ Cheque/ Online Payment</h5>
            <h5>3. Rate for one Nurse Per month (Day or Night shift) is Rs. 8260  only [including GST].</h5>
            <h5>4. Rate for one Nurse for 24 Hours Duty per month is Rs. 15340  only [including GST].</h5>
            <h5>5. Customers should refrain from misbehaviours to sisters to avoid complain against themselves.</h5>
            <h5>6. Customers should be responsible for overtime service. The authority of the sisters is not responsible for it</h5>
            <h5>7. Service does not include work like Washing, Cleaning, Cooking, Marketing, Travelling and Attending other patients or for any personal use of the sisters</h5>
            <h5>8. A sister is available till the patient is there only. She is not appointed for serving or helping the patient’s guardian or other relatives</h5>
            <h5>9. <strong><u>Holiday :</u></strong> Our Service is not available on Bohag Bihu, Magh Bihu, Durga Puja and other Traditional Occasion.)</h5>
        </div>
        </div>

        <!--form-->
        <div class="row mt-2">
            <div class="col-sm-12">
                <h3 class="text-dark font-weight-bold"><u>CUSTOMER APPLICATION FORM</u></h3>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-4">
                <h5 class="text-dark">1. Patient Name : Mr/Mrs/Miss</h5>
            </div>
            <div class="col-sm-8">
                : {{$patient->patient_name}}
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-4 text-right">
            </div>
            <div class="col-sm-1">
                <h5 class="text-dark"><span style="text-transform: lowercase">(i)</span> Age : </h5>
            </div>
            <div class="col-sm-1">
                <h5 class="text-dark">{{$patient->age}} </h5>
            </div>
            <div class="col-sm-2">
                <h5 class="text-dark"><span style="text-transform: lowercase">(ii)</span> Gender :  </h5>
            </div>
            <div class="col-sm-2 text-left">
                <h5 class="text-dark"> Male
                    @if($patient->gender == "Male")
                        <i class="fa fa-check-circle"
                           style="color: greenyellow"></i>
                    @endif
                </h5>
            </div>
            <div class="col-sm-2 text-left">
                <h5 class="text-dark"> Female
                    @if($patient->gender == "Female")
                        <i class="fa fa-check-circle"
                           style="color: greenyellow"></i>
                    @endif
                </h5>

            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-4">
                <h5 class="text-dark">2. Address</h5>
            </div>
            <div class="col-sm-8">
                : {{$patient->getAddress()}}
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-4">
                <h5 class="text-dark">3. Phone Number</h5>
            </div>
            <div class="col-sm-8">
                : {{$patient->phone_no}}
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-4">
                <h5 class="text-dark">4. Family's Member (Both G/F)</h5>
            </div>
            <div class="col-sm-8">
                : {{$patient->family_members}}
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-4">
                <h5 class="text-dark">5. Name of the Guardian</h5>
            </div>
            <div class="col-sm-8">
                : {{$patient->guardian_name}}
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-4">
                <h5 class="text-dark">6. Duty Shift of the Nurse</h5>
            </div>
            <div class="col-sm-3">
                : <span style="text-transform: lowercase">(i)</span> Day Shift
                @if($patient->shift === "day")
                    <i class="fa fa-check-circle"
                       style="color: greenyellow"></i>
                @endif
            </div>
            <div class="col-sm-3">
                : <span style="text-transform: lowercase">(ii)</span> Night Shift
                @if($patient->shift === "night")
                    <i class="fa fa-check-circle"
                       style="color: greenyellow"></i>
                @endif
            </div>
            <div class="col-sm-2">
                : <span style="text-transform: lowercase">(iii)</span> 24 hours
                @if($patient->shift === "full")
                    <i class="fa fa-check-circle"
                       style="color: greenyellow"></i>
                @endif
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-4">
                <h5 class="text-dark">7. Period of Required</h5>
            </div>
            <div class="col-sm-8">
                :30 days (minimum) {{$patient->days}}
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-4">
                <h5 class="text-dark">8. Service</h5>
            </div>
            <div class="col-sm-3">
                :<span style="text-transform: lowercase"> (i)</span> Nursing Aide
                @if(\App\Service::findOrFail($patient->service->id)->title === "Nursing Aide")
                    <i class="fa fa-check-circle"
                       style="color: greenyellow"></i>
                @endif
            </div>
            <div class="col-sm-3">
                : <span style="text-transform: lowercase">(ii)</span> Nursing Attendent
                @if(\App\Service::findOrFail($patient->service->id)->title === "Nursing Attendant")
                    <i class="fa fa-check-circle"
                       style="color: greenyellow"></i>
                @endif
            </div>
            <div class="col-sm-2">
                : <span style="text-transform: lowercase">(iii)</span> Other
                @if(\App\Service::findOrFail($patient->service->id)->title === "Other")
                    <i class="fa fa-check-circle"
                       style="color: greenyellow"></i>
                @endif
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-4">
                <h5 class="text-dark">9. Patient's History</h5>
            </div>
            <div class="col-sm-8">
                : {{$patient->patient_history}}
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-4">
                <h5 class="text-dark">10. Doctor and Hospital</h5>
            </div>
            <div class="col-sm-8">
                : {{$patient->patient_doctor}}
            </div>
        </div>
        <!--decalration-->
        <div class="row mt-2">
            <div class="col-sm text-center">
                <h3 class="text-dark font-weight-bold"><u>GUARDIAN DECLARATION OF PATIENT</u></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I ........{{$patient->user->name}}......heartly apply "Home Care Nursing Service" for myself and I agree to the all terms & conditions which are mentioned above
                and i shall Co-operative myself for quickly recovery of my patient.</h5>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-6 text-dark mt-4">
                Date : ...........................
            </div>
            <div class="col-sm-6 text-right text-dark mt-4">
                Full Signature of the Guardian
            </div>
        </div>

        <hr style="background-color: black">
        <!--office use-->
        <div class="row">
            <div class="col-sm text-center">
                <h3 class="text-dark font-weight-bold">OFFICE USE ONLY</h3>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-6 text-dark">
                Signature of In-Charge
            </div>
            <div class="col-sm-6 text-right text-dark">
                Authorised Signature<br>
            </div>
        </div>
    </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

</span>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">Logout</a>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/admin/adminPanel.js')}}"></script>
{{--/*<style type="text/css" media="print">*/--}}
{{--    /*    * {*/--}}
{{--    -webkit-print-color-adjust: exact !important; /*Chrome, Safari */--}}
{{--    color-adjust: exact !important; /*Firefox*/--}}
{{--    /*    }*/--}}
{{--    /*</style>*/--}}
{{--/*<script>*/--}}
{{--    /*    window.onload = function invoice()*/--}}
{{--    /*    {*/--}}
{{--    /*        window.print();*/--}}
{{--    /*    }*/--}}
{{--    /*</script>*/--}}
</body>
</html>
