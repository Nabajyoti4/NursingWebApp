@extends('layouts.admin')
@section('title')
    Nurses
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
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action=""
          method="GET">
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
            <i class="fa fa-user-plus" aria-hidden="true"></i>
        </a>
    </div>
    <hr>

    <!-- Nurse table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Nurses</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Profile Image</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Active</th>
                        <th>View Profile</th>
                        <th>Edit</th>
                        <th>Make Permanent</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($nurses as $nurse)
                        <tr>
                            <td>{{$nurse->employee_id}}</td>
                            <td><img
                                    src="{{ $nurse->user->photo?asset("/storage/".$nurse->user->photo->photo_location) :'http://placehold.it/64x64'}}"
                                    alt="" width="100" height="100"
                                /></td>
                            <td>{{$nurse->user->name}}</td>
                            <td>@if($nurse->status == 0)
                                    Not Hired
                                @else
                                    Booked
                                @endif
                            </td>
                            <td>@if($nurse->is_active == 0)
                                    On leave
                                @else
                                    Working
                                @endif</td>
                            <td><a class="btn btn-primary small"
                                   href="{{route('admin.nurse.show',$nurse->id)}}">Show</a></td>
                            <td><a class="btn btn-primary small"
                                   href="{{route('admin.nurse.edit',$nurse->id)}}">Edit</a></td>
                            @if($nurse->permanent == 0)
                                <td><a class="btn btn-primary small"
                                       href="{{route('admin.nurse.makePermanent',$nurse->id)}}">Permanent</a></td>
                            @else
                                <td><a class="btn btn-primary small disabled"
                                       href="{{route('admin.nurse.makePermanent',$nurse->id)}}">Permanent</a></td>
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


