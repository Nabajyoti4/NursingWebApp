@extends('layouts.admin')
@section('title')
    Admins
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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Queries</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>District</th>
                        <th>Email</th>
                        <th>Query</th>
                        <th>Created at</th>
                        <th>Responded</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($queries as $query)
                        <tr>
                            <td>{{$query->name}}</td>
                            <td>{{$query->phone}}</td>
                            <td>{{$query->city}}</td>
                            <td>{{$query->email}}</td>
                            <td>{{$query->query}}</td>
                            <td>{{$query->created_at}}</td>
                            <td>@if($query->status == 0)
                                <a class="btn btn-primary small" href="{{route('admin.query.update',$query->id)}}">Mark Done
                                </a><i class="fa fa-pencil-square" aria-hidden="true"></i>
                                @else
                                    Responded Successfully
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No Pending Queries found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
