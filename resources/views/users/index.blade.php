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

        tr:hover{
            background: lightgrey;
            transition: all .5s;
            color: black;
            font-weight: bold;
        }
        

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
            opacity: 1; }
        img[src=""] {
            display:none;
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
    @endif
    <div class="p-4">
        <div class="container emp-profile mt-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="{{ $user->photo?asset("/storage/".$user->photo->photo_location) :'No Photo'}}" alt=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5>
                            {{$user->name}}
                        </h5>
                        <h6>
                            {{"Role"}}
                        </h6>
                        <ul class="nav nav-tabs pt-5" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Patient request  Details</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('users.edit', $user->id) }}" style="text-decoration: none">
                        <div  class="profile-edit-btn text-center">Edit Profile</div>
                    </a>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12 p-5">
                    <div class="tab-content profile-tab" id="myTabContent">
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
                                    <label>Permanent Address</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->addresses->first() ? $user->addresses->first()->city : "Fill the Permanent Address"}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Current Address</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->addresses->last() ? $user->addresses->last()->city : "Fill the Current Address"}}</p>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                            <div class="card shadow mb-4" id="userPatientTable">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead >
                                            <tr class="bg-dark text-white">
                                                <th>Patient ID</th>
                                                <th>Name</th>
                                                <th>Phone No</th>
                                                <th>Age</th>
                                                <th>Status</th>
                                                <th>Request date</th>
                                                <th>View</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($patients as $patient)
                                                <tr>
                                                    <td>{{$patient->id}}</td>
                                                    <td>{{$patient->patient_name}}</td>
                                                    <td>{{$patient->phone_no}}</td>
                                                    <td>{{$patient->age}}</td>
                                                    <td>
                                                        @if($patient->status == 1)
                                                            Approved
                                                        @elseif($patient->status == 0)
                                                            Dissapproved
                                                        @else
                                                            Pending
                                                        @endif
                                                    </td>
                                                    <td>{{$patient->created_at}}</td>
                                                    <td>
                                                        <form action="{{route('users.patient.show',$patient->id)}}" method="GET">
                                                            @csrf
                                                            <button class="btn btn-primary"  type="submit">Show</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">No Patient Request found</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
