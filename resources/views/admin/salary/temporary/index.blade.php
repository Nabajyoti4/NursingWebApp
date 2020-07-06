@extends('layouts.admin')
@section('title')
    Salary Nurses
@endsection

@section('content')

    <!-- Search -->
    <form class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{route('admin.users.index')}}" method="GET">
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
            <h6 class="m-0 font-weight-bold text-primary">Nurses</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Created at</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody id="data">
                    @forelse($nurses as $nurse)
                        <tr>
                            <td>{{$nurse->id}}</td>
                            <td>{{$nurse->user->name}}</td>
                            <td>{{$nurse->user->email}}</td>
                            <td>{{$nurse->user->phone_no}}</td>
                            <td>{{$nurse->created_at}}</td>
                            <td><a class="btn btn-primary small" href="{{route('admin.salary.salaries')}}">Edit
                                </a><i class="fa fa-pencil-square" aria-hidden="true"></i></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No users found</td>
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
        setInterval(function() {
            $("#data").load(location.href+" #data>*","");
        }, 10000);
    </script>
@endsection
