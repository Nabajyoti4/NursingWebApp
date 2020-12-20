@extends('layouts.admin')
@section('title')
    Bookings
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
    @endif
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
    <div class="tab-pane fade show active" id="pendingRequest" role="tabpanel" aria-labelledby="pendingRequest-tab">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{$patient->patient_name}} Bookings</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive" >
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Patient ID</th>
                            <th>Start Date</th>
                            <th>Show</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($bookings as $booking)
                            <tr>
                                <td>{{$booking->patient->patient_id}}</td>
                                <td>{{$booking->start_date}}</td>
                                <td>
                                    <a href="{{route('admin.patient.receipt', $booking->patient->id)}}" class="btn btn-primary">Receipt</a>
                                </td>
                                <td>
                                    <a href="{{route('admin.patient.money-receipt', $booking->patient->id)}}" target="_blank" class="btn btn-primary">Money Receipt</a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">No Bookings found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


@endsection
