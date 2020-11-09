<html>


<head>
    <title>Salary Receipt</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<style>
    body {
        background-color: white;
    }

</style>
<body>
<div class="container">
    <div class="font-weight-bold ">
        <div class="row justify-content-center align-items-center">
            <!--header-->
            <div class="col-sm-2">
                <img src="{{asset('img/AArogya-new-edit-1.png')}}"
                     style="width: 150px; height: 60px; background: #fff; padding: 2px; border-radius: 4px; color: #28669F;"
                     alt="">
            </div>
            <div class="col-sm-8 text-center receipt-heading ">
                <h3 class="receipt-heading__sub font-weight-bold mt-5">AAROGYA HOME CARE NURSING SERVICE</h3>
                <h6 class="receipt-heading__description bold">HEAD OFFICE : MANDAKINI BIBAH BHAWAN COMPLEX, KOTOKY
                    PUKHURI,</h6>
                <h6 class="receipt-heading__description bold">BYE PASS TINI ALI, JORHAT</h6>
            </div>
            <div class="col-sm-2 text-right">
                Ph.No 9101786597 <br> 8753955565<br>6002450239
            </div>
        </div>
        <hr>
        <div class="row justify-content-center">
            <h3 style="font-weight: bold; padding: 10px;">Salary Slip</h3>
        </div>
        <div class="row ">
            <table class="table table-secondary border">
                <tr>
                    <td>Employee ID</td>
                    <td>{{$salary->nurse_id}}</td>
                </tr>
                <tr>
                    <td>Basic Salary</td>
                    <td>{{$salary->basic}}</td>
                </tr>
                <tr>
                    <td>Per Day Rate</td>
                    <td>{{$salary->per_day_rate}}</td>
                </tr>
                <tr>
                    <td>Total Days of Duty 24hrs/Day/Night</td>
                    <td>{{$salary->full_day}}</td>
                </tr>
                <tr>
                    <td>Total Days of Duty 12hrs/Day/Night</td>
                    <td>{{$salary->half_day}}</td>
                </tr>
                <tr>
                    <td>Month-Year</td>
                    <td>{{\Carbon\Carbon::create($salary->month_days)->format('F')}}</td>
                </tr>
                <tr>
                    <td>Special Allowance</td>
                    <td>{{$salary->special_allowance}}</td>
                </tr>
                <tr>
                    <td>TA & DA</td>
                    <td>{{$salary->ta_da}}</td>
                </tr>
                <tr>
                    <td>HRA</td>
                    <td>{{$salary->hra}}</td>
                </tr>
                <tr>
                    <td>Bonus</td>
                    <td>{{$salary->bonus}}</td>
                </tr>
                <tr>
                    <td>Advance Payment</td>
                    <td>{{$salary->advance}}</td>
                </tr>
                <tr>
                    <td>Total Salary</td>
                    <td>{{$salary->total}}</td>
                </tr>
                <tr>
                    <td>Deduction</td>
                    <td>{{$salary->deduction}}</td>
                </tr>
                <tr>
                    <td>Net Payment</td>
                    <td>{{$salary->net}}</td>
                </tr>
                <tr>
                    <td>Area</td>
                    <td>{{$salary->area}}</td>
                </tr>
                <tr>
                    <td>Remarks</td>
                    <td>{{$salary->remarks}}</td>
                </tr>
                <tr>
                    <td>Payment Received Date</td>
                    <td>{{$salary->payment_received_date}}</td>
                </tr>
            </table>

        </div>
        <table class="table text-center">
            <br><br>
            <br>
            <tr>
                <td>Authorized by</td>
                <td>Received by</td>
            </tr>
        </table>
        <div class="row justify-content-center">
            <h5 class="text-center">www.aarogyahomecare.in Tel: +91 9435960652</h5>
        </div>
    </div>

</div>
</body>
</html>
