@extends('layouts.admin')
@section('title')
    Patients
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
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{route('admin.receipts.index')}}"
          method="GET">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control border-2 small" name="patient" placeholder="Search for..."
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
    <div class="card shadow mb-4" id="nurseTable">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Patients</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th>Name</th>
                        <th>Phone No</th>
                        <th>Location from where Service is Taken</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($patients as $patient)
                        <tr>
                            <td>{{$patient->patient_id}}</td>
                            <td>{{$patient->patient_name}}</td>
                            <td>{{$patient->phone_no}}</td>
                            <td style="text-transform: capitalize">{{$patient->office_location}}</td>
                            <td>
                                <form action="{{route('admin.receipts.show',$patient->patient_id)}}" method="GET">
                                    @csrf
                                    <button class="btn btn-primary"  type="submit">View Detials</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No Patients found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        function handleDisapprove(id){

            var message = document.getElementById('disapproveRequestMessage')

            message.action = "/nursejoin/" + id + "/disapprove"

            $('#disapproveModal').modal('show')
        }
    </script>

@endsection
