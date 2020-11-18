<html>


<head>
    <title>Salary Receipt</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<style>
    body {
        background-color: #ffffff;

    }
    table, tr, td ,th{
        border: 1px double #c8c8c8;
        font-size: 18px;
        font-weight:bold;!important
    }

    table td{
        padding: 0.2rem !important;
        margin: 0 !important
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
        <div class="row ">

            <div class="row pt-2 pb-5 mb-2">
                <div class="col-sm-4" style="color: red">
                    <h4>SL NO: {{$booking->serial_money}}</h4>
                </div>
                <div class="col-sm-4 justify-content-center  text-center">
                    <h3 style="display:inline-block; font-weight: bold;border-bottom: 1px solid #121213;color: #151621">
                        MONEY RECEIPT</h3>
                </div>
                <div class="col-sm-4"  style="text-align: end;">
                    <h4> Date: {{$salary->payment_received_date}}</h4>
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-sm-6">
                <table class="table" style="padding: 0!important;">
                    <tr>
                        <td>Patient ID</td>
                        <td>{{$booking->patient->patient_id}}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{\App\Address::where('id',$booking->patient->address_id)->get()->first()->landmark}},
                            {{\App\Address::where('id',$booking->patient->address_id)->get()->first()->street}}
                        </td>
                    </tr>
                    <tr>
                        <td>District:</td>
                     <td>   {{\App\Address::where('id',$booking->patient->address_id)->get()->first()->city}}</td>
                    </tr>
                    <tr>
                        <td>Period Required : </td>
                        <td>{{$booking->patient->days}}</td>
                    </tr>
                    <tr>
                        <td>Contact Number : </td>
                        <td>{{$booking->patient->phone_no}}</td>
                    </tr>
                    <tr>
                        <td>Duty Shift: </td>
                        <td>{{$booking->patient->shift}}</td>
                    </tr>
                    <tr>
                        <td>Shift Start: </td>
                        <td>{{$booking->created_at->format('d-F-Y')}}</td>
                    </tr>
                    <tr>
                        <td>Shift End: </td>
                        <td>{{$booking->created_at->addDays(31)->format('d-F-Y')}}</td>
                    </tr>
                    <tr>
                        <td>Total Amount: </td>
                        <td>{{$booking->total_payment}}</td>
                    </tr>
                    <tr>
                        <td>Advance Payment: </td>
                        <td>{{$booking->due_payment}}</td>
                    </tr>
                    <tr>
                        <td>Balance Amount: </td>
                        <td>{{$booking->total_payment - $booking->due_payment}}</td>
                    </tr>
                    <tr>
                        <td>Next Due Date: </td>
                        <td>{{$booking->created_at->addDays(31)->format('d-F-Y')}}</td>
                    </tr>

                </table>
            </div>

            <div class="col-sm-6">
                <table class="table  ">
                    <tr>
                        <td>Date:</td>
                        <td>    {{$booking->created_at->format('d-F-Y')}}</td>

                    </tr>
                </table>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12 pt-2">
                <table class="table ">
                    <tr>
                        <td>Payment Mode</td>
                        <td>ONLINE(&nbsp;&nbsp;&nbsp;&nbsp;)/ CHECK(&nbsp;&nbsp;&nbsp;&nbsp;)/ CASH(&nbsp;&nbsp;&nbsp;&nbsp;)
                            / CARD(&nbsp;&nbsp;&nbsp;&nbsp;)
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
    <div class="row justify-content-center" style="background-color: #23b77f;color: white; padding: 3px; margin-top:5px">
        <div><h3 class="text-center">www.aarogyahomecare.in Tel: +91 9435960652</h3></div>
    </div>

    <!--customer-->
    <div class="row justify-content-center">
        <div class="col-sm-4" style="color: red">
            <h4>SL NO: {{$booking->serial_money}}</h4>
        </div>
        <div class="col-sm-4 justify-content-center  text-center">
            <h3 style="display:inline-block; font-weight: bold;border-bottom: 1px solid #121213;color: #151621">
                MONEY RECEIPT</h3>
        </div>
        <div class="col-sm-4"  style="text-align: end;">
            <h4> Date: {{$salary->payment_received_date}}</h4>
        </div>
    </div>
        <div class="row mt-5">
            <div class="col-sm-6">
                <table class="table  ">
                 
                    <tr>
                        <td>Patient ID</td>
                        <td>{{$booking->patient->patient_id}}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{\App\Address::where('id',$booking->patient->address_id)->get()->first()->landmark}},
                            {{\App\Address::where('id',$booking->patient->address_id)->get()->first()->street}}
                        </td>
                    </tr>
                    <tr>
                        <td>District:</td>
                        <td>   {{\App\Address::where('id',$booking->patient->address_id)->get()->first()->city}}</td>
                    </tr>
                    <tr>
                        <td>Period Required : </td>
                        <td>{{$booking->patient->days}}</td>
                    </tr>
                    <tr>
                        <td>Contact Number : </td>
                        <td>{{$booking->patient->phone_no}}</td>
                    </tr>
                    <tr>
                        <td>Duty Shift: </td>
                        <td>{{$booking->patient->shift}}</td>
                    </tr>
                    <tr>
                        <td>Shift Start: </td>
                        <td>{{$booking->created_at->format('d-F-Y')}}</td>
                    </tr>
                    <tr>
                        <td>Shift End: </td>
                        <td>{{$booking->created_at->addDays(31)->format('d-F-Y')}}</td>
                    </tr>
                    <tr>
                        <td>Total Amount: </td>
                        <td>{{$booking->total_payment}}</td>
                    </tr>
                    <tr>
                        <td>Advance Payment: </td>
                        <td>{{$booking->due_payment}}</td>
                    </tr>
                    <tr>
                        <td>Balance Amount: </td>
                        <td>{{$booking->total_payment - $booking->due_payment}}</td>
                    </tr>
                    <tr>
                        <td>Next Due Date: </td>
                        <td>{{$booking->created_at->addDays(31)->format('d-F-Y')}}</td>
                    </tr>

                </table>
            </div>

            <div class="col-sm-6">
                <table class="table  ">
                    <tr>
                        <td>Date:</td>
                        <td>    {{$booking->created_at->format('d-F-Y')}}</td>

                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 pt-2">
                <table class="table ">
                    <tr>
                        <td>Payment Mode</td>
                        <td>ONLINE(&nbsp;&nbsp;&nbsp;&nbsp;)/ CHECK(&nbsp;&nbsp;&nbsp;&nbsp;)/ CASH(&nbsp;&nbsp;&nbsp;&nbsp;)
                            / CARD(&nbsp;&nbsp;&nbsp;&nbsp;)
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
<div class="row justify-content-center" style="background-color: #23b77f;color: white; padding: 3px; margin-top:5px">
    <div><h3 class="text-center">www.aarogyahomecare.in Tel: +91 9435960652</h3></div>
</div>

</div>
</body>
</html>
