@extends('layouts.home')

@section('title')
    About Us
@endsection

@section('links')
    <link href="{{asset('css/navbar.css')}}" rel="stylesheet">
    <link href="{{asset('css/toolkit-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/application-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <link rel="stylesheet" href="{{asset('css/team.css')}}"/>
@endsection
@section('style')
    <style>

        * {
            font-style: inherit;
            font-size: 15px;
            font-family: sans-serif;
        }


        .hero {
            max-height: 500px;
        }

        .align-items-center {
            -ms-flex-align: center !important;
            align-items: center !important
        }

        .item-centered {
            justify-content: center;
            align-content: center;
            align-items: center;
        }
    </style>
@endsection
@section('content')

    <div class="container-fluid p-0 ">
        <div id="demo" class="carousel slide hero" data-ride="carousel" style="max-height: 600px;">
            <!-- navbar start -->
            <div style="background-color: #4d6de4">
                @include('partials.navbar')
            </div>
            <!-- navbar ends -->

            <!-- The slideshow -->
            <div class="carousel-inner item-centered">
                <div class="carousel-item active d-flex justify-content-center align-content-center align-items-center"
                     style="background-image: linear-gradient(rgba(0,0,0,.5),rgba(0,0,0,.5)),url({{asset('img/team.webp')}}); background-size: cover; height: 500px">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h1 class="text-white font-weight-bold border p-3">ABOUT US</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--Nursing about-->
        <div class="block block-secondary app-iphone-block p-0  ">
            <div class="container ">
                <div class="row ">
                    <div class="col-md-12 pt-5 pb-2  about ">
                        <div class="row pb-4">
                            <h2 class="font-weight-bold ">​Aarogya Home Care Nursing Service:</h2>
                            <p style="font-size: 20px;">
                                A unit of GIYANMONY FOUNDATION registered under
                                Section 8 of Companies Act 2013
                                <br>Registered No. :U85100AS2021NPL021070, License No. :123920. <br>
                                We render nursing service to the elderly home bound, post operative, partiality chronic
                                and
                                terminally ill patient in their home environment.​This is targeted at patients who
                                require
                                24x7 assistance with personal care. Our nursing care takers will hep with the client’s
                                hygienic requirement, assist with mobilization, and help with feeding. they will also
                                play a
                                role in promoting the mental health of the client by occupying them with various
                                activities
                                when they are awake and up to it.
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--Nursing end-->

        <!-- Card our team -->
        <div class="container-fluid pr-0 pl-0" style="background-color: #4a4949;!important;">
            <div class="container-fluid text-center card bg-transparent">
                <h1 class=" mb-0 p-4 text-uppercase text-white"> Our Team</h1>

                <div class="row align-items-center justify-content-center p-5">
                    @foreach($members as $member)
                        <div class="col-sm-12 col-lg-4 " style="margin-bottom:20px;" data-aos="flip-right"
                             data-aos-delay="300">
                            <div class="themeioan_course">
                                <div class="blog-photo">
                                    <img style="width:100%;object-fit: cover;" height="250"
                                         class="card-img-top embed-responsive-item"
                                         src="{{asset('storage/'.$member->photo)}}" alt="Card image">
                                </div>
                                <div class="blog-content">
                                    <h5 class="title" style="text-transform: capitalize">{{$member->name}}
                                    </h5>
                                    <div class="title"
                                         style="text-transform: capitalize; color:grey;">{{$member->designation}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
        <!--card end-->
@endsection
