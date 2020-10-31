@extends('layouts.admin')
@section('title')
    Bookings
@endsection

@section('content')

    <!-- Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{route('admin.book.index')}}" method="GET">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control border-2 small" name="booking" placeholder="Search using booking id"
                   aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
    <hr>


    <ul class="nav nav-tabs pt-2" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#pendingRequest" role="tab"
               aria-controls="home" aria-selected="true">Pending Request</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#approvedRequest" role="tab"
               aria-controls="profile" aria-selected="false">Active Request</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#rejectRequest" role="tab"
               aria-controls="profile" aria-selected="false">Rejected Request</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#takeoverRequest" role="tab"
               aria-controls="profile" aria-selected="false">Takeover Request</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#completedRequest" role="tab"
               aria-controls="profile" aria-selected="false">Completed Request</a>
        </li>
    </ul>
    <!-- Booking table with active booking ids -->
    <div class="col-md-12 p-0 pt-2">
        <div class="tab-content profile-tab" id="myTabContent">

            <!--PENDING-->
            <div class="tab-pane fade show active" id="pendingRequest" role="tabpanel" aria-labelledby="pendingRequest-tab">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Pending Bookings</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Patient ID</th>
                                    <th>Booked by</th>
                                    <th>Patient Name</th>
                                    <th>Nurse allotted</th>
                                    <th>Shift</th>
                                    <th>Days</th>
                                    <th>Total Payment</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($pbookings as $booking)
                                    <tr>
                                        <td>{{$booking->id}}</td>
                                        <td>{{$booking->patient->patient_id}}</td>
                                        <td>{{$booking->user->name}}</td>
                                        <td>{{$booking->patient->patient_name}}</td>
                                        <td>{{$booking->nurse->user->name}}</td>
                                        <td>{{$booking->patient->shift}}</td>
                                        <td>{{$booking->patient->days}}</td>
                                        <td>{{$booking->total_payment}}</td>

                                        <td><a class="btn btn-primary small" href="{{route('admin.book.show',$booking->id)}}">Show</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No Bookings found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <!--active-->
            <div class="tab-pane fade" id="approvedRequest" role="tabpanel" aria-labelledby="approvedRequest-tab">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Active Bookings</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Patient ID</th>
                                    <th>Booked by</th>
                                    <th>Patient Name</th>
                                    <th>Nurse allotted</th>
                                    <th>Shift</th>
                                    <th>Days</th>
                                    <th>Total Payment</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($abookings as $booking)
                                    <tr>
                                        <td>{{$booking->id}}</td>
                                        <td>{{$booking->patient->patient_id}}</td>
                                        <td>{{$booking->user->name}}</td>
                                        <td>{{$booking->patient->patient_name}}</td>
                                        <td>{{$booking->nurse->user->name}}</td>
                                        <td>{{$booking->patient->shift}}</td>
                                        <td>{{$booking->patient->days}}</td>
                                        <td>{{$booking->total_payment}}</td>

                                        <td><a class="btn btn-primary small" href="{{route('admin.book.show',$booking->id)}}">Show</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No Bookings found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <!--reject-->
            <div class="tab-pane fade" id="rejectRequest" role="tabpanel" aria-labelledby="rejectRequest-tab">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Rejected Bookings</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Patient ID</th>
                                    <th>Booked by</th>
                                    <th>Patient Name</th>
                                    <th>Nurse allotted</th>
                                    <th>Shift</th>
                                    <th>Days</th>
                                    <th>Total Payment</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($rbookings as $booking)
                                    <tr>
                                        <td>{{$booking->id}}</td>
                                        <td>{{$booking->patient->patient_id}}</td>
                                        <td>{{$booking->user->name}}</td>
                                        <td>{{$booking->patient->patient_name}}</td>
                                        <td>{{$booking->nurse->user->name}}</td>
                                        <td>{{$booking->patient->shift}}</td>
                                        <td>{{$booking->patient->days}}</td>
                                        <td>{{$booking->total_payment}}</td>
                                        <td><a class="btn btn-primary small" href="{{route('admin.book.show',$booking->id)}}">Show</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No Bookings found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <!--takeover-->
            <div class="tab-pane fade" id="takeoverRequest" role="tabpanel" aria-labelledby="takeoverRequest-tab">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Takeover Bookings</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Patient ID</th>
                                    <th>Booked by</th>
                                    <th>Patient Name</th>
                                    <th>Nurse allotted</th>
                                    <th>Shift</th>
                                    <th>Days</th>
                                    <th>Total Payment</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($tbookings as $booking)
                                    <tr>
                                        <td>{{$booking->id}}</td>
                                        <td>{{$booking->patient->patient_id}}</td>
                                        <td>{{$booking->user->name}}</td>
                                        <td>{{$booking->patient->patient_name}}</td>
                                        <td>{{$booking->nurse->user->name}}</td>
                                        <td>{{$booking->patient->shift}}</td>
                                        <td>{{$booking->patient->days}}</td>
                                        <td>{{$booking->total_payment}}</td>
                                        <td><a class="btn btn-primary small" href="{{route('admin.book.show',$booking->id)}}">Show</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No Bookings found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <!--completed-->
            <div class="tab-pane fade" id="completedRequest" role="tabpanel" aria-labelledby="completedRequest-tab">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Completed Bookings</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Patient ID</th>
                                    <th>Booked by</th>
                                    <th>Patient Name</th>
                                    <th>Nurse allotted</th>
                                    <th>Shift</th>
                                    <th>Days</th>
                                    <th>Total Payment</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($cbookings as $booking)
                                    <tr>
                                        <td>{{$booking->id}}</td>
                                        <td>{{$booking->patient->patient_id}}</td>
                                        <td>{{$booking->user->name}}</td>
                                        <td>{{$booking->patient->patient_name}}</td>
                                        <td>{{$booking->nurse->user->name}}</td>
                                        <td>{{$booking->patient->shift}}</td>
                                        <td>{{$booking->patient->days}}</td>
                                        <td>{{$booking->total_payment}}</td>
                                        <td><a class="btn btn-primary small" href="{{route('admin.book.show',$booking->id)}}">Show</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No Bookings found</td>
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


@endsection


