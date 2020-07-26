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
                    <img src="{{asset('img/slider-1.jpg')}}" alt="Chicago">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('img/team.webp')}}" alt="New York">
                </div>
            </div>


        </div>


        <!--Nursing about-->
        <div class="block block-secondary app-iphone-block p-0  ">
            <div class="container ">
                <div class="row ">

                    <div class="col-md-12 pt-5 pb-2  about">
                        <div class="row pb-4">
                            <h3 class="font-weight-bold">​Home Care Nursing Service :</h3>
                            <p>
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
                        <div class="row pb-4">
                            <h3 class="font-weight-bold">Offer :</h3>
                            <ul>
                                <li>
                                    We specialize in: Enema, IV line, Dressings, Bed Sore Care, Ryles Tube Feeding,
                                    Tracheostomy, Suture Removal, Injections (IV, IM, SC), IV Infusion, Post Surgical
                                    Care,
                                    Home Ventillatory Care, Urine catheterization, Wound Care ​
                                </li>
                            </ul>
                        </div>
                        <div class="row pb-4">
                            <div class="col-12 p-0"><h3 class="font-weight-bold">Our Mission :</h3></div>
                            <div class="col-12">

                                <ul>
                                    <li>To provide high quality services to home bound patients in a responsible,
                                        compassionate
                                        manner.
                                    </li>
                                    <li>To provide patient education when indicated to promote maintain and restore
                                        health.
                                    </li>
                                    <li>To be advocates for patients right, respect and confidentiality.</li>
                                    <li>To deliver service without regard, religion or national origin.</li>
                                </ul>
                            </div>
                        </div>

                        <div class="row pb-4">
                            <h3 class="font-weight-bold">​Home Care Nursing Service :</h3>
                            <p>We render nursing service to the elderly home bound, post operative, partiality chronic
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
                        <div class="row pb-4">
                            <h3 class="font-weight-bold"> ​Offer:</h3>
                            <ul>
                                <li>We specialize in: Enema, IV line, Dressings, Bed Sore Care, Ryles Tube Feeding,
                                    Tracheostomy, Suture Removal, Injections (IV, IM, SC), IV Infusion, Post Surgical
                                    Care,
                                    Home
                                    Ventillatory Care, Urine catheterization, Wound Care ​
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Nursing end-->
        <!-- Card our team -->
        <div class="container-fluid team-background pr-0 pl-0">
            <div class="container-fluid text-center card team-background-transparent">
                <h1 class=" mb-0 p-4 text-uppercase text-white"> Our Team</h1>

                <div class="row align-items-center">

                    <div class="col-sm-12 col-lg-4 p-5">
                        <div class="car card w-75 ml-5 border-0 box">
                            <img class="card-img-top " src="{{asset('img/a2.webp')}}" alt="Card image" style="width:100%">

                            <div class="card-body ">
                                <h4 class="card-title text-dark">John Doe</h4>
                                <h5 class="card-title text-dark">Designation</h5>
                                <a href="#" class="btn btn-primary">See Profile</a>
                            </div>
                            <div>
                                <a href=""><i class="fab fa-facebook"></i></a>
                                <i class="fab fa-instagram"></i>
                                <i class="fab fa-google-plus-g"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-4 p-5">
                        <div class="car card w-75 ml-5 border-0 box">
                            <img class="card-img-top" src="{{asset('img/a2.webp')}}" alt="Card image" style="width:100%">
                            <div class="card-body ">
                                <h4 class="card-title text-dark">John Doe</h4>
                                <h5 class="card-title text-dark">Designation</h5>
                                <a href="#" class="btn btn-primary">See Profile</a>
                            </div>
                            <div>
                                <a href=""><i class="fab fa-facebook"></i></a>
                                <i class="fab fa-instagram"></i>
                                <i class="fab fa-google-plus-g"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-4 p-5">
                        <div class="car card w-75 ml-5 border-0 box">
                            <img class="card-img-top" src="{{asset('img/a2.webp')}}" alt="Card image" style="width:100%">
                            <div class="card-body ">
                                <h4 class="card-title text-dark">John Doe</h4>
                                <h5 class="card-title text-dark">Designation</h5>
                                <a href="#" class="btn btn-primary">See Profile</a>
                            </div>
                            <div>
                                <a href=""><i class="fab fa-facebook"></i></a>
                                <i class="fab fa-instagram"></i>
                                <i class="fab fa-google-plus-g"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                    </div>
                </div>
                <div class="p-3">
                    <button type="button" class=" btn btn-primary">SELL ALL</button>
                </div>
            </div>
        </div>
        <!--card end-->


    </div>

@endsection
