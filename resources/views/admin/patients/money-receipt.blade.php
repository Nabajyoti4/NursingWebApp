<html>


<head>
    <title>Money Receipt</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<style>
    body {
        background-color: #ffffff;

    }
    table, tr, td{
        border: 1px double #c8c8c8;
        font-weight:bold;!important
    }

    table td{
        padding: 0.2rem !important;
        margin: 0 !important;
    }

    table th{
        padding: 0.2rem !important;
        margin: 0 !important;
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
                     style="width: 180px; height: 80px; background: #fff; padding: 2px; border-radius: 4px; color: #28669F;"
                     alt="">
            </div>
            <div class="col-sm-8 text-center receipt-heading ">
                <h3 class="receipt-heading__sub font-weight-bold" style="color: green">AAROGYA HOME CARE NURSING
                    SERVICE</h3>
                <h6 class="receipt-heading__description font-weight-bold" style="color: #1b4b72">HEAD OFFICE : MANDAKINI
                    BIBAH BHAWAN COMPLEX, KOTOKY
                    PUKHURI,</h6>
                <h6 class="receipt-heading__description font-weight-bold" style="color: #1b4b72">BYE PASS TINI ALI,
                    JORHAT, PIN- 785006, ASSAM</h6>
            </div>
            <div class="col-sm-2 text-right" style="padding-top: 22px;">
                Ph.No 9101786597 <br> 8753955565<br>6002450239
            </div>
        </div>
        <hr style="background-color: black">

        <div class="row pt-2 pb-2 mb-2">
            <div class="col-sm-4" style="color: red">
                <h4>SL NO: {{$booking->serial_money}}</h4>
            </div>
            <div class="col-sm-4 justify-content-center  text-center">
                <h3 style="display:inline-block; font-weight: bold;border-bottom: 1px solid #121213;color: #151621">
                    MONEY RECEIPT</h3>
            </div>
            <div class="col-sm-4"  style="text-align: end;">
                <h4> Date: {{$booking->created_at->format('d-F-Y')}}</h4>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-8">
                <table class="table" style="padding: 0!important;">
                    <tr>
                        <td style="font-weight: bolder">Patient ID</td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->patient->patient_id}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Name</td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->user->name}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Address</td>
                        <td style="width: 100px; font-weight: lighter; text-align: center">{{\App\Address::where('id',$booking->patient->address_id)->get()->first()->landmark}},
                            {{\App\Address::where('id',$booking->patient->address_id)->get()->first()->street}}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">District:</td>
                     <td style="font-weight: lighter; text-align: center;text-transform: capitalize;">   {{\App\Address::where('id',$booking->patient->address_id)->get()->first()->city}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Period Required : </td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->patient->days}} Days</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Contact Number : </td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->patient->phone_no}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder" >Duty Shift: </td>
                        <td style="font-weight: lighter; text-align: center">
                            @if($booking->patient->shift == 'full')
                            24 hours
                            @else
                                <span style="text-transform: capitalize">$booking->patient->shift</span>
                            @endif
                            </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Shift Start: </td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->created_at->format('d-F-Y')}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Shift End: </td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->created_at->addDays(29)->format('d-F-Y')}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Total Amount: </td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->total_payment}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Advance Payment: </td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->due_payment}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Balance Amount: </td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->total_payment - $booking->due_payment}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Next Due Date: </td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->created_at->addDays(29)->format('d-F-Y')}}</td>
                    </tr>

                </table>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12 pt-2">
                <table class="table ">
                    <tr>
                        <td>Payment Mode</td>
                        <td>ONLINE(&nbsp;&nbsp;&nbsp;&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/CHECK(&nbsp;&nbsp;&nbsp;&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;/ CASH(&nbsp;&nbsp;&nbsp;&nbsp;)
                            &nbsp;&nbsp;&nbsp;&nbsp;/CARD(&nbsp;&nbsp;&nbsp;&nbsp;)
                        </td>
                    </tr>
                </table>
            </div>

        </div>
        <div style="font-size: 18px; margin-top: 30px">
            <div class="row">
                <div class="col-sm-2">Authorized by</div>
                <div class="col-sm-6"></div>
                <div class="col-sm-4">Customer Signature</div>
            </div>
            <br>

        </div>

    </div>
    <div class="row justify-content-center" style="background-color:  #85d534;color: white; padding: 3px;">
        <div><h3 class="text-center">www.aarogyahomecare.in Tel: +91 9435960652</h3></div>
    </div>

    <!--customer-->

    <div class="row pt-2 pb-2 mt-5">
        <div class="col-sm-4" style="color: red">
            <h4>SL NO: {{$booking->serial_money}}</h4>
        </div>
        <div class="col-sm-4 justify-content-center  text-center">
            <h3 style="display:inline-block; font-weight: bold;border-bottom: 1px solid #121213;color: #151621">
                MONEY RECEIPT</h3>
        </div>
        <div class="col-sm-4"  style="text-align: end;">
            <h4> Date: {{$booking->created_at->format('d-F-Y')}}</h4>
        </div>
    </div>
        <div class="row mt-2">
            <div class="col-sm-8">
                <table class="table" style="padding: 0!important;">
                    <tr>
                        <td style="font-weight: bolder">Patient ID</td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->patient->patient_id}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Name</td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->user->name}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Address</td>
                        <td style="width: 100px; font-weight: lighter; text-align: center">{{\App\Address::where('id',$booking->patient->address_id)->get()->first()->landmark}},
                            {{\App\Address::where('id',$booking->patient->address_id)->get()->first()->street}}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">District:</td>
                        <td style="font-weight: lighter; text-align: center;text-transform: capitalize;">   {{\App\Address::where('id',$booking->patient->address_id)->get()->first()->city}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Period Required : </td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->patient->days}} Days</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Contact Number : </td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->patient->phone_no}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder" >Duty Shift: </td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->patient->shift}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Shift Start: </td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->created_at->format('d-F-Y')}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Shift End: </td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->created_at->addDays(29)->format('d-F-Y')}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Total Amount: </td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->total_payment}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Advance Payment: </td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->due_payment}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Balance Amount: </td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->total_payment - $booking->due_payment}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Next Due Date: </td>
                        <td style="font-weight: lighter; text-align: center">{{$booking->created_at->addDays(29)->format('d-F-Y')}}</td>
                    </tr>

                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 pt-2">
                <table class="table ">
                    <tr>
                        <td>Payment Mode</td>
                        <td>ONLINE(&nbsp;&nbsp;&nbsp;&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/CHECK(&nbsp;&nbsp;&nbsp;&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;/ CASH(&nbsp;&nbsp;&nbsp;&nbsp;)
                            &nbsp;&nbsp;&nbsp;&nbsp;/CARD(&nbsp;&nbsp;&nbsp;&nbsp;)
                        </td>
                    </tr>
                </table>
            </div>

        </div>

    <div style="font-size: 18px; margin-top: 30px">
        <div class="row">
            <div class="col-sm-2">Authorized by</div>
            <div class="col-sm-6"></div>
            <div class="col-sm-4">Customer Signature</div>
        </div>
        <br>
    </div>
    <div class="row justify-content-center" style="background-color: #70d45d;color: white; padding: 3px;">
        <div><h3 class="text-center">www.aarogyahomecare.in Tel: +91 9435960652</h3></div>
    </div>
</div>



</div>
</body>
</html>
