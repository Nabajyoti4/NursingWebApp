@extends('layouts.admin')
@section('title')
    Services
@endsection

@section('links')
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: {{$message}},
                showConfirmButton: true,
            })
        </script>
        @endif
    <div class="d-sm-inline-block justify-content-end">
        <a class="btn btn-primary" href="{{route('admin.services.create')}}">
            Create Service
            <i class="fa fa-user-plus" aria-hidden="true"></i>
        </a>
    </div>
    <hr>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Service</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive" >
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Service ID</th>
                        <th>Service</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($services as $service)
                        <tr>
                            <td>{{$service->title}}</td>
                            <td>{{$service->details}}</td>
                            <td>
                                <form action="{{route('services.destroy', $service->id)}}" method="POST">
                                 @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">DELETE</button>
                                </form>
                            </td>
                            <td><a class="btn btn-primary small" href="{{route('admin.services.edit',$service->id)}}">Edit</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No services found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
