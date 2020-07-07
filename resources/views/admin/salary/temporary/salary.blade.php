@extends('layouts.admin')
@section('title')
    Salary Nurses
@endsection

@section('content')

    <!-- Search -->
    <form class="d-sm-inline-block form-inline mr-auto  my-2 my-md-0 mw-100 navbar-search"
          action="{{route('admin.users.index')}}" method="GET">
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
    <div class="card shadow mb-4" id="usersTable">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Nurse Name : {{$nurse->user->name}}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="data">
                    @forelse($salaries as $salary)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($salary->created_at)->englishMonth}}</td>
                            <td>{{ \Carbon\Carbon::parse($salary->created_at)->year}}</td>
                            <td><a class="btn btn-primary small" href="{{route('admin.salary.edit',$salary->id)}}">Edit
                                </a></td>
                        </tr>
                    @empty

                       <tr>
                           <td colspan="3"> no data</td>
                       </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        setInterval(function () {
            $("#data").load(location.href + " #data>*", "");
        }, 10000);
    </script>
@endsection
