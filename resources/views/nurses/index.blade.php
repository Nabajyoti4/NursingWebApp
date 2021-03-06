@extends('layouts.home')

@section('title')
    Nurse Profile
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
        span {
            text-transform: capitalize;
        }

        .header {
            position: absolute;
            top: -13px;
            left: 0%;
            padding: 0% 2px;
            margin: 0%;
            background: #fff;
        }

        .borderdiv {
            position: relative;
            padding-top: 1rem;
            border-radius: 2px;
            border-top: 2px solid #4883b6;
            margin-top: 2rem;
        }

        .font {
            display: inline-block;
            width: 102px;
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
        @elseif ($message = Session::get('info'))
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    title: '{{$message}}',
                    showConfirmButton: true,
                })
            </script>
        @endif
        <div class="container p-3">
            <div class="row p-5 bg-light">
                <div class="col-xs-12 col-lg-4">
                    <img
                        src="{{asset($nurse->user->photo?asset("/storage/".$nurse->user->photo->photo_location) :'http://placehold.it/64x64')}}"
                        class="avatar img-thumbnail"
                        width="300px"
                        height="300px"
                        style="object-fit: cover;"
                        alt="avatar">
                    <div class="pt-5">
                        <h3><strong>{{$nurse->employee_id}}</strong></h3>
                        <hr>
                        <h3>{{$user->name}}</h3>
                        <hr>
                        <h4><i class="fas fa-mobile-alt"></i> {{$user->phone_no}}</h4>
                        <hr>
                        <h4><i class="fas fa-envelope"></i> {{$user->email}}</h4>
                        <hr>
                        <a href="{{ route('users.edit', $user->id) }}" style="text-decoration: none">
                            <div class="btn profile-edit-btn text-center">Edit Profile</div>
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-8 border p-4 shadow rounded-lg">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                               aria-controls="home" aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#workHistory" role="tab"
                               aria-controls="workHistory" aria-selected="false">Work History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="booking-tab" data-toggle="tab" href="#salary" role="tab"
                               aria-controls="salary" aria-selected="false">Salary</a>
                        </li>
                    </ul>
                    <div class="tab-content profile-tab" id="myTabContent">
                        {{--info tab--}}
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="borderdiv">
                                <h5 class="header font-weight-bold bg-light">Identification</h5>
                                <div>
                                    <h5><a target="_blank" href="{{asset('/storage/'.$nurse->qualification->identification)}}">Voter/Pan Card</a></h5>
                                </div>
                                <hr>
                                <div>
                                    <h5><a target="_blank" href="{{asset('/storage/'.$nurse->qualification->address)}}">Adhar/License</a></h5>
                                </div>
                                <hr>
                            </div>
                            <div class="borderdiv">
                                <h5 class="header font-weight-bold bg-light">Current Address</h5>
                                <div>
                                    <h5 class="font">Street</h5>
                                    <span>:{{$current_add->street ?? "Fill the current Address"}}</span>
                                </div>
                                <div>
                                    <h5 class="font">Landmark</h5>
                                    <span>:{{$current_add->landmark ?? "Fill the current Address"}}</span>
                                </div>
                                <div>
                                    <h5 class="font">City</h5>
                                    <span>:{{$current_add->city?? "Fill the current Address"}}</span>
                                </div>
                                <div>
                                    <h5 class="font">State</h5>
                                    <span>:{{$current_add->state ??  "Fill the current Address"}}</span>
                                </div>
                                <div>
                                    <h5 class="font">Country</h5>
                                    <span>:{{$current_add->country ?? "Fill the current Address"}}</span>
                                </div>
                                <div>
                                    <h5 class="font">Pin Code</h5>
                                    <span>:{{$current_add->pin_code ?? "Fill the current Address"}}</span>
                                </div>
                            </div>
                            <div class="borderdiv">
                                <h5 class="header font-weight-bold bg-light">Permanent Address</h5>
                                <div>
                                    <h5 class="font">Street</h5>
                                    <span>:{{$permanent_add->street ?? "Fill the Permanent Address"}}</span>
                                </div>
                                <div>
                                    <h5 class="font">Landmark</h5>
                                    <span>:{{$permanent_add->landmark ??  "Fill the Permanent Address"}}</span>
                                </div>
                                <div>
                                    <h5 class="font">City</h5>
                                    <span>:{{$permanent_add->city ?? "Fill the Permanent Address"}}</span>
                                </div>
                                <div>
                                    <h5 class="font">State</h5>
                                    <span>:{{$permanent_add->state ?? "Fill the Permanent Address"}}</span>
                                </div>
                                <div>
                                    <h5 class="font">Country</h5>
                                    <span>:{{$permanent_add->country ??"Fill the Permanent Address"}}</span>
                                </div>
                                <div>
                                    <h5 class="font">Pin Code</h5>
                                    <span>:{{$permanent_add->pin_code ?? "Fill the Permanent Address"}}</span>
                                </div>
                            </div>
                        </div>
                        {{--working history--}}
                        <div class="tab-pane fade" id="workHistory" role="tabpanel" aria-labelledby="booking-tab">
                            <div class="row p-2">
                                @forelse($bookings as $booking)
                                    <div class="col-sm-12 mb-2 border p-3 shadow rounded-lg">
                                        <div class="row p-2">
                                            <div class="col-sm-3">
                                                <div class="col-sm-12"><strong>Booking ID</strong></div>
                                                <div class="col-sm-12">{{$booking->id}}</div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="col-sm-12"><strong>Status</strong></div>
                                                <div class="col-sm-12"> @if($booking->status == 0)
                                                        Rejected
                                                    @elseif($booking->status == 1)
                                                        Completed
                                                    @elseif($booking->status == 2)
                                                        Pending
                                                    @elseif($booking->status == 3)
                                                        Running
                                                    @elseif($booking->status == 4)
                                                        Takeover
                                                    @endif</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="col-sm-12"><strong>Booked on</strong></div>
                                                <div class="col-sm-12">{{$booking->created_at}}</div>
                                            </div>
                                            <div class="col-sm-3">
                                                <form action="{{route('nurse.booking.show',$booking->id)}}"
                                                      method="GET">
                                                    @csrf
                                                    <button class="btn btn-primary" type="submit">Show
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>No Working History found</p>
                                @endforelse
                            </div>
                        </div>
                        {{--view salary tab--}}

                        <div class="tab-pane fade" id="salary" role="tabpanel" aria-labelledby="salary-tab">
                            <div class="row pt-2">
                                @forelse($tsalaries as $salary)
                                    <div class="col-sm-12">
                                        <div class="card shadow mb-4">
                                            <div class="card-header">Year-Month : {{$salary->month_days}}</div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-4">Advance Payment
                                                        : {{$salary->advance}}</div>
                                                    <div class="col-sm-12 col-md-4">Total Payment
                                                        : {{$salary->total}}</div>
                                                    <div class="col-sm-12 col-md-4">Net Payment : {{$salary->net}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                                @forelse($psalaries as $salary)
                                    <div class="col-sm-12">
                                        <div class="card shadow mb-4">
                                            <div class="card-header">Year-Month : {{$salary->month_days}}</div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-4">Advance Payment
                                                        : {{$salary->advance}}</div>
                                                    <div class="col-sm-12 col-md-4">Total Payment
                                                        : {{$salary->total}}</div>
                                                    <div class="col-sm-12 col-md-4">Net Payment : {{$salary->net}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
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

