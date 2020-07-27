@extends('layouts.home')

@section('title')
    Services
@endsection

@section('links')
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>
    <link href="{{asset('css/navbar.css')}}" rel="stylesheet">
    <link href="{{asset('css/toolkit-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/application-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <!-- Theme CSS and custom css -->
    <link href="{{asset('css/index.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
@endsection
@section('style')
    <style>
        * {
            font-size: 15px;
        }
        .contact{
            color: white;
            transition: all .6s;
        }
        .contact:hover{
            background-color: white;
            color: black;
        }
    </style>
@endsection
@section('content')

    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{$message}}',
                showConfirmButton: true,
            })
        </script>
    @endif

    <div class="container-fluid p-0">
        <div id="demo" class="carousel slide" data-ride="carousel" style="height: 700px">
            <!-- navbar start -->
            <div style="background-color: #4d6de4">
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
                <div class="carousel-item active d-flex justify-content-center align-content-center align-items-center" style="background-image: url({{asset('img/team.webp')}}); background-size: cover; height: 500px">
                    <div class="row" >
                        <div class="col-sm-12 text-center" >
                            <h1 class="font-weight-bold border p-3 contact">CONTACT US</h1>
                            <h3>Feel free to contact us any time for any Queries</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- address section start -->
        <div class="address-page-short-boxes">
            <!--Nurse request form-->
            <div class="container-nurserequest mb-5" id="joinForm">
                <div class="wrap-nurserequest ">
                    <form class="nurserequest-form" action="{{route('user.query.store')}}" method="POST">
                        @csrf
                        <span class="nurserequest-form-title">
					Send Any Queries , We will Respond You soon
				</span>

                        <div class="wrap-input100">
                            <input class="input100" type="text" name="name" placeholder="Full Name"
                                    required>
                            <span class="focus-input100"></span>
                        </div>

                        <div class="wrap-input100 ">
                            <input class="input100" type="email" name="email"  placeholder="Email" required >
                            <span class="focus-input100"></span>
                        </div>

                        <div class="wrap-input100 ">
                            <input class="input100" type="text" name="city"  placeholder="city name" required>
                            <span class="focus-input100"></span>
                        </div>

                        <div class="wrap-input100 ">
                            <input class="input100" type="number" name="phone"  placeholder="contact number" required>
                            <span class="focus-input100"></span>
                        </div>


                        <div class="wrap-input100 ">
                            <textarea class="input100" type="text" name="query" placeholder="Message" required></textarea>
                            <span class="focus-input100"></span>
                        </div>

                        <div class="container-nurserequest-form-btn">
                            <button type="submit" class="btn profile-edit-btn ">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-4 mt-5 mt-lg-0">
                        <div class="address-location h-100">
                            <h2 class="d-flex align-items-center">Head Office</h2>
                            <ul class="p-0 m-0">
                                <li>Mandakini Bibah Bhawan complex, By Pass Tini Ali, Jorhat- 785006, Assam.</li>
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
                            <h2 class="d-flex align-items-center">Branch Office(Dibrugarh)</h2>

                            <ul class="p-0 m-0">
                                <li>Sashanpara Road, Near Sankar Dev Hospital, Mancotta Road.</li>
                                <li>Call: 9435960652, 8753955565</li>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- address section end  -->
       <div class="col-12 probootstrap-animate" align="center">
            <div id="map" class=" container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3562.767342342199!2d94.18186801447968!3d26.751799583197204!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3746c3ceb2bc28f7%3A0x8ad690dd9028fe34!2sAAROGYA%20HOME%20CARE%20SERVICE!5e0!3m2!1sen!2sin!4v1580747838248!5m2!1sen!2sin"
                        width="1200" height="400" frameborder="0" style="border:0;" allowfullscreen="">
                </iframe>
            </div>
        </div>


    </div>

@endsection
