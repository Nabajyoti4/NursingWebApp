<html>


<head>
    <title>Money Receipt</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
</head>
<style>
    body {
        background-color: #ffffff;

    }

    table, tr, td {
        border: 1px double #c8c8c8;
        font-weight: bold;
    !important
    }

    table td {
        padding: 0.6rem !important;
        margin: 0 !important;
    }

    table th {
        padding: 0.2rem !important;
        margin: 0 !important;
    }

    .width_100 {
        width: 150px;
    }

</style>
<body>
<br>
<br>
<div class="container ">
    <div class="font-weight-bold ">
        <div class="row justify-content-center ">
            <!--header-->
            <div class="col-sm-2 " style="padding-top:0;">
                <img src="{{asset('img/AArogya-new-edit-1.png')}}"
                     style=" margin-top:-30px;width: 180px; height: 80px; background: #fff; padding: 2px; border-radius: 4px; color: #28669F;"
                     alt="">
            </div>
            <div class="col-sm-8 text-center receipt-heading d-flex justify-content-center">
                <div>
                    <h3 class="receipt-heading__sub font-weight-bold " style="padding-top:10px;color: green;text-align:initial;">AAROGYA HOME
                        CARE NURSING
                        SERVICE</h3>
                    <h6 class="receipt-heading__description font-weight-bold" style="color: #709b14;text-align:initial;">A Unit of GIYANMOY FOUNDATION registered under Section 8 of Companies Act 2013</h6>
                    <h6 class="receipt-heading__description font-weight-bold" style="color: #709b14;text-align:initial;">Registered No. :U85100AS2021NPL021070, License No. :123920</h6>

                    @if($booking->patient->getFullAddress()->city == 'sivasagar')
                        <h6 class="receipt-heading__description font-weight-bold" style="color: #1b4b72;text-align:initial;">BRANCH OFFICE :
                            OLD AMALAPATTY GANAK PATTY SIVASAGAR, BY LANE,</h6>
                        <h6 class="receipt-heading__description font-weight-bold" style="color: #1b4b72;text-align:initial;">
                            HARAKANTA NAZIR PATH SIVASAGAR, PIN- 785640, ASSAM</h6>
                    @elseif($booking->patient->getFullAddress()->city == 'dibrugarh')
                        <h6 class="receipt-heading__description font-weight-bold" style="color: #1b4b72;text-align:initial;">BRANCH OFFICE :
                            SASHAN PARA ROAD, NEAR SANKAR DEV HOSPITAL, MANCOTTA ROAD,</h6>
                        <h6 class="receipt-heading__description font-weight-bold" style="color: #1b4b72;text-align:initial;">,
                            DIBRUGARH, PIN- 786003, ASSAM</h6>
                    @else
                        <h6 class="receipt-heading__description font-weight-bold" style="color: #1b4b72;text-align:initial;">BRANCH OFFICE :
                            MBB COMPLEX, KOTOKY
                            PUKHURI,
                            JORHAT, PIN- 785006, ASSAM</h6>
                        <h6 class="receipt-heading__description font-weight-bold" style="color: #1b4b72;text-align:initial;"></h6>
                    @endif
                </div>
            </div>
            <div class="col-sm-2 text-right" style=" margin-top:-30px;padding-top: 22px;">
                <h5>Ph.No 9101786597 <br> 8753955565<br>6002450239</h5>
            </div>
        </div>
        <hr style="background-color: black">

        <div class="row pt-2 pb-2 mb-2">
            <div class="col-sm-4" style="color: red">
                <h4>SL NO: {{$booking->serial_money}}</h4>
            </div>
            <div class="col-sm-4 justify-content-center  text-center">
                <h3 style="display:inline-block; font-weight: bold;border-bottom: 1px solid #121213;color: #70d45d">
                    MONEY RECEIPT</h3>
            </div>
            <div class="col-sm-4" style="text-align: end;">
                <h4> Date: {{\Illuminate\Support\Carbon::parse($booking->due_date)->format('d-F-Y')}}</h4>
            </div>
        </div>

        <div class="row ">
            <div class="col-sm-6">
                <table class="table" style="padding: 0!important;">
                    <tr>
                        <td class="width_100" style="font-weight: bolder">Patient ID</td>
                        <td style="font-weight: lighter; ">{{$booking->patient->patient_id}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Name</td>
                        <td style="font-weight: lighter; ">{{$booking->patient->patient_name}}</td>
                    </tr>
                    <tr>
                        <td class="width_100" style="font-weight: bolder">Address</td>
                        <td style=" font-weight: lighter; ">{{\App\Address::where('id',$booking->patient->address_id)->get()->first()->landmark}}
                            ,
                            {{\App\Address::where('id',$booking->patient->address_id)->get()->first()->street}}
                        </td>
                    </tr>
                    <tr>
                        <td class="width_100" style="font-weight: bolder">District</td>
                        <td style="font-weight: lighter; text-transform: capitalize;">   {{\App\Address::where('id',$booking->patient->address_id)->get()->first()->city}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Contact Number</td>
                        <td style="font-weight: lighter; ">{{$booking->patient->phone_no}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row ">
            <div class="col-sm-6">
                <table class="table" style="padding: 0!important;">
                    <tr>
                        <td style="font-weight: bolder">Period Required :</td>
                        <td style="font-weight: lighter; ">{{$booking->patient->days}} Days</td>
                    </tr>

                    <tr>
                        <td style="font-weight: bolder">Duty Shift:</td>
                        <td style="font-weight: lighter; ">
                            @if($booking->patient->shift == 'full')
                                24 Hours
                            @else
                                <span style="text-transform: capitalize">{{$booking->patient->shift}}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Shift Start:</td>
                        <td style="font-weight: lighter; ">{{\Illuminate\Support\Carbon::parse($booking->start_date)->format('d-F-Y')}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Shift End:</td>
                        <td style="font-weight: lighter; ">{{\Illuminate\Support\Carbon::parse($booking->start_date)->addDays($booking->patient->days - 1)->format('d-F-Y')}}</td>
                    </tr>

                </table>
            </div>
            <div class="col-sm-6">
                <table class="table" style="padding: 0!important;">
                    <tr>
                        <td style="font-weight: bolder">Total Amount:</td>
                        <td style="font-weight: lighter; ">{{$booking->total_payment}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Advance Payment:</td>
                        <td style="font-weight: lighter; ">{{$booking->due_payment}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Balance Amount:</td>
                        <td style="font-weight: lighter; ">{{$booking->total_payment - $booking->due_payment}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Next Due Date:</td>
                        <td style="font-weight: lighter; ">{{\Illuminate\Support\Carbon::parse($booking->start_date)->addDays($booking->patient->days)->format('d-F-Y')}}</td>
                    </tr>

                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 pt-1">
                <table class="table ">
                    <tr>
                        <td>Payment Mode</td>
                        <td>ONLINE&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;
                            @if($booking->payment_mode == "ONLINE")
                                <i class="fa fa-check-circle"
                                   style="color: greenyellow"></i>
                            @endif
                            &nbsp;&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CHEQUE&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;
                            @if($booking->payment_mode == "CHEQUE")
                                <i class="fa fa-check-circle"
                                   style="color: greenyellow"></i>
                            @endif
                            &nbsp;&nbsp;&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            CASH&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;
                            @if($booking->payment_mode == "CASH")
                                <i class="fa fa-check-circle"
                                   style="color: greenyellow"></i>
                            @endif
                            &nbsp;&nbsp;)
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CARD&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;
                            @if($booking->payment_mode == "CARD")
                                <i class="fa fa-check-circle"
                                   style="color: greenyellow"></i>
                            @endif
                            &nbsp;&nbsp;)
                        </td>
                    </tr>
                </table>
            </div>

        </div>
        <div style="font-size: 18px; margin-top: 60px">
            <div class="row">
                <div class="col-sm-2">Authorized by</div>
                <div class="col-sm-7"></div>
                <div class="col-sm-3 " style="text-align: end;">Customer Signature</div>
            </div>
            <br>

        </div>

    </div>
    <div class="row justify-content-center" style="background-color:  #70d45d;color: white; padding: 3px;">
        @if($booking->patient->office_location == 'jorhat')
            <div><h5 class="text-center m-0">
                    Registered Office : GIYAMOY FOUNDATION  1 No. Choudaung Gaon, Cinamora, Jorhat,Assam, India, 785008 <br> https://www.aarogyahomecare.in/ Tel: +91 9435960652</h5></div>
        @else
            <div><h5 class="text-center m-0">
                    Registered Office : GIYAMOY FOUNDATION 1 No. Choudaung Gaon, Cinamora, Jorhat,Assam, India, 785008 <br> Branch Office: Mandakini Bibah Bhawan Complex, Katoky Pukhuri, Jorhat-785006, Assam. Tel: +91 9435960652</h5></div>
        @endif
    </div>

    <hr style ="border:1px dashed black; margin-top:30px; padding:0;">
    <!--customer-->

    <div class="row pt-2 pb-2 mt-2">
        <div class="col-sm-4" style="color: red">
            <h5>SL NO: {{$booking->serial_money}}</h5>
        </div>
        <div class="col-sm-4 justify-content-center  text-center">
            <h4 style="display:inline-block; font-weight: bold;border-bottom: 1px solid #121213;color: #70d45d;">
                MONEY RECEIPT</h4>
        </div>
        <div class="col-sm-4" style="text-align: end;">
            <h5> Date: {{\Illuminate\Support\Carbon::parse($booking->due_date)->format('d-F-Y')}}</h5>
        </div>
    </div>
    <div class="row m-0">
        <div class="col-sm-6">
            <table class="table" style="padding: 0!important; font-size: 12px;">
                <tr>
                    <td style="font-weight: bolder">Patient ID</td>
                    <td style="font-weight: lighter; ">{{$booking->patient->patient_id}}</td>
                </tr>
                <tr>
                    <td class="width_100" style="font-weight: bolder">Name</td>
                    <td style="font-weight: lighter; ">{{$booking->patient->patient_name}}</td>
                </tr>
                <tr>
                    <td class="width_100" style="font-weight: bolder">Address</td>
                    <td style="font-weight: lighter; ">{{\App\Address::where('id',$booking->patient->address_id)->get()->first()->landmark}}
                        ,
                        {{\App\Address::where('id',$booking->patient->address_id)->get()->first()->street}}
                    </td>
                </tr>
                <tr>
                    <td class="width_100" style="font-weight: bolder">District:</td>
                    <td style="font-weight: lighter; text-transform: capitalize;">   {{\App\Address::where('id',$booking->patient->address_id)->get()->first()->city}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bolder">Contact Number :</td>
                    <td style="font-weight: lighter; ">{{$booking->patient->phone_no}}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row m-0">
        <div class="col-sm-6">
            <table class="table" style="padding: 0!important; font-size: 12px;">
                <tr>
                    <td style="font-weight: bolder">Period Required :</td>
                    <td style="font-weight: lighter; ">{{$booking->patient->days}} Days</td>
                </tr>

                <tr>
                    <td style="font-weight: bolder">Duty Shift:</td>
                    <td style="font-weight: lighter; ">
                        @if($booking->patient->shift == 'full')
                            24 Hours
                        @else
                            <span style="text-transform: capitalize">{{$booking->patient->shift}}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bolder">Shift Start:</td>
                    <td style="font-weight: lighter; ">{{\Illuminate\Support\Carbon::parse($booking->start_date)->format('d-F-Y')}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bolder">Shift End:</td>
                    <td style="font-weight: lighter; ">{{\Illuminate\Support\Carbon::parse($booking->start_date)->addDays($booking->patient->days - 1)->format('d-F-Y')}}</td>
                </tr>

            </table>
        </div>
        <div class="col-sm-6">
            <table class="table" style="padding: 0!important; font-size: 12px;">
                <tr>
                    <td style="font-weight: bolder">Total Amount:</td>
                    <td style="font-weight: lighter; ">{{$booking->total_payment}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bolder">Advance Payment:</td>
                    <td style="font-weight: lighter; ">{{$booking->due_payment}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bolder">Balance Amount:</td>
                    <td style="font-weight: lighter; ">{{$booking->total_payment - $booking->due_payment}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bolder">Next Due Date:</td>
                    <td style="font-weight: lighter; ">{{\Illuminate\Support\Carbon::parse($booking->start_date)->addDays($booking->patient->days)->format('d-F-Y')}}</td>
                </tr>

            </table>
        </div>
    </div>

    <div class="row m-0">
        <div class="col-sm-12 ">
            <table class="table " style="font-size: 12px;">
                <tr>
                    <td>Payment Mode</td>
                    <td>ONLINE&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;
                        @if($booking->payment_mode == "ONLINE")
                            <i class="fa fa-check-circle"
                               style="color: greenyellow"></i>
                        @endif
                        &nbsp;&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CHEQUE&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;
                        @if($booking->payment_mode == "CHEQUE")
                            <i class="fa fa-check-circle"
                               style="color: greenyellow"></i>
                        @endif
                        &nbsp;&nbsp;&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        CASH&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;
                        @if($booking->payment_mode == "CASH")
                            <i class="fa fa-check-circle"
                               style="color: greenyellow"></i>
                        @endif
                        &nbsp;&nbsp;)
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CARD&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;
                        @if($booking->payment_mode == "CARD")
                            <i class="fa fa-check-circle"
                               style="color: greenyellow"></i>
                        @endif
                        &nbsp;&nbsp;)
                    </td>
                </tr>
            </table>
        </div>

    </div>

    <div style="font-size: 15px; margin-top: 30px">
        <div class="row">
            <div class="col-sm-2">Authorized by</div>
            <div class="col-sm-8"></div>
            <div class="col-sm-2">Customer Signature</div>
        </div>
        <br>
    </div>
    <div class="row justify-content-center"><div class="col-sm-12 text-center"><h5 class="text-center font-weight-bold" style="color:#70d45d;">Office Copy</h5></div></div>


    {{--    <div class="row justify-content-center" style="background-color: #70d45d;color: white; padding: 3px;">--}}
    {{--        @if($booking->patient->office_location == 'jorhat')--}}
    {{--            <div><h4 class="text-center m-0">--}}
    {{--                    Registered Office: GIYAMOY FOUNDATION  1 No. Choudaung Gaon, Cinamora, Jorhat,Assam, India, 785008 <br> https://www.aarogyahomecare.in/ Tel: +91 9435960652</h4></div>--}}
    {{--        @else--}}
    {{--            <div><h4 class="text-center m-0">--}}
    {{--                    Registered Office: GIYAMOY FOUNDATION  1 No. Choudaung Gaon, Cinamora,  Jorhat,Assam, India, 785008 <br>Branch Office: Mandakini Bibah Bhawan Complex, Katoky Pukhuri, Jorhat-785006, Assam. Tel: +91 9435960652</h4></div>--}}
    {{--        @endif--}}
    {{--    </div>--}}
</div>


</div>

<!--<style type="text/css" media="print">-->
<!--    * {-->
<!---webkit-print-color-adjust: exact !important; /*Chrome, Safari */-->
<!--color-adjust: exact !important; /*Firefox*/-->
<!--    }-->
<!--</style>-->
<!--<script>-->
<!--    window.onload = function invoice()-->
<!--    {-->
<!--        window.print();-->
<!--    }-->
<!--</script>-->
</body>
</html>
