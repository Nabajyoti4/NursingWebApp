@extends('layouts.admin')
@section('title')
   Today Attendance Report
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
    <!-- Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="" method="GET">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control border-2 small" name="searchUser" placeholder="Search for..."
                   aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>


    <hr>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Booked Nurses</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Today Attendance</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            <td>{{$booking->nurse->employee_id}}</td>
                            <td>{{$booking->nurse->user->name}}</td>
                            <td>
                                @if($booking->nurse->day_attendance($booking->nurse->id) == 1)
                                    Present
                                @elseif($booking->nurse->day_attendance($booking->nurse->id) == 2)
                                    Absent
                                @else
                                    {{$booking->nurse->day_attendance($booking->nurse->id)}}
                                @endif

                            </td>
                            <td>
                                @if($booking->nurse->day_attendance($booking->nurse->id) == 'Not Marked')
                                        <a class="btn btn-success" href="{{route('admin.mark.present', $booking->nurse->id)}}">Present</a>
                                        <a class="btn btn-danger " href="{{route('admin.mark.absent', $booking->nurse->id)}}">Absent</a>
                                @else
                                    Attendance Marked
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No Attendance for today</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
