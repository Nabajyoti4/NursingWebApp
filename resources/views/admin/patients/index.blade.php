@extends('layouts.admin')
@section('title')
    Patients
@endsection

@section('content')

    <!-- Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{route('admin.patient.approved')}}"
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
    <div class="d-sm-inline-block justify-content-end">
        <a class="btn btn-primary" href="{{route('admin.patient.create')}}">
            create
            <i class="fa fa-user-plus" aria-hidden="true"></i>
        </a>
    </div>
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
                        <th>Age</th>
                        <th>Status</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($patients as $patient)
                        <tr>
                            <td>{{$patient->patient_id}}</td>
                            <td>{{$patient->patient_name}}</td>
                            <td>{{$patient->phone_no}}</td>
                            <td>{{$patient->age}}</td>
                            <td>
                                @if($patient->status == 1)
                                    Approved
                                @elseif($patient->status == 0)
                                    Disapproved
                                @else
                                    Pending
                                @endif
                            </td>
                            <td>
                                <form action="{{route('admin.patient.show',$patient->id)}}" method="GET">
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


        {{--function getUser(){--}}
        {{--    axios.get(`{{route('api.users')}}`)--}}
        {{--        .then(result => {--}}
        {{--            console.log(result.data);--}}
        {{--        })--}}
        {{--        .catch(err => {--}}
        {{--            console.log(err);--}}
        {{--        })--}}
        {{--}--}}
    </script>

@endsection
