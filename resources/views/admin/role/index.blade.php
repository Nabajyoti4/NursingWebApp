@extends('layouts.admin')
@section('title')
    Roles
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
    @if ($message = Session::get('warning'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: '{{$message}}',
                showConfirmButton: true,
            })
        </script>
    @endif

    <div class="d-sm-inline-block justify-content-end">
        <a class="btn btn-primary" href="{{route('admin.role.create')}}">
            create
            <i class="fa fa-user-plus" aria-hidden="true"></i>
        </a>
    </div>

    <hr>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Role</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Role Id</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->role}}</td>
                            <td><a class="btn btn-primary small"
                                   href="{{route('admin.role.edit',$role->id)}}">Edit</a>
                            </td>
                            <td>
                                <form action="{{route('admin.role.delete', $role->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"  class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No Roles found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


