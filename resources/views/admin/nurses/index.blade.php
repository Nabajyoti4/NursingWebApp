@extends('layouts.admin')
@section('title')
    Nurses
@endsection

@section('content')

    <!-- Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="" method="GET">
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

    <div class="d-sm-inline-block justify-content-end">
        <a class="btn btn-primary" href="{{route('admin.nurse.create')}}">
            create
        </a>
    </div>
    <hr>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
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
                        <th>Age</th>
                        <th>Shifts</th>
                        <th>Created at</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
{{--                    dummy tr  delete it when sending data --}}
                    <tr>

                        <td>1</td>
                        <td>raj</td>
                        <td>raj@gmail.com</td>
                        <td>7894561230</td>
                        <td>25</td>
                        <td>12hr</td>
                        <td>2 / 6 /2020</td>
                        <td><a class="btn btn-primary small" href="">Edit</a></td>
                    </tr>


{{--                    @forelse($nurses as $nurse)--}}
{{--                        <tr>                            --}}
{{--                            <td>{{$nurse->id}}</td>--}}
{{--                            <td>{{$nurse->name}}</td>--}}
{{--                            <td>{{$nurse->email}}</td>--}}
{{--                            <td>{{$nurse->phone_no}}</td>--}}
{{--                            <td>{{$nurse->age}}</td>--}}
{{--                            <td>{{$nurse->shifts}}</td>--}}
{{--                            <td>{{$nurse->created_at}}</td>--}}
{{--                            <td><a class="btn btn-primary small" href="{{route('admin.users.edit',$user->id)}}">Edit</a></td>--}}
{{--                        </tr>--}}
{{--                    @empty--}}
{{--                        <tr>--}}
{{--                            <td colspan="6">No users found</td>--}}
{{--                        </tr>--}}
{{--                    @endforelse--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
