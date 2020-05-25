@extends('layouts.home')
@section('title')
    Homepage
@endsection
@section('counters')
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
@endsection

@section('team-cards')
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
@endsection

