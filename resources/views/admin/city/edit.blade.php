@extends('layouts.admin')
@section('title')
    Edit District
@endsection

@section('links')

    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <link href="{{asset('css/error.css')}}" rel="stylesheet">

@endsection

@section('style')
@endsection

@section('content')

    <div class="container emp-profile mt-3">
        @include('partials.errors')
        <form action="{{ route('admin.city.update', $city->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="form-group font-weight-bold">
                <label for="city">District:</label>
                <input type="text" required class="form-control" name="city" value="{{$city->city}}" placeholder="Enter district">
            </div>

            <button class="btn btn-primary" type="submit">Edit</button>

        </form>
    </div>

@endsection
