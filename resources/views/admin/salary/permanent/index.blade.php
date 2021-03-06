@extends('layouts.admin')
@section('title')
    Permanent Nurses Salaries
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
    <form class="d-sm-inline-block form-inline mr-auto my-2 my-md-0 mw-100 navbar-search"
          action="{{route('admin.salary.permanent')}}" method="GET">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control border-2 small" name="perm" placeholder="Employee ID..."
                   aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>


    <hr>
    <a href="{{route('admin.salary.create',$permanent=1)}}" class="btn btn-primary">Create Salary for the Nurse</a>
    <hr>
    <!-- DataTales Example -->
    @if(Auth::user()->role=='super')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Employees</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Created at</th>
                            <th>View</th>
                        </tr>
                        </thead>
                        <tbody >
                        @forelse($emps as $emp)
                            <tr>
                                <td>{{$emp->employee_id}}</td>
                                <td>{{$emp->user->name}}</td>
                                <td>{{$emp->user->email}}</td>
                                <td>{{$emp->user->phone_no}}</td>
                                <td>{{$emp->created_at}}</td>
                                <td><a class="btn btn-primary small" href="{{route('admin.salary.salaries',$emp->employee_id)}}">View
                                        Salary
                                    </a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No Employees</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4" id="usersTable">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Permanent Nurse</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Nurse Name</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Created at</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody id="data">
                    @forelse($nurses as $nurse)
                        <tr>
                            <td>{{$nurse->employee_id}}</td>
                            <td>{{$nurse->user->name}}</td>
                            <td>{{$nurse->user->email}}</td>
                            <td>{{$nurse->user->phone_no}}</td>
                            <td>{{$nurse->created_at}}</td>
                            <td><a class="btn btn-primary small" href="{{route('admin.salary.salaries',$nurse->employee_id)}}">View
                                    Salary
                                </a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No Nurses</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        setInterval(function () {
            $("#data").load(location.href + " #data>*", "");
        }, 10000);
    </script>
@endsection
