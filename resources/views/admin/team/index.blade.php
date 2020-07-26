@extends('layouts.admin')
@section('title')
    Team
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
    <form class="d-none d-sm-inline-block form-inline mr-auto  my-2 my-md-0 mw-100 navbar-search"
          action="{{route('admin.teams.index')}}" method="GET">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control border-2 small" name="nurse" placeholder="Search for..."
                   aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <div class="d-sm-inline-block justify-content-end">
        <a class="btn btn-primary" href="{{route('admin.teams.create')}}">
            create
            <i class="fa fa-user-plus" aria-hidden="true"></i>
        </a>
    </div>
    <hr>

    <!-- Nurse table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Team Members</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Profile Image</th>
                        <th>Designation</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($members as $member)
                        <tr>
                            <td>{{$member->id}}</td>
                            <td>{{$member->name}}</td>
                            <td><img
                                    src="{{ $member->photo?asset("storage/".$member->photo) :'http://placehold.it/64x64'}}"
                                    alt="" width="100" height="100"
                                /></td>
                            <td>{{$member->designation}}</td>
                            <td><a class="btn btn-primary small"
                                   href="{{route('admin.teams.edit',$member->id)}}">Edit</a></td>
                            <td>
                                <form action="{{route('teams.destroy',$member->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No Members found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


