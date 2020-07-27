@extends('layouts.admin')
@section('title')
    Edit Service Price
@endsection

@section('links')

    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <link href="{{asset('css/error.css')}}" rel="stylesheet">

@endsection

@section('style')
    <style>
        .header {
            position: absolute;
            top: -14px;
            left: 1%;
            padding: 0% 2px;
            margin: 0%;
            background: white!important;
        }

        .borderdiv {
            position: relative;
            padding: 32px;
            border-radius: 10px;
            border: 2px solid #75b3e2;
            margin-top: 2rem;
        }
    </style>
@endsection

@section('content')

    <div class="container emp-profile mt-3">
        @include('partials.errors')
        <form action="{{ route('admin.price.update', $price->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group font-weight-bold">
                <label for="name">Service Type:</label>
                <input type="text" class="form-control" value="{{$price->name}}" name="name" placeholder="Enter Name">
            </div>

            <div class="form-group font-weight-bold">
                <label for="days">No Of Days : </label>
                <input type="number" class="form-control" value="{{$price->days}}"  name="days" placeholder="Enter days">
            </div>

            <div class="form-group font-weight-bold">
                <label for="timing">Timings:</label>
                <input type="text" class="form-control" name="timing" value="{{$price->timing}}" placeholder="Enter timing eg : 6 AM to 7 PM">
            </div>

            <div class="form-group font-weight-bold">
                <label for="price">Price Per month:</label>
                <input type="number" class="form-control" name="price" value="{{$price->price}}"  placeholder="Enter price">
            </div>

            <div class="form-group font-weight-bold">
                <label for="period">Period (Day/night/full):</label>
                <input type="text"  class="form-control" name="period" value="{{$price->period}}" placeholder="enter period">
            </div>


            <button class="btn btn-primary" type="submit">Create</button>

        </form>
    </div>

@endsection
