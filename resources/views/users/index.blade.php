@extends('layouts.home')

@section('title')
    User Profile
@endsection
@section('links')
    <!-- Theme CSS -->
    <link href="{{asset('css/navbar.css')}}" rel="stylesheet">
    <link href="{{asset('css/toolkit-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/application-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    <!--  custom form style link -->
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <!--  fontawesome link -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>

@endsection

@section('style')
    <style>
         .alert-success hr {
            border-top-color: #b3e8ca;
        }

        .alert-dismissible .close {
            position: absolute;
            top: 0;
            right: 0;
            padding: 0.75rem 1.25rem;
            color: inherit;
        }

        .fade {
            transition: opacity 0.15s linear;
        }

        .fade.show {
            opacity: 1;
        }

        img[src=""] {
            display: none;
        }

    </style>
@endsection
@section('content')
    <div class="container-fluid profile-bg">
        <!-- navbar start -->
    @include('partials.navbar')
    <!-- navbar ends -->
        @if ($message = Session::get('success'))
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Data Updated Successfully!',
                    showConfirmButton: true,
                })
            </script>
        @elseif ($message = Session::get('patient'))
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Nurse request Send Successfully!',
                    showConfirmButton: true,
                })
            </script>
        @endif
        <div class="p-4">
            <div class="container emp-profile mt-3">
                <div class="row">
                    <div class="col-md-4" >
                        <div class="profile-img">
                            <img src="{{ $user->photo?asset("/storage/".$user->photo->photo_location) :'No Photo'}}"
                                 alt=""  />
                        </div>
                    </div>
                    <div class="col-md-6 align-items-center">
                        <div class="profile-head pt-5">
                            <h5>
                                {{$user->name}}
                            </h5>
                            <h6>
                                {{$user->role}}
                            </h6>
                            <br>
                            <ul class="nav nav-tabs pt-5" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                       aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                       aria-controls="profile" aria-selected="false">Patient request Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="booking-tab" data-toggle="tab" href="#booking" role="tab"
                                       aria-controls="booking" aria-selected="false">Booking Details</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('users.edit', $user->id) }}" style="text-decoration: none">
                            <div class="profile-edit-btn text-center">Edit Profile</div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 p-5">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <!--user tab-->
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$user->name}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$user->email}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$user->phone_no}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Current Address</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$user->addresses->first() ? $user->addresses->first()->city : "Fill the Current Address"}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Permanent Address</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$user->addresses->last() ? $user->addresses->last()->city : "Fill the Permanent Address"}}</p>
                                    </div>
                                </div>

                            </div>

                            <!--patient-->
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">

                                    @forelse($patients as $patient)
                                        <div class="col-sm-4">
                                            <div class="card shadow mb-4">
                                                <div class="card-header">Patient ID: {{$patient->id}}</div>
                                                <div class="card-body">
                                                    <p>Name : {{$patient->patient_name}}</p>
                                                    <p>Phone No : {{$patient->phone_no}}</p>
                                                    <p>Age : {{$patient->age}}</p>
                                                    <p>Status :
                                                        @if($patient->status == 1)
                                                            Approved
                                                        @elseif($patient->status == 0)
                                                            Dissapproved
                                                        @else
                                                            Pending
                                                        @endif</p>
                                                    <p>Request date : {{$patient->created_at}}</p>
                                                </div>
                                            </div>
                                        </div>

                                    @empty
                                           <h2 class="pl-5">No Patient Request found</h2>
                                    @endforelse
                                </div>
                            </div>

                            <!--bookings-->
                            <div class="tab-pane fade" id="booking" role="tabpanel" aria-labelledby="booking-tab">
                                <div class="row">
                                @forelse($bookings as $booking)
                                    <div class="col-sm-4">
                                        <div class="card shadow mb-4">
                                            <div class="card-header">Booking ID : {{$booking->id}}</div>
                                            <div class="card-body">
                                                <p>UserName : {{$booking->user->name}}</p>
                                                <p>Patient Name : {{$booking->patient->patient_name}}</p>
                                                <p>Nurse Assigned : {{$booking->nurse->user->name}}</p>
                                                <p>Status :
                                                    @if($booking->status == 0)
                                                        Rejected
                                                    @elseif($booking->status == 1)
                                                        Completed
                                                    @elseif($booking->status == 2)
                                                        Pending
                                                    @elseif($booking->status == 3)
                                                        Running
                                                    @else
                                                        Takeover
                                                    @endif</p>
                                                <p>Due Payment : {{$booking->due_payment}}</p>
                                                <p>Total Payment : {{$booking->total_payment}}</p>
                                                <p>Booked on : {{$booking->created_at}}</p>
                                                <p>
                                                <form action="{{route('user.booking.show',$booking->id)}}"
                                                      method="GET">
                                                    @csrf
                                                    <button class="btn btn-primary" type="submit">Show
                                                    </button>
                                                </form>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <h2 class="pl-5">No Booking found</h2>
                                @endforelse
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
