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
        @endif
        <div class="container p-3">
            <div class="row p-5 bg-light">
                <div class="col-xs-12 col-lg-4">
                    <img src="{{asset('/storage/'.$user->photo->photo_location)}}" class="avatar img-thumbnail"
                         width="250px"
                         alt="avatar">
                    <div class="pt-5">
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
                <div class="col-xs-12 col-lg-8">
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
                            <a class="nav-link" id="booking-tab" data-toggle="tab" href="#attendance" role="tab"
                               aria-controls="attendance" aria-selected="false">Mark Attendance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="booking-tab" data-toggle="tab" href="#viewAttendance" role="tab"
                               aria-controls="salary" aria-selected="false">View Attendance</a>
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
                                <h5 class="header font-weight-bold bg-light">Qualification</h5>
                                <div>
                                    <h5>HSLC</h5>
                                </div>
                                <hr>
                                <div>
                                    <h5>HS</h5>
                                </div>
                                <hr>
                                <div>
                                    <h5>NURSING</h5>
                                </div>

                            </div>
                            <div class="borderdiv">
                                <h5 class="header font-weight-bold bg-light">Current Address</h5>
                                <div>
                                    <h5 class="font">Street</h5>
                                    <span>:{{$user->addresses->last() ? $user->addresses->last()->street : "Fill the current Address"}}</span>
                                </div>
                                <div>
                                    <h5 class="font">Landmark</h5>
                                    <span>:{{$user->addresses->last() ? $user->addresses->last()->landmark : "Fill the current Address"}}</span>
                                </div>
                                <div>
                                    <h5 class="font">City</h5>
                                    <span>:{{$user->addresses->last() ? $user->addresses->last()->city : "Fill the current Address"}}</span>
                                </div>
                                <div>
                                    <h5 class="font">State</h5>
                                    <span>:{{$user->addresses->last() ? $user->addresses->last()->state : "Fill the current Address"}}</span>
                                </div>
                                <div>
                                    <h5 class="font">Country</h5>
                                    <span>:{{$user->addresses->last() ? $user->addresses->last()->country : "Fill the current Address"}}</span>
                                </div>
                                <div>
                                    <h5 class="font">Pin Code</h5>
                                    <span>:{{$user->addresses->last() ? $user->addresses->last()->pin_code : "Fill the current Address"}}</span>
                                </div>
                            </div>
                            <div class="borderdiv">
                                <h5 class="header font-weight-bold bg-light">Permanent Address</h5>
                                <div>
                                    <h5 class="font">Street</h5>
                                    <span>:{{$user->addresses->first() ? $user->addresses->first()->street : "Fill the Permanent Address"}}</span>
                                </div>
                                <div>
                                    <h5 class="font">Landmark</h5>
                                    <span>:{{$user->addresses->first() ? $user->addresses->first()->landmark : "Fill the Permanent Address"}}</span>
                                </div>
                                <div>
                                    <h5 class="font">City</h5>
                                    <span>:{{$user->addresses->first() ? $user->addresses->first()->city : "Fill the Permanent Address"}}</span>
                                </div>
                                <div>
                                    <h5 class="font">State</h5>
                                    <span>:{{$user->addresses->first() ? $user->addresses->first()->state : "Fill the Permanent Address"}}</span>
                                </div>
                                <div>
                                    <h5 class="font">Country</h5>
                                    <span>:{{$user->addresses->first() ? $user->addresses->first()->country : "Fill the Permanent Address"}}</span>
                                </div>
                                <div>
                                    <h5 class="font">Pin Code</h5>
                                    <span>:{{$user->addresses->first() ? $user->addresses->first()->pin_code : "Fill the Permanent Address"}}</span>
                                </div>
                            </div>
                        </div>
                        {{--working history--}}
                        <div class="tab-pane fade" id="workHistory" role="tabpanel" aria-labelledby="booking-tab">
                            <div class="row pt-2">
                                @forelse($bookings as $booking)
                                    <div class="col-sm-6">
                                        <div class="card shadow mb-4">
                                            <div class="card-header">Booking ID : {{$booking->id}}</div>
                                            <div class="card-body">
                                                <p>UserName : {{$booking->user->name}}</p>
                                                <p>Patient Name : {{$booking->patient->patient_name}}</p>
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
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>No Working History found</p>
                                @endforelse
                            </div>
                        </div>
                        {{--give attendance tab--}}
                        <div class="tab-pane fade" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">
                            <div class="row pt-2">
                                @forelse($bookings as $booking)
                                    <div class="col-sm-6">
                                        <div class="card shadow mb-4">
                                            <div class="card-header">Booking ID : {{$booking->id}}</div>
                                            <div class="card-body">
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
                                                <!-- Button trigger modal -->
                                                @if($booking->status == 3)
                                                    <button id="attendance_btn" type="button" class="btn btn-primary"
                                                            data-toggle="modal"
                                                            data-target="#exampleModalCenter{{$booking->id}}">
                                                        Give Attendance
                                                    </button>
                                            @endif
                                            <!-- Modal -->
                                                <div class="modal fade" id="exampleModalCenter{{$booking->id}}"
                                                     tabindex="-1"
                                                     role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">
                                                                    Upload a photo with a patient.</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{route('attendance.store')}}"
                                                                  method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="booking_id"
                                                                           id="booking_id" value="{{$booking->id}}">
                                                                    <label for="attendance_image">Upload File</label>
                                                                    <input type="file" name="attendance_image"
                                                                           class="form-control-file"
                                                                           id="attendance_image">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                    <button id="selfie_submit" type="submit"
                                                                            class="btn btn-primary">Upload
                                                                    </button>
                                                                    <button id="submit" type="submit"
                                                                            class="btn" style=" color: #fff;background-color: #e3342f;!important;border-color: #e3342f;">Mark Absent
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <p>No attendance</p>
                                @endforelse
                            </div>
                        </div>
                        {{--view attendance tab--}}
                        <div class="tab-pane fade" id="viewAttendance" role="tabpanel" aria-labelledby="attendance-tab">
                            <div class="row pt-2">
                                @forelse($attendances as $attendance)
                                    <div class="col-sm-12">
                                        <div class="card shadow mb-4">
                                            <div class="card-header">Booking ID : {{$attendance->booking->id}}</div>
                                            <div class="card-body">
                                                <span>Date : {{$attendance->created_at}}</span>

                                                <span style="float: right">
                                                    @if($attendance->present == 0)
                                                        Pending
                                                    @elseif($attendance->present == 1)
                                                        Present
                                                    @else
                                                        Absent
                                                    @endif
                                                </span>

                                            </div>

                                        </div>
                                    </div>
                                @empty
                                    <p>No attendance</p>
                                @endforelse
                            </div>
                        </div>
                        {{--salary tab--}}
                        <div class="tab-pane fade" id="salary" role="tabpanel" aria-labelledby="salary-tab">
                            <div class="row pt-2">
                                @forelse($bookings as $booking)
                                    <div class="col-sm-8">
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
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>No Salary</p>
                                @endforelse
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
{{--uncomment the script for image verification--}}

{{--@section('scripts')--}}
{{--    <script src="{{asset('js/exif.js')}}"></script>--}}
{{--    <script>--}}
{{--        const submitBtn = document.getElementById('selfie_submit').style;--}}
{{--        submitBtn.display='none';--}}
{{--        document.getElementById("attendance_image").onchange = function (e) {--}}
{{--            var file = e.target.files[0]--}}
{{--            if (file && file.name) {--}}
{{--                EXIF.getData(file, function () {--}}
{{--                    var exifData = EXIF.pretty(this);--}}
{{--                    if (exifData) {--}}
{{--                        exifData = exifData.split('\n');--}}
{{--                        exifData.forEach(findDateTime);--}}
{{--                        var DateTime;--}}
{{--                        function findDateTime(item, index) {--}}
{{--                            var data = (item.split(' : '));--}}
{{--                            if (data[0]===("DateTimeOriginal")) {--}}
{{--                                DateTime = data;--}}
{{--                            }--}}
{{--                        }--}}
{{--                        DateTime = DateTime[1].split(' ')[0];--}}
{{--                        if(DateTime === "{{$date}}"){--}}
{{--                            Swal.fire({--}}
{{--                                position: 'center',--}}
{{--                                icon: 'success',--}}
{{--                                title: 'Verifying Image',--}}
{{--                                timer: 1500,--}}
{{--                                showConfirmButton: false,--}}
{{--                            })--}}
{{--                            submitBtn.display="inline";--}}
{{--                        }--}}
{{--                        else{--}}
{{--                            Swal.fire({--}}
{{--                                position: 'center',--}}
{{--                                icon: 'error',--}}
{{--                                title: 'Please, Insert Today\'s Image',--}}
{{--                                showConfirmButton: false,--}}
{{--                                timer: 1800--}}
{{--                            })--}}
{{--                            submitBtn.display="none";--}}
{{--                        }--}}
{{--                    } else {--}}
{{--                        Swal.fire({--}}
{{--                            position: 'center',--}}
{{--                            icon: 'error',--}}
{{--                            title: 'Please, Select a valid Image',--}}
{{--                            showConfirmButton: false,--}}
{{--                            timer: 1800--}}
{{--                        })--}}
{{--                        document.getElementById("attendance_image").value = "";--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}
{{--@endsection--}}
