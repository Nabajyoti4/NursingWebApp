@extends('layouts.home')
@section('title')
    Homepage
@endsection
@section('links')

    <script src="{{asset('js/sweetalert2.min.js')}}"></script>
    <!-- Theme CSS -->
    <link href="{{asset('css/navbar.css')}}" rel="stylesheet">
    <link href="{{asset('css/toolkit-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/application-startup.css')}}" rel="stylesheet">
    <!-- Theme CSS and custom css -->
    <link href="{{asset('css/index.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/team.css')}}"/>

    <!--  fontawesome link -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

@endsection
@section('style')
    <style>
        .justify-content-center {
            -ms-flex-pack: center !important;
            justify-content: center !important
        }
    </style>
@endsection
@section('content')
    <!-- header section starts -->
    <div class="p-1"
         style="background-image: url({{asset('img/navbar-back-1.webp')}});background-repeat: no-repeat; background-size: cover">
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
                                    <a href="{{route('users.patient.create')}}"
                                       class="btn btn-outline-primary btn-lg text-center">Hire now</a>
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
                                    <a class="btn btn-outline-primary btn-lg text-center" href="#joinForm"
                                       type="button">Join now</a>
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

    {{--    Modal for success or info --}}
    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{$message}}',
                showConfirmButton: true,
            })
        </script>
    @elseif($message = Session::get('info'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'info',
                title: '{{$message}}',
                showConfirmButton: true,
            })
        </script>
    @elseif($message = Session::get('info_fill'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'info',
                title: '{{$message}}',
                showConfirmButton: false,
                html:'<a class="btn btn-primary text-white" href="{{route('users.edit',Auth::user()->id)}}">Go To Edit Page</a>'
            })
        </script>
    @endif

    <!--Welcome section-->
    <div class="block block-secondary app-iphone-block">
        <div class="welcome_sewa">
            <div class="container">
                <div class="col-md-12 text-center">
                    <h1 class="mb-0 p-2 text-uppercase font-weight-bold">Welcome To
                            <span>AAROGYA HOME CARE NURSING SERVICE</span></h1>
                </div>
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6  col-sm-12">
                        <div class="welcome_pic" data-aos="fade-right" data-aos-delay="200">
                            <div class="pic_first">
                                <img src="{{asset('img/1.jpg')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-sm-12">
                        <div class="welcome_text">
                            <h4 class="font-weight-bold">Our Missions</h4>
                            <ul style="list-style-type: circle !important;">
                                <li>• To provide high quality services to home bound patients in a responsible, compassionate manner.</li>
                                <li>• To provide patient education when indicated to promote maintain and restore health.</li>
                                <li>• To be advocates for patients right, respect and confidentiality.</li>
                                <li>• To deliver service without regard, religion or national origin..</li>
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
        <div class="container counters-container text-center justify-content-center">
            <div class="row">
                <div class="col-md-4 p-2" data-aos="fade-up"
                     data-aos-duration="900">
                    <i class="fas fa-medkit fa-4x border rounded p-3"></i>
                    <h4 class="counter font-weight-bold p-2">{{$patients_count}}</h4>
                    <h4>Clients Served</h4>
                </div>
                <div class="col-md-4 p-2" data-aos="fade-down"
                     data-aos-easing="linear"
                     data-aos-duration="900">
                    <i class="fas fa-user-md fa-4x border rounded p-3"></i>
                    <h4 class="counter font-weight-bold p-2">{{$nurses_count}}</h4>
                    <h4>Caregivers Employed</h4>
                </div>
                <div class="col-md-4 p-2" data-aos="fade-up"
                     data-aos-duration="900">
                    <i class="fas fa-user-nurse fa-4x border rounded p-3"></i>
                    <h4 class="counter font-weight-bold p-2">{{$nurses_active_count}}</h4>
                    <h4>Active Caregivers</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- counters ends -->

    <!--Services section-->
    <div class="services">
        <div class="container" data-aos="zoom-in" data-aos-delay="200">
            <div class="row">

                <div class="col-12">
                    <div class="services-wrap">
                        <h2>Our services</h2>

                        <div class="row justify-content-center ">
                            @foreach($services as $service)
                                <div class="col-6 col-md-5 col-lg-5 box-service "
                                     style="border: 1px solid white; border-radius:6px;margin-right: 10px;">
                                    <a href="{{route('user.service.index')}}">
                                        <div class="services-cont">
                                            <center>
                                                <header class="headings d-flex flex-wrap align-items-center">
                                                    <i class="fa fa-user-md text-white mr-2 " aria-hidden="true"></i>
                                                    <h3>{{$service->title}}</h3>
                                                </header>
                                            </center>

                                            <div class="entry-content"><em>
                                                    <p>{{$service->details}}</p>

                                                </em>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
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
                    <img src="{{asset('img/nurse-1.webp')}}" alt="" width="100%">
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

        <div id="carousel-example-generic" class="carousel carousel-light carousel-fade" data-ride="carousel">
            <div class="main-text  background-transparent">
                <div class="col-md-12 text-center">
                    <h1 class=" text-white mb-0 p-4 text-uppercase"> Our Top Caretakers</h1>
                </div>
            </div>

            <div class="carousel-inner" role="listbox">
                <?php $index = 0;?>
                @foreach($ratings as $rating)
                    @if($index == 0)
                        <div class="carousel-item active">
                            @else
                                <div class="carousel-item">
                                    @endif
                                    <div class="block  background-transparent">
                                        <div class="container item-center">

                                            <div class="text-center p-3">
                                                <img class="img-fluid rounded-circle img-thumbnail "
                                                     src="{{asset("/storage/".$rating->photo)}}"
                                                     style="width: 200px; height: 200px;">
                                            </div>

                                            <div class="text-center text-white  p-3">
                                                <p class="mb-4 lead text-white " style="text-transform: capitalize;">
                                                    <strong>{{$rating->name}}</strong>,
                                                    Caretaker</p>
                                                @for($i = 1 ; $i <= $rating->star ; $i++)
                                                    <i class="fa fa-star " aria-hidden="true"></i>
                                                @endfor
                                            </div>


                                            <div class="row">
                                                <div class="col-sm-8 offset-sm-2">
                                                    <h5 class="mx-auto text-center text-white"
                                                        style="text-transform: capitalize;"> “<em>
                                                            {{$rating->remark}}
                                                        </em>”</h5>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php $index++;?>
                                @endforeach
                        </div>

                        <a class="carousel-control-prev" href="#carousel-example-generic" role="button"
                           data-slide="prev">
                            <span class="icon icon-chevron-thin-left text-white" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-example-generic" role="button"
                           data-slide="next">
                            <span class="icon icon-chevron-thin-right text-white" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
            </div>
        </div>
        <!--NURSE RATING SLIDER END-->
    </div>
        <!--Business partners section-->
    {{--    <div class="block app-ribbon pt-3">--}}
    {{--        <h1 class=" mb-0 text-center text-white text-uppercase"> Business partners</h1>--}}
    {{--        <div class="container text-xs-center p-5">--}}
    {{--                        <img src="assets/img/startup-4.svg">--}}
    {{--                        <img src="assets/img/startup-5.svg">--}}
    {{--                        <img src="assets/img/startup-6.svg">--}}
    {{--                        <img src="assets/img/startup-7.svg">--}}
    {{--                        <img src="assets/img/startup-8.svg">--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <!--Business partners section end-->

        <!-- address section start -->
        <div class="address-page-short-boxes" data-aos="flip-up" data-aos-delay="200">
            <div class="col-md-12 text-center">
                <h1 class=" mb-0 mb-5 text-uppercase">Contact Us</h1>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-4 mt-5 mt-lg-0" data-aos="flip-left" data-aos-delay="200">
                        <div class="address-location h-100">
                            <h2 class="d-flex align-items-center">Head Office</h2>
                            <ul class="p-0 m-0">
                                <li>Mandakini Bibah Bhawan Complex, Katoky Pukhuri, Bye Pass Tini Ali, Jorhat-785006, Assam.</li>
                                <li>Call: 9435960652, 9101786597, 6002281528</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 mt-5 mt-lg-0" data-aos="flip-up" data-aos-delay="200">
                        <div class="address-location h-100">
                            <h2 class="d-flex align-items-center">Branch Office (Sivsagar)</h2>

                            <ul class="p-0 m-0">
                                <li>Old Amalapatty, Ganak Patty, By Lane,  Harakanta Nazir Path Sivasagar-785640, Assam.</li>
                                <li>Call: 9435960652, 9101786597, 6002450239</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 mt-5 mt-lg-0"  data-aos="flip-right" data-aos-delay="200">
                        <div class="address-location h-100">
                            <h2 class="d-flex align-items-center">Branch Office(Dibrugarh)</h2>

                            <ul class="p-0 m-0">
                                <li>Sashan Para Road, Near Sankar Dev Hospital, Mancotta Road, Dibrugarh-786003 Assam.</li>
                                <li>Call: 9435960652, 8753955565, 9101786597</li>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- address section end  -->


        <!--Nurse request form-->
        <div class="container-nurserequest" id="joinForm">
            <div class="wrap-nurserequest" data-aos="zoom-out-up" data-aos-delay="400">
                <form class="nurserequest-form" action="{{route('nursejoin.store')}}" method="POST">
                    @csrf
                    <span class="nurserequest-form-title">
					To Join As A Nurse  Send Your Request
				</span>

                    <input class="input100" type="hidden" name="user_id" value="@auth{{Auth::user()->id}}
                    @elseauth''@endauth" required>

                    <div class="wrap-input100">
                        <input class="input100" type="text" name="name" placeholder="Full Name"
                               value="@auth{{Auth::user()->name}}
                               @elseauth''@endauth" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 ">
                        <input class="input100" type="text" name="email" value="@auth{{Auth::user()->email}}
                        @elseauth''@endauth" placeholder="Email" required readonly>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 ">
                        <input class="input100" type="text" name="phone_no" placeholder="Contact number" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 ">
                        <input class="input100" type="text" name="age" placeholder="Age">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-nurserequest-form-btn">
                        <button type="submit" class="btn profile-edit-btn ">
                            Send Request
                        </button>
                    </div>
                </form>
              <div class="text-center">  <strong>Note: </strong>Please Register and Login to send request</div>
            </div>
        </div>

    <!-- Card our team -->
    <div class="container-fluid team-background pr-0 pl-0">
        <div class="container-fluid text-center card team-background-transparent ">
            <h1 class=" mb-0 p-4 text-uppercase text-white"> Our Team</h1>

            <div class="row align-items-center justify-content-center p-5">
                @foreach($members as $member)
                    <div class="col-sm-12 col-lg-4 "style="margin-bottom:20px;" data-aos="flip-right" data-aos-delay="300">
                        <div class="themeioan_course">
                            <div class="blog-photo">
                                <img style="width:100%;object-fit: cover;" height="250"
                                     class="card-img-top embed-responsive-item"
                                     src="{{asset('storage/'.$member->photo)}}" alt="Card image">
                            </div>
                            <div class="blog-content">
                                <h5 class="title" style="text-transform: capitalize">{{$member->name}}
                                </h5>
                                <div class="title" style="text-transform: capitalize; color:grey;">{{$member->designation}}
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


