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
                <h3 class="receipt-heading__sub font-weight-bold mt-5" style="color: green">AAROGYA HOME CARE NURSING
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

        <div class="row pt-2 pb-5 mb-2">
            <div class="col-sm-4" style="color: red">
                <h4>SL NO: {{$salary->id}}</h4>
            </div>
            <div class="col-sm-4 justify-content-center  text-center">
                <h3 style="display:inline-block; font-weight: bold;border-bottom: 1px solid #121213;color: #151621">
                    Salary Slip</h3>
            </div>
            <div class="col-sm-4"  style="text-align: end;">
                <h4> Date: {{$salary->payment_received_date}}</h4>
            </div>
        </div>
        <div class="row ">
            <div class="col-sm-6">
                <table class="table  ">

                    <tr>
                        <td>Employee ID</td>
                        <td>{{$salary->nurse_id}}</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>{{\App\Nurse::where('employee_id',$salary->nurse_id)->get()->first()->user->name??\App\Employee::where('employee_id',$salary->nurse_id)->get()->first()->user->name}}</td>

                    </tr>
                    <tr>
                        <td>Designation</td>
                        @if(\App\Employee::where('employee_id',$salary->nurse_id)->get()->isNotEmpty())
                            <td>{{\App\Employee::where('employee_id',$salary->nurse_id)->get()->first()->role(\App\Employee::where('employee_id',$salary->nurse_id)->get()->first()->role)}}</td>
                        @elseif(\App\Nurse::where('employee_id',$salary->nurse_id)->get()->first()->user->role =='nurse')
                            <td>Nursing Care/Nursing Attendent</td>
                        @endif
                    </tr>
                    <tr>
                        <td>Location</td>
                        <td style="text-transform: capitalize;">{{$salary->area}}</td>
                    </tr>

                    @if(\App\Employee::where('employee_id',$salary->nurse_id)->get()->isEmpty())
                        <tr>
                            <td>Shift</td>
                            <td> 24 hrs(&nbsp;&nbsp;&nbsp;&nbsp;)/&nbsp;&nbsp; Day Shift(&nbsp;&nbsp;&nbsp;&nbsp;)
                                /&nbsp;&nbsp; Night Shift(&nbsp;&nbsp;&nbsp;&nbsp;)
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td>Month-Year</td>
                        <td>{{\Carbon\Carbon::create($salary->month_days)->format('F-Y')}}</td>
                    </tr>

                </table>
            </div>

            <div class="col-sm-6" >

            </div>
        </div>
        <div class="row ">
            <div class="col-sm-6">
                <table class="table">
                    <tr>
                        <th>EMOLUMENTS</th>
                        <th>Amounts(Rs.)</th>
                    </tr>
                    <tr>
                        <td>Basic Salary</td>
                        <td>{{$salary->basic}}</td>
                    </tr>
                    <tr>
                        <td>HRA</td>
                        <td>{{$salary->hra}}</td>
                    </tr>
                    <tr>
                        <td>Special Allowance</td>
                        <td>{{$salary->special_allowance}}</td>
                    </tr>
                    <tr>
                        <td>ESIC</td>
                        <td>{{$salary->esic??'NILL'}}</td>
                    </tr>

                    <tr>
                        <td>TA & DA</td>
                        <td>{{$salary->ta_da}}</td>
                    </tr>

                    <tr>
                        <td>Bonus</td>
                        <td>{{$salary->bonus}}</td>
                    </tr>
                    <tr>
                        <td>Advance Payment</td>
                        <td>{{$salary->advance}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-5">
                <table class="table ">
                    <tr>
                        <th>DEDUCTIONS</th>
                        <th>Amounts(Rs.)</th>
                    </tr>
                    <tr>
                        <td>Professional Tax(PT)</td>
                        <td>0.00</td>
                    </tr>
                    <tr>
                        <td>Tax Deducted at Source(TDS)</td>
                        <td>0.00</td>
                    </tr>
                    <tr>
                        <td>Other Deductions(Loans,etc)</td>
                        <td>0.00</td>
                    </tr>
                    <tr>
                        <td>Total Deduction</td>
                        <td>{{$salary->deduction}}</td>
                    </tr>

                </table>
                <table class="table" style="margin-top:45px;">
                    <tr>
                        <td>Net Pay</td>
                        <td>₹ {{$salary->net}}</td>
                    </tr>
                </table>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 pt-2">
                <table class="table ">
                    <tr>
                        <td>Payment Mode</td>
                        <td>BANK NEFT(&nbsp;&nbsp;&nbsp;&nbsp;)/ RTGS(&nbsp;&nbsp;&nbsp;&nbsp;)/ CASH(&nbsp;&nbsp;&nbsp;&nbsp;)
                            / CHEQUE(&nbsp;&nbsp;&nbsp;&nbsp;) / ACCOUNT PAY(&nbsp;&nbsp;&nbsp;&nbsp;)
                        </td>
                    </tr>
                </table>
            </div>

        </div>

        <div style="font-size: 18px; margin-top: 100px">
            <div class="row">
                <div class="col-sm-2">Authorized by</div>
                <div class="col-sm-8"></div>
                <div class="col-sm-2">Received by</div>
            </div>
            <br>

        </div>

    </div>
    <div class="row justify-content-center" style="background-color: #85D534;color: white; padding: 8px; margin-top:60px">
        <div><h3 class="text-center">www.aarogyahomecare.in Tel: +91 9435960652</h3></div>
    </div>
</div>
</body>
</html>
