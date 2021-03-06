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
@section('style')
    <style>
        * {
            font-size: 14px;
            font-family: sans-serif;!important;
        }
        .contact{
            color: white;
            transition: all .6s;
        }
        .contact:hover{
            background-color: white;
            color: black;
        }
        p,.f {
            font-size: 20px;
        }
    </style>
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
        <div class="carousel-inner item-centered" >
            <div class="carousel-item active d-flex justify-content-center align-content-center align-items-center" style="background-image: linear-gradient(to bottom, rgba(50,50,53,0.52), rgba(47,43,47,0.73)), url({{asset('img/moto1.jpg')}}); background-size: cover; height: 500px">
                <div class="row" >
                    <div class="col-sm-12 text-center" >
                        <h1 class="font-weight-bold border p-3 contact">Services</h1>
                        <h3 class="text-white">Our Valuable Services</h3>
                    </div>
                </div>
            </div>
        </div>

    </div>



{{--    <!--Nursing about-->--}}
{{--    <div class="block block-secondary app-iphone-block p-0  ">--}}
{{--        <div class="container-fluid text-center">--}}
{{--            @foreach($services as $service)--}}
{{--                <div class="row p-4 text-center">--}}
{{--                    <div class="col-md-6" data-aos="fade-right"  data-aos-delay="300" >--}}
{{--                        <img style="border: 15px solid #555;" src="{{asset("/storage/".$service->cover)}}" alt="" width="80%">--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6 pt-5 pb-2  about"  data-aos="fade-left"  data-aos-delay="300">--}}
{{--                        <h3 class="font-weight-bold">{{$service->title}}</h3>--}}
{{--                        <p> {{$service->details}}</p>--}}
{{--                        <p><strong>{{$service->list}}</strong></p>--}}
{{--                        <a  href="{{route('users.patient.create')}}" class="btn profile-edit-btn p-3">--}}
{{--                            Send Request--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <hr>--}}
{{--            @endforeach--}}

{{--        </div>--}}
{{--    </div>--}}
{{--    <!--Nursing end-->--}}
    <!--Nursing about-->
        <div class="block block-secondary app-iphone-block p-0  ">
            <div class="container ">
                <div class="row ">

                    <div class="col-md-12 pt-5 pb-2  about ">
                        <div class="row pb-4">
                            <h2 class="font-weight-bold " >​Home Care Nursing Service :</h2>
                            <p style="font-size: 20px;">
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
                            <h2 class="font-weight-bold ">Caregivers/attendant :</h2>
                            <p>
                                Caregivers offer reliable assistance and support with activities of daily living on
                                shift basis. Our assertive staff is trained to follow an individualized plan of care for
                                each client.
                            </p>
                        </div>
                        <div class="row pb-4">
                            <div class="col-12 p-0"><h2 class="font-weight-bold">Caregivers/Attendant Offer :</h2></div>
                            <div class="col-12">

                                <ul class="f">
                                    <li class="f">Medicationders.</li>
                                    <li class="f">Bathing : bed baths, tub baths or showers</li>
                                    <li class="f">Dressing, grooming & toileting.</li>
                                    <li class="f">Dressing, grooming & toileting.</li>
                                    <li class="f">Escorting clients to appointment & outing.</li>
                                    <li class="f">Mobility/Ambulation stair, wheel chairs & walkers.</li>
                                    <li class="f">Nutrition assistance with eating.</li>
                                    <li class="f">Physical exercises: Active or passive range of motion.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row pb-4">
                            <div class="col-12 p-0"><h2 class="font-weight-bold">Benefits :</h2></div>
                            <div class="col-12">

                                <ul class="f">
                                    <li class="f">Time benefit.</li>
                                    <li class="f">Save money</li>
                                    <li class="f">Easy for patient with limited mobility.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Nursing end-->
{{--    <div class="block block-inverse block-secondary app-code-block p-3 bg-dark container-fluid">--}}
{{--        <div class="container counters-container text-center">--}}
{{--            <h4 class="text-white">IN YOUR PLACE</h4>--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-4 p-2">--}}
{{--                    <i class="fas fa-user-nurse fa-4x fa "></i>--}}
{{--                    <h4 class="counter font-weight-bold p-2 text-white" >{{$patients_count}}</h4>--}}
{{--                    <h5 class="text-white">Total Nurse</h5>--}}
{{--                </div>--}}
{{--                <div class="col-md-4 p-2">--}}
{{--                    <i class="fas fa-user-nurse fa-4x fa"></i>--}}
{{--                    <h4 class="counter font-weight-bold p-2 text-white">{{$nurses_count}}</h4>--}}
{{--                    <h5 class="text-white">Available Nurse</h5>--}}
{{--                </div>--}}
{{--                <div class="col-md-4 p-2">--}}
{{--                    <i class="fas fa-user-nurse fa-4x fa"></i>--}}
{{--                    <h4 class="counter font-weight-bold p-2 text-white">{{$nurses_active_count}}</h4>--}}
{{--                    <h5 class="text-white">In Work</h5>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!--Count nurces end-->


{{--    <!--our services-->--}}
{{--    <div class="text-center m-5">--}}
{{--        <h2>OUR VALUABLE SERVICES</h2>--}}
{{--        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}
{{--    </div>--}}
{{--        --}}
{{--    <div class="container p-5" >--}}
{{--        <div class="row text-center">--}}
{{--            <div class="col-lg-6 " data-aos="zoom-in" data-aos-delay="400" style="border-right: 1px solid #555; border-bottom: 1px solid #555">--}}
{{--                <i class="fa fa-stethoscope" aria-hidden="true"></i>--}}
{{--                <h4>24 Hour Support</h4>--}}
{{--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}
{{--            </div>--}}
{{--            <div class="col-lg-6 "  data-aos="zoom-in" data-aos-delay="400" style=" border-bottom: 1px solid #555">--}}
{{--                <i class="fa fa-user-md" aria-hidden="true"></i>--}}
{{--                <h4>Medical Counseling</h4>--}}
{{--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}
{{--            </div>--}}
{{--            <div class="col-lg-6 "  data-aos="zoom-in" data-aos-delay="400" style="border-right: 1px solid #555;">--}}
{{--                <i class="fa fa-ambulance" aria-hidden="true"></i>--}}
{{--                <h4>Emergency Services</h4>--}}
{{--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}
{{--            </div>--}}
{{--            <div class="col-lg-6 "  data-aos="zoom-in" data-aos-delay="400">--}}
{{--                <i class="fa fa-medkit" aria-hidden="true"></i>--}}
{{--                <h4>Premium Healthcare</h4>--}}
{{--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!--End services-->--}}
{{--        --}}
{{--    <!--Package section-->--}}
{{--    <div class="container-fluid bg-light">--}}
{{--        <div class="container-fluid text-center">--}}
{{--            <h1 class=" mb-0 p-4 text-uppercase">Available Packages</h1>--}}

{{--            <div class="row align-items-center justify-content-center">--}}

{{--                @foreach($prices as $price)--}}
{{--                <div class="col-sm-12 col-lg-4 p-5"  data-aos="flip-up" data-aos-delay="400" >--}}
{{--                    <div class="card">--}}

{{--                        <div class="card__side card__side--front">--}}
{{--                            <!-- Front Content -->--}}
{{--                            <div class="plan">--}}
{{--                                <div class="plan-inner">--}}
{{--                                    <div class="entry-title">--}}
{{--                                        <h3 class="text-white">{{$price->name}}</h3>--}}
{{--                                        <div class="price">{{$price->days}}<span>Days</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="entry-content">--}}
{{--                                        <ul>--}}
{{--                                            <li><strong><h2>{{$price->timing}}</h2></strong></li>--}}
{{--                                            <li><strong><h2>₹ {{$price->price}}</h2></strong></li>--}}
{{--                                            <li><strong><h2>{{$price->period}}</h2></strong></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--                @endforeach--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!--Package section end-->--}}

    </div>

@endsection
