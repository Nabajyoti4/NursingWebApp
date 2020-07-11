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
        <form action="{{ route('admin.salary.temporaryUpdate',$salary->id)}}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group font-weight-bold">
                <label for="nurse_id">Nurse Employee ID</label>
                <select name="nurse_id" class="form-control">
                    <option class="form-control" value="{{$nurse->id}}" selected>{{$nurse->employee_id}}</option>
                </select>
            </div>
            <div class="form-group font-weight-bold">
                <label for="basic">Basic Salary</label>
                <input type="number" value="{{$salary->basic}}" name="basic" class="form-control"/>
            </div>
            <div class="form-group font-weight-bold">
                <label for="per_day_rate">Per Day Rate</label>
                <input type="number" value="{{$salary->per_day_rate}}" name="per_day_rate" class="form-control"/>
            </div>
            <div class="form-group font-weight-bold">
                <label for="full_day">Total Days of Duty 24hrs</label>
                <input type="number" value="{{$salary->full_day}}" name="full_day" class="form-control"/>
            </div>
            <div class="form-group font-weight-bold">
                <label for="half_day">Total Days of Duty 12hrs</label>
                <input type="number" value="{{$salary->half_day}}" name="half_day" class="form-control"/>
            </div>
            <div class="form-group font-weight-bold">
                <label for="special_allowance">Special Allowance</label>
                <input type="number" value="{{$salary->special_allowance}}" name="special_allowance"
                       class="form-control"/>
            </div>

            <div class="form-group font-weight-bold">
                <label for="ta_da">TA & DA</label>
                <input type="number" value="{{$salary->ta_da}}" name="ta_da" class="form-control"/>
            </div>

            <div class="form-group font-weight-bold">
                <label for="hra">HRA</label>
                <input type="number" value="{{$salary->hra}}" name="hra" class="form-control"/>
            </div>

            <div class="form-group font-weight-bold">
                <label for="bonus">Bonus</label>
                <input type="number" value="{{$salary->bonus}}" name="bonus" class="form-control"/>
            </div>

            <div class="form-group font-weight-bold">
                <label for="advance">Advance Payment</label>
                <input type="number" value="{{$salary->advance}}" name="advance" class="form-control"/>
            </div>

            <div class="form-group font-weight-bold">
                <label for="advance">Total Salary</label>
                <input type="number" value="{{$salary->total}}" disabled name="advance" class="form-control"/>
            </div>
            <div class="form-group font-weight-bold">
                <label for="advance">Deduction </label>
                <input type="number" value="{{$salary->deduction}}" disabled name="advance" class="form-control"/>
            </div>
            <div class="form-group font-weight-bold">
                <label for="advance">Net Payment</label>
                <input type="number" value="{{$salary->net}}" disabled name="advance" class="form-control"/>
            </div>
            <button class="btn btn-primary" type="submit">Update Details</button>

        </form>
    </div>

@endsection
