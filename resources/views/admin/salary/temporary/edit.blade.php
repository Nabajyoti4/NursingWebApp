@extends('layouts.admin')
@section('title')
    Edit Nurse Salary
@endsection

@section('links')

    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <link href="{{asset('css/error.css')}}" rel="stylesheet">

@endsection
@section('content')


    <div class="container emp-profile mt-3 mb-5">
        <form action="{{ route('admin.salary.temporaryUpdate',$salary->id)}}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group font-weight-bold">
                <label for="nurse_id">Nurse Employee ID</label>
                <select name="nurse_id" class="form-control @error('nurse_id') is-invalid @enderror">
                    <option class="form-control" value="{{$salary->nurse_id}}" selected>{{$salary->nurse_id}}</option>
                </select>
                @error('nurse_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="basic">Basic Salary</label>
                <input type="number" value="{{$salary->basic}}" name="basic"
                       class="form-control @error('basic') is-invalid @enderror"/>
                @error('basic')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="shift">Shift</label>
                <select name="shift" class="form-control @error('shift') is-invalid @enderror" required>
                    <option class="form-control" value="{{$salary->shift}}" selected>{{$salary->shift}}</option>
                    <option class="form-control" value="24 hrs">24 hrs</option>
                    <option class="form-control" value="Day">Day</option>
                    <option class="form-control" value="Night">Night</option>
                </select>
                @error('shift')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="per_day_rate">Per Day Rate</label>
                <input type="number" value="{{$salary->per_day_rate}}" disabled name="per_day_rate"
                       class="form-control"/>

            </div>
            <div class="form-group font-weight-bold">
                <label for="full_day">Total Days of Duty 24hrs</label>
                <input type="number" value="{{$salary->full_day}}" name="full_day"
                       class="form-control @error('full_day') is-invalid @enderror"/>
                @error('full_day')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="half_day">Total Days of Duty 12hrs</label>
                <input type="number" value="{{$salary->half_day}}" name="half_day"
                       class="form-control @error('half_day') is-invalid @enderror"/>
                @error('half_day')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="month_days">Month Days</label>
                <input type="month" name="month_days" value="{{$salary->month_days}}"
                       class="form-control @error('month_days') is-invalid @enderror"/>
                @error('month_days')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="special_allowance">Special Allowance</label>
                <input type="number" value="{{$salary->special_allowance}}" name="special_allowance"
                       class="form-control @error('special_allowance') is-invalid @enderror"/>
                @error('special_allowance')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="ta_da">TA & DA</label>
                <input type="number" value="{{$salary->ta_da}}" name="ta_da"
                       class="form-control @error('ta_da') is-invalid @enderror"/>
                @error('ta_da')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="hra">HRA</label>
                <input type="number" value="{{$salary->hra}}" name="hra"
                       class="form-control @error('hra') is-invalid @enderror"/>
                @error('hra')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="bonus">Bonus</label>
                <input type="number" value="{{$salary->bonus}}" disabled name="bonus" class="form-control"/>

            </div>
            <div class="form-group font-weight-bold">
                <label for="advance">Advance Payment</label>
                <input type="number" value="{{$salary->advance}}" name="advance"
                       class="form-control @error('advance') is-invalid @enderror"/>
                @error('advance')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="total">Total Salary</label>
                <input type="number" value="{{$salary->total}}" disabled name="total" class="form-control "/>
            </div>
            <div class="form-group font-weight-bold">
                <label for="deduction">Deduction </label>
                <input type="number" value="{{$salary->deduction}}" disabled name="deduction" class="form-control"/>

            </div>
            <div class="form-group font-weight-bold">
                <label for="net">Net Payment</label>
                <input type="number" value="{{$salary->net}}" disabled name="net" class="form-control"/>
            </div>
            <div class="form-group font-weight-bold">
                <label for="area">Area</label>
                <select name="area" class="form-control @error('area') is-invalid @enderror">
                    <option class="form-control" value="{{$salary->area}}" selected>{{$salary->area}}</option>
                    <option class="form-control" value="DIBRUGARH, ASSAM">DIBRUGARH, ASSAM</option>
                    <option class="form-control" value="SIVASAGAR, ASSAM">SIVASAGAR, ASSAM</option>
                    <option class="form-control" value="JORHAT, ASSAM">JORHAT, ASSAM</option>
                </select>
                @error('area')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="remarks">Remarks</label>
                <input type="text" value="{{$salary->remarks}}" name="remarks"
                       class="form-control @error('remarks') is-invalid @enderror"/>
                @error('remarks')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="payment_received_date">Payment Received Date</label>
                <input type="text" value="{{$salary->payment_received_date}}" name="payment_received_date"
                       class="form-control @error('payment_received_date') is-invalid @enderror"/>
                @error('payment_received_date')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="payment_mode">Payment Mode</label>
                <select name="payment_mode" class="form-control @error('payment_mode') is-invalid @enderror">
                    <option class="form-control" value="{{$salary->payment_mode}}" selected>{{$salary->payment_mode}}</option>
                    <option class="form-control" value="BANK NEFT">BANK NEFT</option>
                    <option class="form-control" value="RTGS">RTGS</option>
                    <option class="form-control" value="CASH">CASH</option>
                    <option class="form-control" value="CHEQUE">CHEQUE</option>
                    <option class="form-control" value="ACCOUNT PAY">ACCOUNT PAY</option>
                </select>
                @error('payment_mode')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn btn-primary" type="submit">Update Details</button>

        </form>
    </div>

@endsection
