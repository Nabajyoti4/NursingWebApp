@extends('layouts.admin')
@section('title')
    Salary Nurses
@endsection

@section('content')
    <script>
        function exportTableToExcel(tableID, filename = '') {
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            filename = filename ? filename + '.xls' : 'excel_data.xls';
            // Create download link element
            downloadLink = document.createElement("a");
            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }
        }
    </script>
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
          action="{{route('admin.salary.index')}}" method="GET">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control border-2 small" name="search" placeholder="Search for..."
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
        <div class="card-header">
            <div class="row">
                <div class="col-12"><span class="m-0 font-weight-bold text-primary btn ">Nurses</span></div>

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @forelse($salariess as $salary)
                    <table class="table table-bordered" id="dataTableTemporary" width="100%" cellspacing="0">
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
                            @if(\App\Nurse::where('id',$salary->nurse_id)->get()->first()->permanent == 1)
                                <th>ESIC</th>
                                <th>PF</th>
                            @endif
                            <th>Advance Payment</th>
                            <th>Total</th>
                            <th>Deduction</th>
                            <th>Net Payment</th>
                        </tr>
                        </thead>
                        <tbody id="data">
                        <tr>
                            <td>{{\App\Nurse::where('id',$salary->nurse_id)->get()->first()->employee_id}}</td>
                            <td>{{$salary->basic}}</td>
                            <td>{{$salary->per_day_rate}}</td>
                            <td>{{$salary->full_day}}</td>
                            <td>{{$salary->half_day}}</td>
                            <td>{{$salary->special_allowance}}</td>
                            <td>{{$salary->ta_da}}</td>
                            <td>{{$salary->hra}}</td>
                            <td>{{$salary->bonus}}</td>
                            @if(\App\Nurse::where('id',$salary->nurse_id)->get()->first()->permanent == 1)
                                <td>{{$salary->esic}}</td>
                                <td>{{$salary->pf}}</td>
                            @endif
                            <td>{{$salary->advance}}</td>
                            <td>{{$salary->total}}</td>
                            <td>{{$salary->deduction}}</td>
                            <td>{{$salary->net}}</td>
                        </tr>
                        </tbody>
                    </table>
                @empty
                    <table class="table table-bordered" id="dataTableTemporary" width="100%" cellspacing="0">
                        <tbody id="data">
                        <tr>
                            <td>No search result</td>
                        </tr>
                        </tbody>
                    </table>
                @endforelse
            </div>
        </div>
    </div>



@endsection
