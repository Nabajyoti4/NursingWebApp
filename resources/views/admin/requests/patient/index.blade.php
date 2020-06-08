@extends('layouts.admin')
@section('title')
    Nurse Candidates
@endsection

@section('content')

    <!-- Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action=""
          method="GET">
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
    <div class="card shadow mb-4" id="nurseTable">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Patient Requests</h6>
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
                        <th>Disapprove</th>
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
                            <td>
                                <form action="{{route('admin.patient.show',$patient->id)}}" method="GET">
                                    @csrf
                                    <button class="btn btn-primary"  type="submit">Show</button>
                                </form>
                            </td>
                            <td>
                                <button class="btn btn-primary"  onclick="handleDisapprove({{$patient->id}})">Disapprove</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No Patient Request found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <!--pop up model-->
                <div class="modal fade" id="disapproveModal" tabindex="-1" role="dialog" aria-labelledby="disapproveModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="" method="post" id="disapproveRequestMessage">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="disapproveModalLabel">Reason For Rejection</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                                        <input type="text" class="form-control" name="recipient">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Message:</label>
                                        <textarea class="form-control" name="message" ></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button  class="btn btn-primary" type="submit">Send message</button>
                                    </div>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <!--pop up model end-->

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
