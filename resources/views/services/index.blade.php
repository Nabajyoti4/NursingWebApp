@extends('layouts.home')

@section('title')
    Services
@endsection

@section('links')
    <link href="{{asset('css/navbar.css')}}" rel="stylesheet">
    <link href="{{asset('css/toolkit-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/application-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/service.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
@endsection

@section('content')

    <div class="container-fluid p-0">
    <div id="demo" class="carousel slide" data-ride="carousel">
        <!-- navbar start -->
        <div class="service-nav ">
        @include('partials.navbar')
        </div>
        <!-- navbar ends -->
        <!-- Indicators -->
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner hero">
            <div class="carousel-item active">
                <img src="{{asset('img/slider-1.jpg')}}" alt="Chicago" >
            </div>
            <div class="carousel-item">
                <img src="{{asset('img/team.webp')}}" alt="New York">
            </div>
        </div>

    </div>



    <!--Nursing about-->
    <div class="block block-secondary app-iphone-block p-0  ">
        <div class="container-fluid text-center">
            @foreach($services as $service)
                <div class="row p-4 text-center">
                    <div class="col-md-6" data-aos="fade-right"  data-aos-delay="300" >
                        <img style="border: 15px solid #555;" src="{{asset("/storage/".$service->cover)}}" alt="" width="80%">
                    </div>
                    <div class="col-md-6 pt-5 pb-2  about"  data-aos="fade-left"  data-aos-delay="300">
                        <h3 class="font-weight-bold">{{$service->title}}</h3>
                        <p> {{$service->details}}</p>
                        <p><strong>{{$service->list}}</strong></p>
                        <a  href="{{route('users.patient.create')}}" class="btn profile-edit-btn p-3">
                            Send Request
                        </a>
                    </div>
                </div>
                <hr>
            @endforeach

        </div>
    </div>
    <!--Nursing end-->





    <div class="block block-inverse block-secondary app-code-block p-3 bg-dark container-fluid">
        <div class="container counters-container text-center">
            <h4 class="text-white">IN YOUR PLACE</h4>
            <div class="row">
                <div class="col-md-4 p-2">
                    <i class="fas fa-user-nurse fa-4x fa "></i>
                    <h4 class="counter font-weight-bold p-2 text-white" data-target="2000">200</h4>
                    <h5 class="text-white">Total Nurse</h5>
                </div>
                <div class="col-md-4 p-2">
                    <i class="fas fa-user-nurse fa-4x fa"></i>
                    <h4 class="counter font-weight-bold p-2 text-white" data-target="300">120</h4>
                    <h5 class="text-white">Available Nurse</h5>
                </div>
                <div class="col-md-4 p-2">
                    <i class="fas fa-user-nurse fa-4x fa"></i>
                    <h4 class="counter font-weight-bold p-2 text-white" data-target="1000">80</h4>
                    <h5 class="text-white">In Work</h5>
                </div>
            </div>
        </div>
    </div>

    <!--Count nurces end-->


    <!--our services-->
    <div class="text-center m-5">
        <h2>OUR VALUABLE SERVICES</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>


    <div class="container p-5" >
        <div class="row text-center">
            <div class="col-lg-6 " data-aos="zoom-in" data-aos-delay="400" style="border-right: 1px solid #555; border-bottom: 1px solid #555">
                <i class="fa fa-stethoscope" aria-hidden="true"></i>
                <h4>24 Hour Support</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="col-lg-6 "  data-aos="zoom-in" data-aos-delay="400" style=" border-bottom: 1px solid #555">
                <i class="fa fa-user-md" aria-hidden="true"></i>
                <h4>Medical Counseling</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="col-lg-6 "  data-aos="zoom-in" data-aos-delay="400" style="border-right: 1px solid #555;">
                <i class="fa fa-ambulance" aria-hidden="true"></i>
                <h4>Emergency Services</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="col-lg-6 "  data-aos="zoom-in" data-aos-delay="400">
                <i class="fa fa-medkit" aria-hidden="true"></i>
                <h4>Premium Healthcare</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
        </div>
    </div>
    <!--End services-->



    <!--Package section-->
    <div class="container-fluid bg-light">
        <div class="container-fluid text-center">
            <h1 class=" mb-0 p-4 text-uppercase">Available Packages</h1>

            <div class="row align-items-center justify-content-center">

                @foreach($prices as $price)
                <div class="col-sm-12 col-lg-4 p-5"  data-aos="flip-up" data-aos-delay="400" >
                    <div class="card">

                        <div class="card__side card__side--front">
                            <!-- Front Content -->
                            <div class="plan">
                                <div class="plan-inner">
                                    <div class="entry-title">
                                        <h3 class="text-white">{{$price->name}}</h3>
                                        <div class="price">{{$price->days}}<span>Days</span>
                                        </div>
                                    </div>
                                    <div class="entry-content">
                                        <ul>
                                            <li><strong><h2>{{$price->timing}}</h2></strong></li>
                                            <li><strong><h2>₹ {{$price->price}}</h2></strong></li>
                                            <li><strong><h2>{{$price->period}}</h2></strong></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    <!--Package section end-->

    </div>

@endsection
