@extends('layouts.admin')
@section('title')
    Edit Service
@endsection

@section('links')

    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <link href="{{asset('css/error.css')}}" rel="stylesheet">

@endsection


@section('content')

    <div class="container emp-profile mt-3">
        @include('partials.errors')
        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group font-weight-bold">
                <label for="title">Service:</label>
                <input type="text" class="form-control" value="{{$service->title}}" name="title"  placeholder="Enter service">
            </div>


            <div class="form-group font-weight-bold">
                <label for="details">Description:</label>
                <textarea rows="5" cols="200" type="text" class="form-control" name="details"  placeholder="Enter details">{{$service->details}}</textarea>
            </div>

            <div class="form-group font-weight-bold">
                <label for="list">Services:</label>
                <textarea rows="3" cols="200"  type="text" class="form-control" name="list"  placeholder="Enter services">{{$service->list}}</textarea>
            </div>

            <div class="form-group font-weight-bold">
                <label for="cover">Upload Cover Pic: </label>
                <input type="file" class="form-control" name="cover">
            </div>

            <br>
            <button class="btn btn-primary" type="submit">Update</button>

        </form>
    </div>

@endsection
