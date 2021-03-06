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


    <!-- Booking table with active booking ids -->
    <div class="card shadow mb-4" id="usersTable">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Booking</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Booking ID</th>
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

                    @forelse($bookings as $booking)
                        <tr>
                            <td>{{$booking->id}}</td>
                            <td>{{$booking->user->name}}</td>
                            <td>{{$booking->patient->patient_name}}</td>
                            <td>{{$booking->nurse->user->name}}</td>
                            <td>{{$booking->patient->shift}}</td>
                            <td>{{$booking->patient->days}}</td>
                            <td>{{$booking->total_payment}}</td>
                            <td>
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
                                @endif
                            </td>
                            <td><a class="btn btn-primary small" href="{{route('admin.book.show',$booking->id)}}">Show</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No results found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection


