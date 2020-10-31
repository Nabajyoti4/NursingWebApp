@extends('layouts.admin')
@section('title')
    Create Nurse Salary
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
                <select name="nurse_id" class="form-control @error('nurse_id') is-invalid @enderror">
                    <option class="form-control" value="" selected>Select Nurse</option>
                    @foreach($nurses as $nurse)
                        <option class="form-control" value="{{$nurse->id}}">{{$nurse->employee_id}}</option>
                    @endforeach</select>
                @error('nurse_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="basic">Basic Salary</label>
                <input type="number" name="basic" class="form-control @error('basic') is-invalid @enderror"/>
                @error('basic')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="month_days">Month</label>
                <input type="month" name="month_days" class="form-control @error('month_days') is-invalid @enderror"/>
                @error('month_days')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="full_day">Total Days of Duty 24hrs</label>
                <input type="number" name="full_day" class="form-control @error('full_day') is-invalid @enderror"/>
                @error('full_day')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="half_day">Total Days of Duty 12hrs</label>
                <input type="number" name="half_day" class="form-control @error('half_day') is-invalid @enderror"/>
                @error('half_day')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group font-weight-bold">
                <label for="special_allowance">Special Allowance</label>
                <input type="number" name="special_allowance"
                       class="form-control @error('special_allowance') is-invalid @enderror"/>
                @error('special_allowance')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group font-weight-bold">
                <label for="ta_da">TA & DA</label>
                <input type="number" name="ta_da" class="form-control @error('ta_da') is-invalid @enderror"/>
                @error('ta_da')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group font-weight-bold">
                <label for="hra">HRA</label>
                <input type="number" name="hra" class="form-control @error('hra') is-invalid @enderror"/>
                @error('hra')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group font-weight-bold">
                <label for="advance">Advance Payment</label>
                <input type="number" name="advance" class="form-control @error('advance') is-invalid @enderror"/>
                @error('advance')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            @if($permanent == 1)
                <div class="form-group font-weight-bold">
                    <label for="pf">PF</label>
                    <input type="number" name="pf" class="form-control @error('pf') is-invalid @enderror"/>
                    @error('pf')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            @endif

            <button class="btn btn-primary" type="submit">Create</button>

        </form>
    </div>

@endsection
