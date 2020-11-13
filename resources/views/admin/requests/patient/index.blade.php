@extends('layouts.admin')
@section('title')
    Patient Requests
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
    <ul class="nav nav-tabs pt-2" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#pendingRequest" role="tab"
               aria-controls="home" aria-selected="true">Pending Request</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#approvedRequest" role="tab"
               aria-controls="profile" aria-selected="false">Approved Request</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#rejectedRequest" role="tab"
               aria-controls="profile" aria-selected="false">Disapproved Request</a>
        </li>
    </ul>
    <div class="col-md-12 p-0 pt-2">
        <div class="tab-content profile-tab" id="myTabContent">
            <!--Pending -->
            <div class="tab-pane fade show active" id="pendingRequest" role="tabpanel" aria-labelledby="pendingRequest-tab">
                <!-- DataTales Example -->
                <div class="card shadow mb-4" >
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
                                    <th>Book</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($ppatients as $patient)
                                    <tr>
                                        <td>{{$patient->patient_id}}</td>
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
                                        <td>@if($patient->status == 1)
                                                @if(\App\Booking::where('patient_id',$patient->id)->get()->isEmpty())
                                                    <form action="{{route('admin.book.bookCreate',$patient->id)}}" method="get">
                                                        @csrf
                                                        <button class="btn btn-primary"  type="submit">Book</button>
                                                    </form>
                                                @else
                                                    Booked
                                                @endif
                                            @else
                                                Not Approved
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">No Patient Request found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>

            <!--Approved -->
            <div class="tab-pane fade" id="approvedRequest" role="tabpanel" aria-labelledby="approvedRequest-tab">
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
                                    <th>Book</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($apatients as $patient)
                                    <tr>
                                        <td>{{$patient->patient_id}}</td>
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
                                        <td>@if($patient->status == 1)
                                                @if(\App\Booking::where('patient_id',$patient->id)->get()->isEmpty())
                                                    <form action="{{route('admin.book.bookCreate',$patient->id)}}" method="get">
                                                        @csrf
                                                        <button class="btn btn-primary"  type="submit">Book</button>
                                                    </form>
                                                @else
                                                    Booked
                                                @endif
                                            @else
                                                Not Approved
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">No Patient Request found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>

            <!--Disapproved -->
            <div class="tab-pane fade" id="rejectedRequest" role="tabpanel" aria-labelledby="rejectedRequest-tab">
                <!-- DataTales Example -->
                <div class="card shadow mb-4" >
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
                                    <th>Reason</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($rpatients as $patient)
                                    <tr>
                                        <td>{{$patient->patient_id}}</td>
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
                                            @if(\App\Reject::where('patient_id', $patient->id)->get()->first()->tag == 'nurse')
                                                Nurse Not available
                                            @else
                                                Area Not Covered
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">No Patient Request found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>



                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                                <label for="reason" class="col-form-label">Reason:</label>
                                <textarea class="form-control" name="reason" ></textarea>
                            </div>

                            <div class="form-group ">
                                <label for="tag">Tag :</label>
                                <select name="tag" class="form-control">
                                    <option value="area">Area Not Covered</option>
                                    <option value="nurse">Nurse Not available</option>
                                    <option value="service">Service Required Not covered</option>
                                </select>
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

@endsection

@section('script')

    <script>
        function handleDisapprove(id){

            var message = document.getElementById('disapproveRequestMessage')

            message.action = "/admin/patient/" + id + "/disapprove"

            $('#disapproveModal').modal('show')
        }

    </script>

@endsection
