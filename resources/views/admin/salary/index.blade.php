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
    <form class="d-sm-inline-block form-inline mr-auto my-2 my-md-0 mw-100 navbar-search"
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
    <a href="{{route('admin.salary.create',$permanent=1)}}" class="btn btn-primary">Create Salary for the Permanent
        Nurse</a>
    <a href="{{route('admin.salary.create',$permanent=0)}}" class="btn btn-primary">Create Salary for the Temporary
        Nurse</a>
    <hr>
    <!-- DataTales Example -->
    <div class="card shadow mb-4" id="usersTable">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Nurses</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Basic Salary</th>
                        <th>Per Day Rate</th>
                        <th>Total Days of Duty 24hrs</th>
                        <th>Total Days of Duty 12hrs</th>
                        <th>Special Allowance</th>
                        <th>TA & DA</th>
                        <th>HRA</th>
                        <th>Bonus</th>
                        <th>Advance Payment</th>
                        <th>ESIC</th>
                        <th>PF</th>
                        <th>Total</th>
                        <th>Deduction</th>
                        <th>Net Payment</th>
                    </tr>
                    </thead>
                    <tbody id="data">
                    @forelse($salaries as $salary)
                        <tr>
                            <td>{{\App\Nurse::findOrFail($salary->nurse_id)->get()->first()->employee_id}}</td>
                            <td>{{$salary->basic}}</td>
                            <td>{{$salary->per_day_rate}}</td>
                            <td>{{$salary->full_day}}</td>
                            <td>{{$salary->half_day}}</td>
                            <td>{{$salary->special_allowance}}</td>
                            <td>{{$salary->ta_da}}</td>
                            <td>{{$salary->hra}}</td>
                            <td>{{$salary->bonus}}</td>
                            <td>{{$salary->advance}}</td>
                            <td>{{$salary->esic}}</td>
                            <td>{{$salary->pf}}</td>
                            <td>{{$salary->total}}</td>
                            <td>{{$salary->deduction}}</td>
                            <td>{{$salary->net}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No users found</td>
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
