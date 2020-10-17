@extends('layouts.admin')
@section('title')
    Edit Role
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
        <form action="{{ route('admin.role.update', $role->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="form-group font-weight-bold">
                <label for="name">Role:</label>
                <input type="text" class="form-control" name="role" value="{{$role->role}}" placeholder="Enter Role">
            </div>

            <button class="btn btn-primary" type="submit">Update</button>

        </form>
    </div>

@endsection
