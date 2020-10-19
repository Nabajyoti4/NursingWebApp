@extends('layouts.admin')
@section('title')
    Users
@endsection

@section('content')

    <!-- Search -->
    <form class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
          action="{{route('admin.employee.index')}}" method="GET">
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
    <div class="card shadow mb-4" id="usersTable">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Employees</h6>
            <hr>
            <form action="{{route('admin.employee.filter')}}" method="POST">
                @csrf
                <label class="form-group font-weight-bold"> Role
                    <select class="form-control" name="role">
                    @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->role}}</option>
                    @endforeach
                    </select>
                </label>
                <label class="form-group font-weight-bold"> City
                    <select class="form-control" name="city">
                        @foreach($cities as $city)
                            <option value="{{$city->city}}">{{$city->city}}</option>
                        @endforeach
                    </select>
                </label>
                <label>
                    <button class="btn btn-primary" type="submit">Filter</button>
                </label>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>Phone No</th>
                        <th>Role</th>
                    </tr>
                    </thead>
                    <tbody id="data">
                    @forelse($employees as $employee)
                        <tr>
                            <td>{{$employee->employee_id}}</td>
                            <td>{{$employee->user->name}}</td>
                            <td>{{$employee->user->email}}</td>
                            <td>{{$employee->city}}</td>
                            <td>{{$employee->user->phone_no}}</td>
                            <td>{{$employee->role($employee->role)}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No Employee found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

