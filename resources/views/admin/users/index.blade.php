@extends('layouts.admin')
@section('title')
    Users
@endsection

@section('content')

    <!-- Search -->
    <form class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
          action="{{route('admin.users.index')}}" method="GET">
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
            <h6 class="m-0 font-weight-bold text-primary">Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>Phone No</th>
                        <th>Edit</th>
                        @if(Auth::user()->role == 'super')
                            <th>Role</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody id="data">
                    @forelse($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->current_address_id?$user->address($user->getCAddressId($user->id))->city : "No city"}}</td>   <td>{{$user->phone_no}}</td>
                            <td><a class="btn btn-primary small" href="{{route('admin.users.edit',$user->id)}}">Edit
                                </a><i class="fa fa-pencil-square" aria-hidden="true"></i>
                            </td>
                            @if(Auth::user()->role == 'super')
                                <td>
                                    @if($user->permanent_address_id > 0)
                                        <a class="btn btn-primary small text-white" onclick="confirmAdmin{{$user->id}}()">Make
                                            Admin
                                            <script>
                                                function confirmAdmin{{$user->id}}() {
                                                    Swal.fire({
                                                        title: '<b>Are you sure? You want to make <h2>{{$user->name}}</h2> Admin</b>',
                                                        text: "You won't be able to revert this!",
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#3085d6',
                                                        cancelButtonColor: '#d33',
                                                        confirmButtonText: 'Yes, Make Admin!'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            Swal.fire({
                                                                title: "Are you sure?",
                                                                html: '<a class="btn btn-primary" href="{{route('admin.users.admin',$user->id)}}">Yes</a>',
                                                                showConfirmButton: false,
                                                            })
                                                        }
                                                    })
                                                }
                                            </script>
                                        </a><i class="fa fa-pencil-square" aria-hidden="true"></i>
                                    @else
                                        No Address
                                    @endif
                                </td>
                            @endif

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
        setInterval(function () {
            $("#data").load(location.href + " #data>*", "");
        }, 10000);
    </script>
@endsection
