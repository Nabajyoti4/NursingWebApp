@extends('layouts.admin')
@section('title')
    Nurse Candidates
@endsection

@section('content')

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

    <hr>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Candidates for Nurses</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Candidate ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Created at</th>
                        <th>Is Approved</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($candidates as $candidate)
                        <tr>
                            <td>{{$candidate->id}}</td>
                            <td>{{$candidate->name}}</td>
                            <td>{{$candidate->email}}</td>
                            <td>{{$candidate->phone_no}}</td>
                            <td>{{$candidate->age}}</td>
                            <td>{{$candidate->created_at}}</td>
                            <td>
                                @if($candidate->Approval == 0)
                                <form action="{{route('nursejoin.approve',$candidate->id)}}" method="post">
                                    @csrf
                                    <button class="btn btn-primary" type="submit">Approved</button>
                                </form>
                            @else
                                    <form action="{{route('nursejoin.disapprove',$candidate->id)}}" method="post">
                                        @csrf
                                        <button class="btn btn-primary" type="submit">Disapproved</button>
                                    </form>
                            @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No Candidate found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
