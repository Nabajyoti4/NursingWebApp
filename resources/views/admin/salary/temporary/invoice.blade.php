<html>


<head>

    <link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="form-group font-weight-bold">
        <div class="row">
            <div class="col-6">Employee ID</div>
            <div class="col-6">{{$salary->nurse_id}}</div>
        </div>
        <div class="row">
            <div class="col-6">Basic Salary</div>
            <div class="col-6">{{$salary->basic}}</div>
        </div>
        <div class="row">
            <div class="col-6">Per Day Rate</div>
            <div class="col-6">{{$salary->per_day_rate}}</div>
        </div>
        <div class="row">
            <div class="col-6">Total Days of Duty 24hrs</div>
            <div class="col-6">{{$salary->full_day}}</div>
        </div>
        <div class="row">
            <div class="col-6">Total Days of Duty 12hrs</div>
            <div class="col-6">{{$salary->half_day}}</div>
        </div>
        <div class="row">
            <div class="col-6">Month-Year</div>
            <div class="col-6">{{$salary->month_days}}</div>
        </div>
        <div class="row">
            <div class="col-6">Special Allowance</div>
            <div class="col-6">{{$salary->special_allowance}}</div>
        </div>
        <div class="row">
            <div class="col-6">TA & DA</div>
            <div class="col-6">{{$salary->ta_da}}</div>
        </div>
        <div class="row">
            <div class="col-6">HRA</div>
            <div class="col-6">{{$salary->hra}}</div>
        </div>
        <div class="row">
            <div class="col-6">Bonus</div>
            <div class="col-6">{{$salary->bonus}}</div>
        </div>
        <div class="row">
            <div class="col-6">Advance Payment</div>
            <div class="col-6">{{$salary->advance}}</div>
        </div>
        <div class="row">
            <div class="col-6">Total Salary</div>
            <div class="col-6">{{$salary->total}}</div>
        </div>
        <div class="row">
            <div class="col-6">Deduction</div>
            <div class="col-6">{{$salary->deduction}}</div>
        </div>
        <div class="row">
            <div class="col-6">Net Payment</div>
            <div class="col-6">{{$salary->net}}</div>
        </div>
        <div class="row">
            <div class="col-6">Area</div>
            <div class="col-6">{{$salary->area}}</div>
        </div>
        <div class="row">
            <div class="col-6">Remarks</div>
            <div class="col-6">{{$salary->remarks}}</div>
        </div>
        <div class="row">
            <div class="col-6">Payment Received Date</div>
            <div class="col-6">{{$salary->payment_received_date}}</div>
        </div>
    </div>

</div>
</body>
</html>
