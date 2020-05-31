@extends('layouts.home')
@section('title')
    Homepage
@endsection
@section('content')
    <!-- header section starts -->
    <div class="p-1" style="background-image: url({{asset('img/navbar-back-1.jpg')}});background-repeat: no-repeat; background-size: cover">
        <!-- navbar start -->
        @include('partials.navbar')
        <!-- navbar ends -->

        <!-- carousel -->
        <div class="block block-secondary app-iphone-block bg-transparent">
            <div class="">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner ">
                        <!-- carousel item 1 -->
                        <div class="carousel-item carousel-width active item-centered ">
                            <div class="row item-centered col-lg-12">
                                <div class="col-sm-10 col-lg-12 text-center">
                                    <h1 class="block-titleData frequency text-center font-weight-bold display-4"
                                        style="color: white;">Hire a
                                        Nurse</h1>
                                    <p class="lead mb-4 text-muted text-center">We’re always here for you no matter what
                                        time of day.
                                    </p>
                                    <button class="btn btn-outline-primary btn-lg text-center">Hire now</button>
                                </div>
                            </div>
                        </div>

                        <!-- carousel item 2 -->
                        <div class="carousel-item carousel-width item-centered">
                            <!-- style="background-image: url('assets/img/startup-3.jpg'); background-repeat: no-repeat; background-position: center; background-size: cover;"> -->
                            <div class="row item-centered col-lg-12">
                                <div class="col-sm-10 col-lg-12 col-lg-6 text-center">
                                    <h1 class="block-titleData frequency text-center font-weight-bold display-4"
                                        style="color: white;">Work as
                                        Nurse or
                                        Caretaker.</h1>
                                    <p class="lead mb-4 text-muted text-center">Join the Team to help peoples.</p>
                                    <button class="btn btn-outline-primary btn-lg text-center">Join now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>
        </div>
        <!-- carousel ends -->
    </div>
    <!-- header section ends -->

    <!--Welcome section-->
    <div class="block block-secondary app-iphone-block">
        <div class="welcome_sewa">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="welcome_pic">
                            <div class="pic_first">
                                <img src="{{asset('img/1.jpg')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="welcome_text">
                            <h3>Welcome To
                                <span>Sewa Caretaking Services</span></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit, sed
                                do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                veni.</p>
                            <ul>
                                <li><i class="flaticon-verified"></i> Nursing Services</li>
                                <li><i class="flaticon-verified"></i> Caretakers</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Welcome section End-->

    <!-- counters -->
    <div class="block block-inverse block-secondary app-code-block p-4">
        <div class="container counters-container text-center">
            <div class="row">
                <div class="col-md-3 p-2">
                    <i class="fas fa-medkit fa-4x border rounded p-3"></i>
                    <h4 class="counter font-weight-bold p-2" data-target="3000">0</h4>
                    <h4>Clients Served</h4>
                </div>
                <div class="col-md-3 p-2">
                    <i class="fas fa-user-md fa-4x border rounded p-3"></i>
                    <h4 class="counter font-weight-bold p-2" data-target="2000">0</h4>
                    <h4>Caregivers Employed</h4>
                </div>
                <div class="col-md-3 p-2">
                    <i class="fas fa-user-nurse fa-4x border rounded p-3"></i>
                    <h4 class="counter font-weight-bold p-2" data-target="300">0</h4>
                    <h4>Active Caregivers</h4>
                </div>
                <div class="col-md-3 p-2">
                    <i class="fas fa-user-nurse fa-4x border rounded p-3"></i>
                    <h4 class="counter font-weight-bold p-2" data-target="1000">0</h4>
                    <h4>Caregivers Employed</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- counters ends -->

    <!--Services section-->
    <div class="services">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="services-wrap">
                        <h2>Our services</h2>

                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-12 box-service">
                                <div class="services-cont">
                                    <center>
                                        <header class="headings d-flex flex-wrap align-items-center">
                                            <i class="fa fa-user-md text-white mr-2 " aria-hidden="true"></i>
                                            <h3>Nurse Service</h3>
                                        </header>
                                    </center>

                                    <div class="entry-content"><em>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada
                                                lorem maximus mauris.</p>
                                        </em>
                                    </div>

                                    <footer class="more">
                                        <a href="#">read more</a>
                                    </footer>
                                </div>
                            </div>

                            <!-- <div class="col-12 col-md-6 col-lg-6 box-service">
                                <div class="services-cont">
                                    <header class="headings d-flex flex-wrap align-items-center">
                                      <i class="fa fa-wheelchair text-white mr-2" aria-hidden="true"></i>

                                        <h3>Caretakers</h3>
                                    </header>

                                    <div class="entry-content">
                                        <p>Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien.</p>
                                    </div>

                                    <footer class="more">
                                        <a href="#">read more</a>
                                    </footer>
                                </div>
                            </div> -->

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--services section end-->

    <!-- nurse moto -->
    <div class="block block-secondary app-iphone-block p-0  ">
        <div class="container text-center">
            <div class="row text-center">
                <div class="col-md-6">
                    <img src="{{asset('img/nurse-1.jpg')}}" alt="" width="100%">
                </div>
                <div class="col-md-6 pt-5 pb-5">
                    <h3>“A Nurse dispense comfort, compassion, and caring without even a prescription.”</h3>
                </div>
            </div>
        </div>
    </div>
    <!--Nurse moto end-->


    <!--NURSE RATING SLIDER-->
    <div class="block block-bordered-lg pl-0 pt-0 pr-0 rating-background">

        <div id="carousel-example-generic" class="carousel carousel-light slide" data-ride="carousel">


            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <div class="main-text  background-transparent">
                <div class="col-md-12 text-center">
                    <h1 class=" text-white mb-0 p-4 text-uppercase"> Our Top Service Providers</h1>
                </div>
            </div>

            <div class="carousel-inner" role="listbox">

                <div class="carousel-item active ">
                    <div class="block  background-transparent">
                        <div class="container item-center">

                            <div class="text-center p-3">
                                <img class="img-fluid rounded-circle img-thumbnail w-25 " src="{{asset('img/a2.png')}}">
                            </div>

                            <div class="text-center text-white  p-3">
                                <p class="mb-4 lead "><strong>Cindy Smith</strong>, Caretaker</p>
                                <i class="fa fa-star " aria-hidden="true"></i>
                            </div>


                            <div class="row">
                                <div class="col-sm-8 offset-sm-2">
                                    <h5 class="mx-auto text-center text-white"> “<em>
                                            Go Analytics is amazing. Decisions that used to take weeks, now only takes
                                            minutes and is
                                            available to everyone on my team.
                                        </em>”</h5>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="block background-transparent">
                        <div class="container">

                            <div class="text-center p-3">
                                <img class="img-fluid rounded-circle img-thumbnail w-25 " src="{{asset('img/a2.png')}}">
                            </div>

                            <div class="text-center text-white  p-3">
                                <p class="mb-4 lead "><strong>Cindy Smith</strong>, Caretaker</p>
                                <i class="fa fa-star " aria-hidden="true"></i>
                                <i class="fa fa-star " aria-hidden="true"></i>
                            </div>

                            <div class="row">
                                <div class="col-sm-8 offset-sm-2">
                                    <h5 class="mx-auto text-center text-white"> “<em>
                                            Go Analytics is amazing. Decisions that used to take weeks, now only takes
                                            minutes and is
                                            available to everyone on my team.
                                        </em>”</h5>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="block background-transparent">
                        <div class="container">

                            <div class="text-center p-3">
                                <img class="img-fluid rounded-circle img-thumbnail w-25 " src="{{asset('img/a2.png')}}">
                            </div>

                            <div class="text-center text-white  p-3">
                                <p class="mb-4 lead "><strong>Cindy Smith</strong>, Caretaker</p>
                                <i class="fa fa-star " aria-hidden="true"></i>
                            </div>

                            <div class="row">
                                <div class="col-sm-8 offset-sm-2">
                                    <h5 class="mx-auto text-center text-white"> “<em>
                                            Go Analytics is amazing. Decisions that used to take weeks, now only takes
                                            minutes and is
                                            available to everyone on my team.
                                        </em>”</h5>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="icon icon-chevron-thin-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="icon icon-chevron-thin-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <!--NURSE RATING SLIDER END-->

    <!--Business partners section-->
    <div class="block app-ribbon pt-3">
        <h1 class=" mb-0 text-center text-white text-uppercase"> Business partners</h1>
        <div class="container text-xs-center p-5">
            {{--            <img src="assets/img/startup-4.svg">--}}
            {{--            <img src="assets/img/startup-5.svg">--}}
            {{--            <img src="assets/img/startup-6.svg">--}}
            {{--            <img src="assets/img/startup-7.svg">--}}
            {{--            <img src="assets/img/startup-8.svg">--}}
        </div>
    </div>
    <!--Business partners section end-->

    <!-- address section start -->
    <div class="address-page-short-boxes">
        <div class="col-md-12 text-center">
            <h1 class=" mb-0 mb-5 text-uppercase">Contact Us</h1>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 mt-5 mt-lg-0">
                    <div class="address-location h-100">
                        <h2 class="d-flex align-items-center">Head Office</h2>
                        <ul class="p-0 m-0">
                            <li>Mandakini Bibah Bhawan complex, Bye Pass Tini Ali, Jorhat- 785006, Assam.</li>
                            <li>Call: 9435960652, 9101786597, ​9531339627</li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-md-4 mt-5 mt-lg-0">
                    <div class="address-location h-100">
                        <h2 class="d-flex align-items-center">Branch Office (Sivsagar)</h2>

                        <ul class="p-0 m-0">
                            <li>Old Amulapatty, Ganak Patty, By Lane No. 6, Assam.</li>
                            <li>Call: 9435960652, 9101786597, 8876243001</li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-md-4 mt-5 mt-lg-0">
                    <div class="address-location h-100">
                        <h2 class="d-flex align-items-center">Branch Office(Dibrugarh</h2>

                        <ul class="p-0 m-0">
                            <li>Sashanpara Road, Near Sankar Dev Hospital, Mancotta Road.</li>
                            <li>Call: 9435960652, 8753955565</li>
                        </ul>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="address-form">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Mail Us For Enquiry</h2>
                </div>

                <div class="col-12  col-md-4">
                    <input type="text" placeholder="Name">
                </div>

                <div class="col-12 col-md-4">
                    <input type="email" placeholder="E-mail">
                </div>

                <div class="col-12 col-md-4">
                    <input type="text" placeholder="Subject">
                </div>

                <div class="col-12">
                    <textarea name="name" rows="12" cols="80" placeholder="Message"></textarea>
                </div>

                <div class="col-12">
                    <input type="submit" name="" value="Send Message" class="button gradient-bg">
                </div>
            </div>
        </div>
    </div>
    <!-- address section end  -->

    <!-- Card our team -->
    <div class="container-fluid team-background pr-0 pl-0">
        <div class="container-fluid text-center card team-background-transparent">
            <h1 class=" mb-0 p-4 text-uppercase text-white"> Our Team</h1>

            <div class="row align-items-center">

                <div class="col-sm-12 col-lg-4 p-5">
                    <div class="car card w-75 ml-5 border-0 box">
                        <img class="card-img-top " src="{{asset('img/a2.png')}}" alt="Card image" style="width:100%">

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
                        <img class="card-img-top" src="{{asset('img/a2.png')}}" alt="Card image" style="width:100%">
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
                        <img class="card-img-top" src="{{asset('img/a2.png')}}" alt="Card image" style="width:100%">
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

@endsection


