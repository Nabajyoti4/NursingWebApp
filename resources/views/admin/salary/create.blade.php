@extends('layouts.admin')
@section('title')
    Create Nurse
@endsection

@section('links')

    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <link href="{{asset('css/error.css')}}" rel="stylesheet">

@endsection
@section('content')


    <div class="container emp-profile mt-3 mb-5">
        <form action="{{ route('admin.salary.store')}}" method="POST">
            @csrf
            <div class="form-group font-weight-bold">
                <label for="nurse_id">Nurse Employee ID</label>
                <select name="nurse_id" class="form-control">
                    <option class="form-control" value="" selected>Select Nurse</option>
                    @foreach($nurses as $nurse)
                        <option class="form-control" value="{{$nurse->id}}">{{$nurse->employee_id}}</option>
                    @endforeach</select>
            </div>
            <div class="form-group font-weight-bold">
                <label for="basic">Basic Salary</label>
                <input type="number" name="basic" class="form-control"/>
            </div>
            @if($permanent == 1)
                <div class="form-group font-weight-bold">
                    <label for="full_day">Total Payable Days</label>
                    <input type="number" name="full_day" class="form-control"/>
                </div>
            @else
                <div class="form-group font-weight-bold">
                    <label for="full_day">Total Days of Duty 24hrs</label>
                    <input type="number" name="full_day" class="form-control"/>
                </div>
                <div class="form-group font-weight-bold">
                    <label for="half_day">Total Days of Duty 12hrs</label>
                    <input type="number" name="half_day" class="form-control"/>
                </div>
            @endif
            <div class="form-group font-weight-bold">
                <label for="month_days">Month Days</label>
                <input type="month" name="month_days" class="form-control"/>
            </div>
            <div class="form-group font-weight-bold">
                <label for="special_allowance">Special Allowance</label>
                <input type="number" name="special_allowance" class="form-control"/>
            </div>

            @if($permanent == 0)
                <div class="form-group font-weight-bold">
                    <label for="ta_da">TA & DA</label>
                    <input type="number" name="ta_da" class="form-control"/>
                </div>
            @endif

            <div class="form-group font-weight-bold">
                <label for="hra">HRA</label>
                <input type="number" name="hra" class="form-control"/>
            </div>

            <div class="form-group font-weight-bold">
                <label for="advance">Advance Payment</label>
                <input type="number" name="advance" class="form-control"/>
            </div>

            @if($permanent == 1)
                <div class="form-group font-weight-bold">
                    <label for="pf">PF</label>
                    <input type="number" name="pf" class="form-control"/>
                </div>
            @endif

            <button class="btn btn-primary" type="submit">Create</button>

        </form>
    </div>

@endsection
