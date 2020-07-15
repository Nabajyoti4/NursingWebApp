@extends('layouts.admin')
@section('title')
    Admin Panel
@endsection
@section('style')
<style>
    a:hover{
        text-decoration: none;!important;
    }
</style>
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Attendance (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{route('admin.dashboard.attendance')}}" class="">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Attendances</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <!-- salary (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{route('admin.salary.index')}}" class="">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Salary</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-2x  fa-money-check-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{route('nursejoin.index')}}" class="">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Nurse Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$nurseRequest}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{route('admin.patient.index')}}" class="">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Patient Requests
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$ppatientRequest}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <!-- Current Bookings Attendance  -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{route('admin.dashboard.mark')}}">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Attendance Per Day
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
    <div class="row">

        @if($admin->role == "super")

            <!-- Bar Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Bookings</h6>

                        <span hidden id="reject">{{$rbooking}}</span>
                        <span hidden id="pending">{{$pbooking}}</span>
                        <span hidden id="active" >{{$abooking}}</span>
                        <span hidden id="complete" >{{$cbooking}}</span>
                        <span hidden id="takeover" >{{$tbooking}}</span>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">(Users Vs Nurses Vs Patients)Counts</h6>

                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <span hidden id="users">{{$users}}</span>
                        <span hidden id="nurses">{{$nurses}}</span>
                        <span hidden id="patients" >{{$patients}}</span>

                        <div class="mt-4 text-center small">
                        <span class="mr-2">
                          <i class="fas fa-circle text-primary"></i>  Users
                        </span>
                            <span class="mr-2">
                          <i class="fas fa-circle text-success"></i> Nurses
                        </span>
                            <span class="mr-2">
                          <i class="fas fa-circle text-info"></i> Patients
                        </span>
                        </div>
                    </div>
                </div>
            </div>

            @endif

    </div>

@endsection
@section('script')
    <!-- Page level plugins -->
    <script src="{{asset('js/admin/Chart.min.js')}}"></script>
    <!-- Page level custom scripts -->
    <script src="{{asset('js/admin/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/admin/chart-pie-demo.js')}}"></script>
@endsection
