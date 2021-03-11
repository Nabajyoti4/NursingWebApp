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
    <!-- DataTales Example -->
    <div class="card shadow mb-4" id="usersTable">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Employee Name : {{$nurse->user->name}}</h6>
        </div>
    </div> @if($tsalaries->first() != null)
        <div class="card-body">

            <h4>Temporary Salary transactions</h4>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Action</th>
                        <th>Receipt</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody id="data">
                    @forelse($tsalaries as $salary)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($salary->month_days)->englishMonth}}</td>
                            <td>{{ \Carbon\Carbon::parse($salary->month_days)->year}}</td>
                            <td><a class="btn btn-primary small" href="{{route('admin.salary.tedit',$salary->id)}}">Edit
                                </a></td>
                            <td><a href="{{route('admin.tsalary.invoice',$salary->id)}}" target="_blank">Receipt</a>
                                <hr>
                                <a href="{{route('admin.tsalary.invoice',$salary->id)}}" download>Download</a></td>
                            <td>
                                @if(Auth::user()->role=='super')
                                    <form action="{{route('admin.psalary.delete', $salary->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"  class="btn btn-danger">Delete</button>
                                    </form>
                                @else
                                    You are not Authorized for this Feature
                                @endif
                            </td>
                        </tr>
                    @empty

                        <tr>
                            <td colspan="4"> no data</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
    @endif
    <div class="card-body">
        <h4>Permanent Salary transactions</h4>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Action</th>
                    <th>Receipt</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody id="data">
                @forelse($psalaries as $salary)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($salary->month_days)->englishMonth}}</td>
                        <td>{{ \Carbon\Carbon::parse($salary->month_days)->year}}</td>
                        <td><a class="btn btn-primary small" href="{{route('admin.salary.pedit',$salary->id)}}">Edit
                            </a></td>
                        <td><a href="{{route('admin.psalary.invoice',$salary->id)}}" target="_blank">Receipt</a>
                            <hr>
                            <a href="{{route('admin.psalary.invoice',$salary->id)}}" download>Download</a>
                        </td>
                        <td>
                            <form action="{{route('admin.psalary.delete', $salary->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty

                    <tr>
                        <td colspan="4"> no data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

