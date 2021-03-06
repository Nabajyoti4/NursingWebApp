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
        <form action="{{ route('admin.teams.update',$member->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
@method('PATCH')
            <div class="form-group font-weight-bold">
                <label for="name">Member Name</label>
                <input type="text" name="name" value="{{$member->name}}" class="form-control @error('name') is-invalid @enderror"/>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="designation">Designation</label>
                <input type="text" value="{{$member->designation}}" name="designation" class="form-control @error('designation') is-invalid @enderror"/>
                @error('designation')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <img src="{{asset('storage/'.$member->photo)}}" width="200" alt="">

            <div class="form-group font-weight-bold">
                <label for="photo">Photo</label>
                <input type="file" name="photo" class="form-control-file @error('photo') is-invalid @enderror"/>
                @error('photo')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Update</button>

        </form>
    </div>

@endsection
