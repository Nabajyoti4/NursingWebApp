@extends('layouts.admin')
@section('title')
    Users
@endsection

@section('content')

    <!-- Search -->
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control border-2 small " placeholder="Search for..."
                       aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">List of Admins</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Users</h6>
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
                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone_no}}</td>
                            <td>{{$user->created_at}}</td>
                            <td><a class="btn btn-primary small" href="{{route('admin.users.edit',$user->id)}}">Edit</a></td>
                        </tr>
                    @empty
                        <td>No users found</td>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
