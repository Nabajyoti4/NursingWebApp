@extends('layouts.admin')
@section('title')
    Monthly Attendance Report
@endsection

@section('content')
    <ul class="nav nav-tabs pt-2" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#permanentNurse" role="tab"
               aria-controls="home" aria-selected="true">Permanent Nurse</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#temporaryNurse" role="tab"
               aria-controls="profile" aria-selected="false">Temporary Nurse</a>
        </li>
    </ul>
    <div class="col-md-12 p-0 pt-2">
        <div class="tab-content profile-tab" id="myTabContent">
            <!--Permanent Nurse Tsalary-->
            <div class="tab-pane fade show active" id="permanentNurse" role="tabpanel" aria-labelledby="home-tab">

                <!-- DataTales Example -->
                <div class="card shadow mb-4" id="usersTable">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-6 "><span class="m-0 font-weight-bold text-primary btn">Permanent Nurses</span></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTablePermanent" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Report</th>
                                </tr>
                                </thead>
                                <tbody id="data">
                                @forelse($permanent_nurses as $pnurse)
                                    <tr>
                                        <td>{{$pnurse->employee_id}}</td>
                                        <td>{{$pnurse->user->name}}</td>
                                        <td><a href="{{route('admin.dashboard.preport', $pnurse->id)}}">View</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No nurse found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!--Temporary Nurse Tsalary-->
            <div class="tab-pane fade" id="temporaryNurse" role="tabpanel" aria-labelledby="profile-tab">

                <!-- DataTales Example -->
                <div class="card shadow mb-4" id="usersTable">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-6"><span class="m-0 font-weight-bold text-primary btn "> Temporary Nurses</span></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTableTemporary" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Report</th>
                                </tr>
                                </thead>
                                <tbody id="data">
                                @forelse($temporary_nurses as $tnurse)
                                    <tr>
                                        <td>{{$tnurse->employee_id}}</td>
                                        <td>{{$tnurse->user->name}}</td>
                                        <td><a href="{{route('admin.dashboard.treport', $tnurse->id)}}">View</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No nurse found</td>
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
