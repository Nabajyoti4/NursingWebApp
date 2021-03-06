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
        <form action="{{ route('admin.city.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group font-weight-bold">
                <label for="city">District:</label>
                <input type="text" required class="form-control" name="city" value="{{old('city')}}" placeholder="Enter District">
            </div>

            <button class="btn btn-primary" type="submit">Create</button>

        </form>
    </div>

@endsection
