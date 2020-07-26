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
        <form action="{{ route('admin.teams.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group font-weight-bold">
                <label for="name">Member Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"/>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="designation">Designation</label>
                <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror"/>
                @error('designation')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group font-weight-bold">
                <label for="photo">Photo</label>
                <input type="file" name="photo" class="form-control-file @error('photo') is-invalid @enderror"/>
                @error('photo')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Create</button>

        </form>
    </div>

@endsection
