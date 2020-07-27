@extends('layouts.home')

@section('title')
    Services
@endsection

@section('links')
    <link href="{{asset('css/navbar.css')}}" rel="stylesheet">
    <link href="{{asset('css/toolkit-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/application-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
@endsection
@section('style')
    <style>

        * {
            font-style: inherit;
            font-size: 15px;
        }

        p, .f {
            font-size: 18px;
        }

        .hero {
            max-height: 500px;
        }
        .align-items-center{-ms-flex-align:center!important;align-items:center!important}
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
            <div class="carousel-inner item-centered" >
                <div class="carousel-item active d-flex justify-content-center align-content-center align-items-center" style="background-image: url({{asset('img/team.webp')}}); background-size: cover; height: 500px">
                    <div class="row" >
                          <div class="col-sm-12 text-center" >
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
                            <h2 class="font-weight-bold ">​Home Care Nursing Service :</h2>
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
                            <h2 class="font-weight-bold">Offer :</h2>
                            <ul class="f">
                                <li class="f">
                                    We specialize in: Enema, IV line, Dressings, Bed Sore Care, Ryles Tube Feeding,
                                    Tracheostomy, Suture Removal, Injections (IV, IM, SC), IV Infusion, Post Surgical
                                    Care,
                                    Home Ventillatory Care, Urine catheterization, Wound Care ​
                                </li>
                            </ul>
                        </div>
                        <div class="row pb-4">
                            <div class="col-12 p-0"><h2 class="font-weight-bold">Our Mission :</h2></div>
                            <div class="col-12">

                                <ul class="f">
                                    <li class="f">To provide high quality services to home bound patients in a
                                        responsible,
                                        compassionate
                                        manner.
                                    </li>
                                    <li class="f">To provide patient education when indicated to promote maintain and
                                        restore
                                        health.
                                    </li>
                                    <li class="f">To be advocates for patients right, respect and confidentiality.</li>
                                    <li class="f">To deliver service without regard, religion or national origin.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row pb-4">
                            <h2 class="font-weight-bold">​Home Care Nursing Service :</h2>
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
                            <h2 class="font-weight-bold"> ​Offer:</h2>
                            <ul class="f">
                                <li class="f">
                                    We specialize in: Enema, IV line, Dressings, Bed Sore Care, Ryles Tube Feeding,
                                    Tracheostomy, Suture Removal, Injections (IV, IM, SC), IV Infusion, Post Surgical
                                    Care, Home Ventillatory Care, Urine catheterization, Wound Care ​
                                </li>
                            </ul>
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

                <div class="row align-items-center justify-content-center">
                    @foreach($members as $member)
                        <div class="col-sm-12 col-lg-4 p-5">
                            <div class="car card w-75 ml-5 border-0 box">
                                <img class="card-img-top " src="{{asset('storage/'.$member->photo)}}" alt="Card image"
                                     style="width:100%">

                                <div class="card-body ">
                                    <h4 class="card-title text-dark"
                                        style="text-transform: capitalize">{{$member->name}}</h4>
                                    <h5 class="card-title text-dark"
                                        style="text-transform: capitalize">{{$member->designation}}</h5>
                                </div>
                                <div>
                                    <a href=""><i class="fab fa-facebook"></i></a>
                                    <i class="fab fa-instagram"></i>
                                    <i class="fab fa-google-plus-g"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div>
                    </div>
                </div>
            </div>
        </div>
        <!--card end-->


    </div>

@endsection
