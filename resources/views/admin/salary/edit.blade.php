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
        <form action="{{ route('admin.salary.update',$salary->id)}}" method="POST">
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
                <input type="number" value="{{$salary->basic}}" name="basic" class="form-control" />
            </div>
            <div class="form-group font-weight-bold">
                <label for="full_day">Total Days of Duty 24hrs</label>
                <input type="number"value="{{$salary->full_day}}" name="full_day" class="form-control"/>
            </div>
            <div class="form-group font-weight-bold">
                <label for="half_day">Total Days of Duty 12hrs</label>
                <input type="number" value="{{$salary->half_day}}" name="half_day" class="form-control"/>
            </div>
            <div class="form-group font-weight-bold">
                <label for="special_allowance">Special Allowance</label>
                <input type="number" value="{{$salary->special_allowance}}" name="special_allowance" class="form-control"/>
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
                <label for="advance">Advance Payment</label>
                <input type="number" value="{{$salary->advance}}" name="advance" class="form-control"/>
            </div>

            @if($nurse->permanent == 1)
                <div class="form-group font-weight-bold">
                    <label for="pf">PF</label>
                    <input type="number" value="{{$salary->pf}}" name="pf" class="form-control"/>
                </div>
            @endif

            <button class="btn btn-primary" type="submit">Update Details</button>

        </form>
    </div>

@endsection
