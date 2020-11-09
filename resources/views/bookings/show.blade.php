@extends('layouts.home')
@section('title')
    Booking Details
@endsection

@section('links')
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <link href="{{asset('css/error.css')}}" rel="stylesheet">
    <link href="{{asset('css/navbar.css')}}" rel="stylesheet">
    <link href="{{asset('css/toolkit-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/application-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    <!--  fontawesome link -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>
@endsection

@section('style')
    <style>
        select {
            border: 0 !important;
            background: #2c3e50;
            background-image: none;
        }

        /* Remove IE arrow */
        select::-ms-expand {
            display: none;
        }

        /* Custom Select */
        .select {
            position: relative;
            width: 100%;
            height: 40px;
            display: flex;
            line-height: 3;
            background: #2c3e50;
            overflow: hidden;
            border-radius: .25em;
        }

        select {
            flex: 1;
            padding: 0 .5em;
            color: #fff;
            cursor: pointer;
        }

        /* Arrow */
        .select::after {
            content: '\25BC';
            position: absolute;
            top: 0;
            right: 0;
            padding: 0 1em;
            background: #34495e;
            cursor: pointer;
            pointer-events: none;
            -webkit-transition: .25s all ease;
            -o-transition: .25s all ease;
            transition: .25s all ease;
        }

        /* Transition */
        .select:hover::after {
            color: #f39c12;
        }

        h4 {
            text-transform: initial;
        }

        p {
            margin-bottom: 0;
        }

        span {
            text-transform: capitalize;
        }

        .go-edit-btn {
            border: none;
            border-radius: .5rem;
            padding: .5rem;
            font-weight: 600;
            border-color: transparent;
            background: linear-gradient(270deg, rgba(50, 200, 250, 1) 0%, rgba(88, 125, 228, 1) 100%); /* w3c */
            color: #fff;
            cursor: pointer;
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid profile-bg">
        @include('partials.navbar')
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
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Booking Details Of {{$book->patient->patient_name}}</h6>
        </div>

        <div class="p-4">
            <div class="container emp-profile mt-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img
                                src="{{ $book->patient->photo_id?asset("/storage/".$book->patient->photo->photo_location) :'http://placehold.it/64x64'}}"
                                width="100%" alt="avatar">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                            <h5>
                                Patient Name :<strong> {{$book->patient->patient_name}}</strong>
                            </h5>
                            <h6>
                                Current Booking status :
                                <strong>
                                    @if($book->status == 0)
                                        Rejected
                                    @elseif($book->status == 1)
                                        Completed
                                    @elseif($book->status == 2)
                                        Pending
                                    @elseif($book->status == 3)
                                        Running
                                    @else
                                        Takeover
                                    @endif
                                </strong>
                            </h6>
                            <h6>
                                <p>Shift: <strong>{{$book->patient->shift}}</strong></p>
                            </h6>
                            <h6>
                                <p>Days: <strong>{{$book->patient->days}}</strong></p>
                            </h6>
                            <h6>
                                <p>Remaining Days: <strong>{{$book->remaining_days}}</strong> &nbsp;
                                </p>
                            </h6>
                            <h6>
                                <a class="btn btn-primary" href="{{route('user.booking.receipt', $book->patient_id)}}">Receipt</a>
                            </h6>
                            <ul class="nav nav-tabs pt-5" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                       aria-controls="home" aria-selected="true">Patient</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="user-tab" data-toggle="tab" href="#user" role="tab"
                                       aria-controls="user" aria-selected="false">User</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="nurse-tab" data-toggle="tab" href="#nurse" role="tab"
                                       aria-controls="nurse" aria-selected="false">Nurse</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="attendence-tab" data-toggle="tab" href="#attendence"
                                       role="tab" aria-controls="attendence" aria-selected="false">Attendence report</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 p-5">
                        <div class="tab-content profile-tab" id="myTabContent">

                            <!--Patient info-->
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$book->patient->patient_name}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$book->patient->phone_no}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Age</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$book->patient->age}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Permanent Address</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$book->patient->address_id? $book->patient->getAddress(): "Fill the Permanent Address"}}</p>
                                    </div>
                                </div>
                            </div>

                            <!--client or User info-->
                            <div class="tab-pane fade" id="user" role="tabpanel" aria-labelledby="user-tab">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$book->user->name}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$book->user->phone_no}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$book->user->email}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Permanent Address</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$book->user->addresses->last()? $book->user->addresses->last()->city: "Fill the Permanent Address"}}</p>
                                    </div>
                                </div>
                            </div>

                            <!--Nurse Alloted for patient info-->
                            <div class="tab-pane fade" id="nurse" role="tabpanel" aria-labelledby="nurse-tab">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$book->nurse->user->name}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$book->nurse->user->phone_no}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$book->nurse->user->email}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Permanent Address</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$book->nurse->user->addresses->last()? $book->nurse->user->addresses->last()->city: "Fill the Permanent Address"}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <img
                                            src="{{$book->nurse->user->photo?asset("/storage/".$book->nurse->user->photo->photo_location) :'No Photo'}}"
                                            alt="">
                                    </div>
                                </div>

                            </div>

                            <!--Attendance table-->
                            <div class="tab-pane fade" id="attendence" role="tabpanel" aria-labelledby="attendence-tab">

                                <div class="row pt-2">
                                    @forelse($attendances as $attendance)
                                        <div class="col-sm-12">
                                            <div class="card shadow mb-4">
                                                <div class="card-header">Booking ID : {{$attendance->booking->id}}</div>
                                                <div class="card-body pl-2 pr-2">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                        <span>
                                                    @if($attendance->photo == 'null')
                                                                <img width="100" height="100"
                                                                     src="{{asset("/img/admin_mark.png")}}" alt="">
                                                            @else
                                                                <img width="150" height="150"
                                                                     src="{{asset("/storage".$attendance->photo)}}"
                                                                     alt="">
                                                            @endif

                                                        </span>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <span>Date : {{$attendance->created_at}}</span></div>
                                                        <div class="col-sm-2"> <span>
                                                    @if($attendance->present == 2)
                                                                    <span class="p-2"
                                                                          style="float: right; background-color: red; color: white; border-radius: 10px">
                                                        Absent
                                                                </span>
                                                                @elseif($attendance->present == 1)
                                                                    <span class="p-2"
                                                                          style="float: right; background-color: green; color: white; border-radius: 10px">Present</span>
                                                                @endif
                                                </span>
                                                        </div>
                                                    </div>


                                                </div>

                                            </div>
                                        </div>
                                    @empty
                                        <p>Booking Not yet Started</p>
                                    @endforelse
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
