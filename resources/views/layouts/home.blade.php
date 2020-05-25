<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>
        @yield('title')
    </title>

    <link href="https://fonts.googleapis.com/css?family=Lora:400,400italic|Work+Sans:300,400,500,600" rel="stylesheet"
          type="text/css">

    <!--Bootstrap link-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- CSS only -->
    <link href="{{asset('css/toolkit-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/application-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/index.css')}}" rel="stylesheet">
    <!-- link icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    {{--    fontawesome link    --}}
    <script src="https://kit.fontawesome.com/282f852346.js"></script>
    <style>
        @media (max-width: 768px) and (-webkit-min-device-pixel-ratio: 2) {
            body {
                width: 1px;
                min-width: 100%;
                *width: 100%;
            }

            #stage {
                height: 1px;
                overflow: auto;
                min-height: 100vh;
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>
</head>

<body>
<!-- sidebar -->
<div class="stage-shelf stage-shelf-right hidden" id="sidebar">
    <ul class="nav nav-bordered nav-stacked flex-column">
        <li class="nav-header">Menu</li>
        <li class="nav-item">
            <a class="nav-link active" href="index.html">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">address Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">About Us</a>
        </li>
    </ul>
</div>
<!-- sidebar ends-->

<div class="stage" id="stage">
    <!-- navbar -->
    <div class="block block-inverse block-fill-height app-header"
         style="background-image: url({{asset('img/navbar-back-1.jpg')}});">

        <div class="container py-4 fixed-top app-navbar">

            <nav class="navbar navbar-transparent navbar-padded navbar-toggleable-sm">
                <button class="navbar-toggler navbar-toggler-right hidden-md-up" type="button" data-target="#stage"
                        data-toggle="stage" data-distance="-250">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- navbar brand -->
                <a class="navbar-brand mr-auto" href="">
                    <img src="{{asset('img/AArogya-new-edit-1.png')}}"
                         style="width: 150px; height: 55px; background: #fff; padding: 2px; border-radius: 4px; color: #28669F;"
                         alt="Home">
                    <!-- <strong >NurseCare</strong> -->
                </a>
                <!-- navbar brand ends -->
                <div class="hidden-sm-down text-uppercase">
                    <ul class="navbar-nav">
                        <li class="nav-item px-1 ">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item px-1 ">
                            <a class="nav-link" href="#">Services</a>
                        </li>
                        <li class="nav-item px-1 ">
                            <a class="nav-link" href="#">address Us</a>
                        </li>
                        <li class="nav-item px-1 ">
                            <a class="nav-link" href="#">About Us</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- carousel -->

        <div class="block-xs-middle p-2">
            <div class="container">
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
                                    <h1 class="block-titleData frequency text-center font-weight-bold display-4">Hire a
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
                                    <h1 class="block-titleData frequency text-center font-weight-bold display-4">Work as
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
    <!-- navbar ends -->

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
    @yield('counters')
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
            <img src="assets/img/startup-4.svg">
            <img src="assets/img/startup-5.svg">
            <img src="assets/img/startup-6.svg">
            <img src="assets/img/startup-7.svg">
            <img src="assets/img/startup-8.svg">
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
    @yield('team-cards')
    <!--card end-->

    <!-- footer -->
    <div class="block block-inverse app-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-5">
                    <ul class="list-unstyled list-spaced">
                        <li class="mb-2">
                            <h6 class="text-uppercase">About</h6>
                        </li>
                        <li class="text-muted">
                            We’ve been working on Go Analytics for the better part of a decade and are super proud of
                            what
                            we’ve
                            created. If you’d like to learn more, or are interested in a job, address us anytime at <a
                                href="mailto: themes@getbootstrap.com">themes@getbootstrap.com</a>.
                        </li>
                    </ul>
                </div>
                <div class="col-md-2 offset-md-1 mb-5">
                    <ul class="list-unstyled list-spaced">
                        <li class="mb-2">
                            <h6 class="text-uppercase">Product</h6>
                        </li>
                        <li class="text-muted">Features</li>
                        <li class="text-muted">Examples</li>
                        <li class="text-muted">Tour</li>
                        <li class="text-muted">Gallery</li>
                    </ul>
                </div>
                <div class="col-md-2 mb-5">
                    <ul class="list-unstyled list-spaced">
                        <li class="mb-2">
                            <h6 class="text-uppercase">Apis</h6>
                        </li>
                        <li class="text-muted">Rich data</li>
                        <li class="text-muted">Simple data</li>
                        <li class="text-muted">Real time</li>
                        <li class="text-muted">Social</li>
                    </ul>
                </div>
                <div class="col-md-2 mb-5">
                    <ul class="list-unstyled list-spaced">
                        <li class="mb-2">
                            <h6 class="text-uppercase">Legal</h6>
                        </li>
                        <li class="text-muted">Terms</li>
                        <li class="text-muted">Legal</li>
                        <li class="text-muted">Privacy</li>
                        <li class="text-muted">License</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- footer end -->
</div>

{{--loading the needed scripts--}}
<script>
    const counters = document.querySelectorAll('.counter');
    const speed = 200;
    counters.forEach(counter => {
        const UpdateCount = () => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;

            const inc = target / speed;

            if (count < target) {
                counter.innerText = count + inc;
                setTimeout(UpdateCount, 1);
            } else {
                count.innerText = target;
            }
        }
        UpdateCount();
    });
</script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/tether.min.js')}}"></script>
<script src="{{asset('js/toolkit.js')}}"></script>
<script src="{{asset('js/application.js')}}"></script>
</body>
</html>
