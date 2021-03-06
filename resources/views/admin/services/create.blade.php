@extends('layouts.admin')
@section('title')
    Create Service
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
            background: white !important;
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

    <div class="container emp-profile mt-3 mb-5">
        @include('partials.errors')
        <form action="{{ route('admin.services.store')}}" method="POST" enctype="multipart/form-data">
            @csrf


            <div class="form-group font-weight-bold">
                <label for="title">Service:</label>
                <input required type="text" class="form-control" name="title"  placeholder="Enter service">
            </div>


            <div class="form-group font-weight-bold">
                <label for="details">Description:</label>
                <textarea required rows="5" cols="200" type="text" class="form-control" name="details"  placeholder="Enter details"></textarea>
            </div>

            <div class="form-group font-weight-bold">
                <label for="list">Services:</label>
                <textarea rows="3" cols="200"  type="text" class="form-control" name="list"  placeholder="Enter services"></textarea>
            </div>

            <div class="form-group font-weight-bold">
                <label for="cover">Upload Cover Pic: </label>
                <input required type="file" class="form-control" name="cover">
            </div>

            <br>
            <button class="btn btn-primary" type="submit">Create</button>

        </form>
    </div>

@endsection
