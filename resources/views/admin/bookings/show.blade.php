@extends('layouts.admin')
@section('title')
    Nurse Profile
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
            background: rgb(242, 247, 250) !important;
        }

        .font {
            display: inline-block;
            width: 105px;
        }

        h4 {
            text-transform: initial;
        }

        span {
            text-transform: capitalize;
        }

        .borderdiv {
            position: relative;
            top: -20px;
            padding: 32px;

            border-radius: 10px;
            box-shadow: 10px 10px 5px #aaaaaa;
            margin-top: 2rem;
        }

    </style>
@endsection

@section('content')
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Booking Details Of {{$book->patient->patient_name}}</h6>
    </div>
    <div class="container p-3">

        <div class="row bg-light" >

            <div class="col-xs-12 col-lg-12 ">
                <div>

                    <!--Patient info-->
                    <div class="borderdiv bg-white">
                        <h5 class="header font-weight-bold bg-white">Patient details</h5>

                        <div class="row">
                            <div class="col-lg-4">
                        <img
                            src="{{ $book->patient->photo_id?asset("/storage/".$book->patient->photo->photo_location) :'http://placehold.it/64x64'}}"
                            width="100%" alt="avatar">
                            </div>

                            <div class="col-lg-8">
                        <div>
                            <h5 class="font">Name</h5>
                            <span>: {{$book->patient->patient_name}}</span>
                        </div>
{{--                        <div>--}}
{{--                            <h5 class="font">Street</h5>--}}
{{--                            <span>: {{$nurse->user->addresses->last() ? $nurse->user->addresses->last()->street : ""}}</span>--}}
{{--                        </div>--}}

                            </div>
                        </div>

                    </div>

                    <!--client or User info-->
                    <div class="borderdiv bg-white">
                        <h5 class="header font-weight-bold bg-light">Client details</h5>

                        <div class="row bg-white">
                            <div class="col-lg-4">
                                <img
                                    src="{{ $book->user->photo?asset("/storage/".$book->user->photo->photo_location) :'http://placehold.it/64x64'}}"
                                    width="100%" alt="avatar">
                            </div>

                            <div class="col-lg-8">
                                <div>
                                    <h5 class="font">Name</h5>
                                    <span>: {{$book->user->name}}</span>
                                </div>
{{--                                <div>--}}
{{--                                    <h5 class="font">Street</h5>--}}
{{--                                    <span>: {{$nurse->user->addresses->last() ? $nurse->user->addresses->last()->street : ""}}</span>--}}
{{--                                </div>--}}
                            </div>
                        </div>

                    </div>


                    <!--Nurse Allotef for patient info-->
                    <div class="borderdiv bg-white">
                        <h5 class="header font-weight-bold bg-light">Nurse Alloted</h5>

                        <div class="row bg-white">
                            <div class="col-lg-4">
                                <img
                                    src="{{ $book->nurse->user->photo?asset("/storage/".$book->nurse->user->photo->photo_location) :'http://placehold.it/64x64'}}"
                                    width="100%" alt="avatar">
                            </div>

                            <div class="col-lg-8">
                                <div>
                                    <h5 class="font">Name</h5>
                                    <span>: {{$book->nurse->user->name}}</span>
                                </div>
{{--                                <div>--}}
{{--                                    <h5 class="font">Street</h5>--}}
{{--                                    <span>: {{$nurse->user->addresses->last() ? $nurse->user->addresses->last()->street : ""}}</span>--}}
{{--                                </div>--}}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>





@endsection
