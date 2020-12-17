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
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{route('admin.nurse.index')}}" method="GET">
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
    <hr>


    <!-- Nurse table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Nurses</h3>
            <form action="{{route('admin.nurse.filter')}}" method="POST">
                @csrf
                <label class="form-group font-weight-bold">
                    <select class="form-control" name="city">
                        <option value="">Select District</option>
                        @foreach($cities as $city)
                            <option value="{{$city->city}}" style="text-transform: uppercase;">{{$city->city}}</option>
                        @endforeach
                    </select>
                </label>
                <label>
                    <button class="btn btn-primary" type="submit">Filter</button>
                </label>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Profile Image</th>
                        <th>Name</th>
                        <th>District</th>
                        <th>Status</th>
                        <th>Active</th>
                        <th>View Profile</th>
                        <th>Edit</th>
                        @if(Auth::user()->role == 'super')
                        <th>Make Permanent</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($nurses as $nurse)
                        <tr>
                            <td>{{$nurse->employee_id}}</td>
                            <td><img
                                    src="{{ $nurse->user->photo?asset("/storage/".$nurse->user->photo->photo_location) :'http://placehold.it/64x64'}}"
                                    alt="" width="100" height="100" /></td>
                            <td>{{$nurse->user->name}}</td>
                            <td style="text-transform: capitalize;">{{$nurse->user->address($nurse->user->getCAddressId($nurse->user->id))->city}}</td>
                            <td>
                                @if($nurse->status === 0)
                                    Not Hired
                                @else
                                    Booked
                                @endif
                            </td>
                            <td>
                                @if($nurse->is_active === 0)
                                    On leave
                                @else
                                    Working
                                @endif
                            </td>
                            <td><a class="btn btn-primary small"
                                   href="{{route('admin.nurse.show',$nurse->id)}}">Show</a></td>
                            <td><a class="btn btn-primary small"
                                   href="{{route('admin.nurse.edit',$nurse->id)}}">Edit</a></td>
                            @if(Auth::user()->role == 'super')
                            @if($nurse->permanent == 0)
                                <td><a class="btn btn-primary small"
                                       href="{{route('admin.nurse.makePermanent',$nurse->id)}}">Permanent</a></td>
                            @else
                                <td><a class="btn btn-primary small disabled"
                                       href="{{route('admin.nurse.makePermanent',$nurse->id)}}">Permanent</a></td>
                                @endif
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No users found <a class="btn btn-primary" href="{{route('admin.nurse.index')}}">Show all</a></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


