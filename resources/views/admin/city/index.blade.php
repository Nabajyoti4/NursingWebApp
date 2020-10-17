@extends('layouts.admin')
@section('title')
    District
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

    <div class="d-sm-inline-block justify-content-end">
        <a class="btn btn-primary" href="{{route('admin.city.create')}}">
            create
            <i class="fa fa-user-plus" aria-hidden="true"></i>
        </a>
    </div>

    <hr>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">District</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>District Id</th>
                        <th>District</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($cities as $city)
                        <tr>
                            <td>{{$city->id}}</td>
                            <td>{{$city->city}}</td>
                            <td><a class="btn btn-primary small"
                                   href="{{route('admin.city.edit',$city->id)}}">Edit</a>
                            </td>
                            <td>
                                <form action="{{route('admin.city.delete', $city->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"  class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No District found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


