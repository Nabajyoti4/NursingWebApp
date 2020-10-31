@extends('layouts.admin')
@section('title')
    Salary Nurses
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
                    @forelse($tsalaries as $salary)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($salary->created_at)->englishMonth}}</td>
                            <td>{{ \Carbon\Carbon::parse($salary->created_at)->year}}</td>
                            <td><a class="btn btn-primary small" href="{{route('admin.salary.tedit',$salary->id)}}">Edit
                                </a></td>
                            <td><a href="{{route('admin.tsalary.invoice',$salary->id)}}" target="_blank">Receipt</a></td>
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
