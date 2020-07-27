@extends('layouts.admin')
@section('title')
    Pricing
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
        <a class="btn btn-primary" href="{{route('admin.price.create')}}">
            Create
            <i class="fa fa-user-plus" aria-hidden="true"></i>
        </a>
    </div>

    <hr>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Services Prices</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Service type</th>
                        <th>No of Days</th>
                        <th>Timings</th>
                        <th>Period (day/night/full)</th>
                        <th>Price per month</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($prices as $price)
                        <tr>
                            <td>{{$price->name}}</td>
                            <td>{{$price->days}}</td>
                            <td>{{$price->timing}}</td>
                            <td>{{$price->period}}</td>
                            <td>{{$price->price}}</td>
                            <td><a class="btn btn-primary small"
                                   href="{{route('admin.price.edit',$price->id)}}">Edit</a>
                            </td>
                            <td>
                                <form action="{{route('price.destroy', $price->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"  class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No New Service Prices found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
