@extends('layouts.admin')
@section('title')
    Nurse Candidates
@endsection

@section('style')
    <style>
        #loading {
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: fixed;
            display: block;
            opacity: 1;
            background-color: #fff;
            z-index: 99;
            text-align: center;
        }

        #loading-image {
            width: 100%;
            height: 100%;
            z-index: 100;
        }
    </style>
@endsection



@section('content')

{{--    <div id="loading">--}}
{{--        <img id="loading-image" src="{{asset('img/loader.gif')}}" alt="Loading..." />--}}
{{--    </div>--}}


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
        <!--Permanent Nurse Tsalary-->
        <div class="tab-pane fade show active" id="pendingRequest" role="tabpanel" aria-labelledby="pendingRequest-tab">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Candidates for Nurses</h6>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Candidate ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Age</th>
                                <th>Status</th>
                                <th>Approve</th>
                                <th>Create</th>
                                <th>Disapprove</th>
                            </tr>
                            </thead>
                            <tbody id="nurseTable">
                            @forelse($pcandidates as $candidate)
                                <tr>
                                    <td>{{$candidate->id}}</td>
                                    <td>{{$candidate->name}}</td>
                                    <td>{{$candidate->email}}</td>
                                    <td>{{$candidate->phone_no}}</td>
                                    <td>{{$candidate->age}}</td>
                                    <td>
                                        @if($candidate->Approval == 1)
                                            Approved
                                        @elseif($candidate->Approval == 0)
                                            Disapproved
                                        @else
                                            Pending
                                        @endif

                                    </td>
                                    <td>

                                        <form action="{{route('nursejoin.approve',$candidate->id)}}" method="post">
                                            @csrf
                                            <button class="btn btn-primary"  type="submit">Approved</button>
                                        </form>
                                    </td>
                                    <td>
                                        @if($candidate->Approval == 1)
                                            @if($candidate->check_role($candidate->id) == 'nurse')
                                                Nurse Created
                                            @else
                                                <form action="{{route('admin.nurse.join',$candidate->user_id)}}" method="GET">
                                                    @csrf
                                                    <button class="btn btn-primary"  type="submit">Create</button>
                                                </form>
                                            @endif
                                        @else
                                            Not Approved
                                        @endif
                                    </td>
                                    <td>
                                        @if($candidate->Approval == 1)
                                            Nurse Approved
                                        @else
                                            <button class="btn btn-primary"  onclick="handleDisapprove({{$candidate->id}})">Disapproved</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">No Candidate found</td>
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
                                                <input type="text" class="form-control" name="recipient" />
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

        </div>

        <!--Temporary Nurse Tsalary-->
        <div class="tab-pane fade" id="approvedRequest" role="tabpanel" aria-labelledby="approvedRequest-tab">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Candidates for Nurses</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Candidate ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Age</th>
                                <th>Status</th>
                                <th>Approve</th>
                                <th>Create</th>
                                <th>Disapprove</th>
                            </tr>
                            </thead>
                            <tbody id="nurseTable">
                            @forelse($acandidates as $candidate)
                                <tr>
                                    <td>{{$candidate->id}}</td>
                                    <td>{{$candidate->name}}</td>
                                    <td>{{$candidate->email}}</td>
                                    <td>{{$candidate->phone_no}}</td>
                                    <td>{{$candidate->age}}</td>
                                    <td>
                                        @if($candidate->Approval == 1)
                                            Approved
                                        @elseif($candidate->Approval == 0)
                                            Disapproved
                                        @else
                                            Pending
                                        @endif

                                    </td>
                                    <td>

                                        <form action="{{route('nursejoin.approve',$candidate->id)}}" method="post">
                                            @csrf
                                            <button class="btn btn-primary"  type="submit">Approved</button>
                                        </form>
                                    </td>
                                    <td>
                                        @if($candidate->Approval == 1)
                                            @if($candidate->check_role($candidate->id) == 'nurse')
                                                Nurse Created
                                            @else
                                                <form action="{{route('admin.nurse.join',$candidate->user_id)}}" method="GET">
                                                    @csrf
                                                    <button class="btn btn-primary"  type="submit">Create</button>
                                                </form>
                                            @endif
                                        @else
                                            Not Approved
                                        @endif
                                    </td>
                                    <td>
                                        @if($candidate->Approval == 1)
                                            Nurse Approved
                                        @else
                                            <button class="btn btn-primary"  onclick="handleDisapprove({{$candidate->id}})">Disapproved</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">No Candidate found</td>
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
                                                <input type="text" class="form-control" name="recipient" />
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

        </div>

        <!--Temporary Nurse Tsalary-->
        <div class="tab-pane fade" id="rejectedRequest" role="tabpanel" aria-labelledby="rejectedRequest-tab">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Candidates for Nurses</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Candidate ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Age</th>
                                <th>Status</th>
                                <th>Approve</th>
                                <th>Create</th>
                                <th>Disapprove</th>
                            </tr>
                            </thead>
                            <tbody id="nurseTable">
                            @forelse($rcandidates as $candidate)
                                <tr>
                                    <td>{{$candidate->id}}</td>
                                    <td>{{$candidate->name}}</td>
                                    <td>{{$candidate->email}}</td>
                                    <td>{{$candidate->phone_no}}</td>
                                    <td>{{$candidate->age}}</td>
                                    <td>
                                        @if($candidate->Approval == 1)
                                            Approved
                                        @elseif($candidate->Approval == 0)
                                            Disapproved
                                        @else
                                            Pending
                                        @endif

                                    </td>
                                    <td>

                                        <form action="{{route('nursejoin.approve',$candidate->id)}}" method="post">
                                            @csrf
                                            <button class="btn btn-primary"  type="submit">Approved</button>
                                        </form>
                                    </td>
                                    <td>
                                        @if($candidate->Approval == 1)
                                            @if($candidate->check_role($candidate->id) == 'nurse')
                                                Nurse Created
                                            @else
                                                <form action="{{route('admin.nurse.join',$candidate->user_id)}}" method="GET">
                                                    @csrf
                                                    <button class="btn btn-primary"  type="submit">Create</button>
                                                </form>
                                            @endif
                                        @else
                                            Not Approved
                                        @endif
                                    </td>
                                    <td>
                                        @if($candidate->Approval == 1)
                                            Nurse Approved
                                        @else
                                            <button class="btn btn-primary"  onclick="handleDisapprove({{$candidate->id}})">Disapproved</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">No Candidate found</td>
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
                                                <input type="text" class="form-control" name="recipient" />
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


{{--    <script>--}}
{{--        $(window).on('load', function () {--}}
{{--            $("#loading").fadeOut("slow");--}}
{{--        });--}}
{{--    </script>--}}



@endsection
