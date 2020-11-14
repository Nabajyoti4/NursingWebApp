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
    <link rel="stylesheet" href="{{asset('css/team.css')}}"/>
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
                     style="background-image: url({{asset('img/team.webp')}}); background-size: cover; height: 500px">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h1 class="text-white font-weight-bold border p-3">Offline Payment Methods</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Nursing end-->
        <div class="container-fluid pr-0 pl-0" style="background-color: #343c48;!important;">
            <div class="container-fluid text-center card bg-transparent">
                <div class="row align-items-center justify-content-center p-5">
                    <div class="col-sm-12 col-lg-4 " style="margin-bottom:20px;" data-aos="flip-right"
                         data-aos-delay="300">
                        <div class="themeioan_course">
                            <div class="blog-content"  style="background-color: #262525;">
                                <h5 class="title" style="text-align: start;  height: 200px; color: white;"> Bank Name: AXIS Bank
                                    <br>
                                    Branch Address: A T Road Chowkbazar , Jorhat
                                    <br>
                                    Account Name: AAROGYA HOME CARE NURSING SERVICE
                                    <br>
                                    Account No: 918020049977202
                                    <br>
                                    IFSC Code: UTIB0000376
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-4 " style="margin-bottom:20px;" data-aos="flip-right"
                         data-aos-delay="300">
                        <div class="themeioan_course">
                            <div class="blog-content"  style="background-color: #262525;">
                                <h5 class="title" style="text-align: start;  height: 200px;color: white;"> COURIER CHEQUES TO:

                                    <br>Address: Mandakini Bibah Bhawan complex, Kotoky Pukhuri, Bye Pass Tini Ali,
                                    Jorhat (Assam)
                                    <br>Pin: 785006
                                    <br>Tel: +91 9435960652

                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-4 " style="margin-bottom:20px;" data-aos="flip-right"
                         data-aos-delay="300">
                        <div class="themeioan_course " >
                            <div class="blog-content" style="background-color: #262525;">
                                <h5 class="title" style="text-align: start;  height: 200px;color: white;!important;"> Bank Name: HDFC Bank
                                    <br>
                                    Branch Address: Tarajan, Jorhat
                                    <br>
                                    Account Name: AAROGYA HOME CARE NURSING SERVICE
                                    <br>
                                    Account No: 50200053488670
                                    <br>
                                    IFSC Code: HDFC0009123
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
