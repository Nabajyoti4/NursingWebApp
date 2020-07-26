@extends('layouts.admin')
@section('title')
    Ratings
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

    <div class="d-sm-inline-block justify-content-end">
        <a class="btn btn-primary" href="{{route('admin.rating.create')}}">
            create
            <i class="fa fa-user-plus" aria-hidden="true"></i>
        </a>
    </div>
    <hr>

    <!-- Nurse table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rating</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Nurse Name</th>
                        <th>Stars</th>
                        <th>Avatar</th>
                        <th>Remark</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($ratings as $rating)
                        <tr>
                            <td>{{$rating->name}}</td>
                            <td>{{$rating->star}}</td>
                            <td>   <img
                                    src="{{asset("/storage/".$rating->photo)}}"
                                    alt="" width="100" height="100"
                                /></td>
                            <td>{{$rating->remark}}</td>
                            <td><a class="btn btn-primary small"
                                   href="{{route('admin.rating.edit',$rating->id)}}">Edit</a>
                            </td>
                            <td>
                                <form action="{{route('rating.destroy', $rating->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"  class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No Ratings found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


