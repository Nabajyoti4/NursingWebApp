@extends('layouts.admin')
@section('title')
    Edit Rating
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
        <form action="{{ route('admin.rating.update', $rating->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group font-weight-bold">
                <label for="name">Full Name:</label>
                <input type="text" class="form-control" value="{{$rating->name}}" name="name" placeholder="Enter Name">
            </div>

            <div class="form-group font-weight-bold">
                <label for="star">Stars:</label>
                <input type="number" min="1" max="5"  value="{{$rating->star}}" class="form-control" name="star" placeholder="Enter rating between 1 to 5">
            </div>

            <div class="form-group font-weight-bold">
                <label for="remark">Remark :</label>
                <textarea type="text" class="form-control" name="remark"  placeholder="remark">{{$rating->remark}}</textarea>
            </div>

            <div class="form-group font-weight-bold">
            <img src="{{asset("/storage/".$rating->photo)}}" alt="" width="200" height="200"/>
            </div>

            <div class="form-group font-weight-bold">
                <label for="photo">Upload Profile Pic: </label>
                <input type="file" class="form-control" name="photo">
            </div>


            <button class="btn btn-primary" type="submit">Update</button>

        </form>
    </div>

@endsection
