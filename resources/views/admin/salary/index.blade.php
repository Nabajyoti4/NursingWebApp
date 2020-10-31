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
    <!-- Search -->
    <form class="d-sm-inline-block form-inline mr-auto my-2 my-md-0 mw-100 navbar-search"
          action="{{route('admin.salary.index')}}" method="GET">
        @csrf
        <div class="input-group">
            <input type="month" class="form-control border-2 small" name="searchMonth" placeholder="Search Month..."
                   aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                   Filter
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
    <ul class="nav nav-tabs pt-2" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#permanentNurse" role="tab"
               aria-controls="home" aria-selected="true">Permanent Nurse</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#temporaryNurse" role="tab"
               aria-controls="profile" aria-selected="false">Temporary Nurse</a>
        </li>
    </ul>
    <div class="col-md-12 p-0 pt-2">
        <div class="tab-content profile-tab" id="myTabContent">
            <!--Permanent Nurse Tsalary-->
            <div class="tab-pane fade show active" id="permanentNurse" role="tabpanel" aria-labelledby="home-tab">

                <!-- DataTales Example -->
                <div class="card shadow mb-4" id="usersTable">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-6 "><span class="m-0 font-weight-bold text-primary btn">Nurses</span></div>
                            <div class="col-6 d-flex justify-content-end">
                                <button class="btn btn-primary"
                                        onclick="exportTableToExcel('dataTablePermanent', 'Permanent Nurses Tsalary')">
                                    Export Table
                                    Data To Excel File
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTablePermanent" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Basic Salary</th>
                                    <th>Per Day Rate</th>
                                    <th>Total Days of Duty 24hrs</th>
                                    <th>Total Days of Duty 12hrs</th>
                                    <th>Special Allowance</th>
                                    <th>HRA</th>
                                    <th>TA & DA</th>
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
                                @forelse($psalaries as $salary)
                                    <tr>
                                        <td>{{\App\Nurse::where('id',$salary->nurse_id)->get()->first()->employee_id}}</td>
                                        <td>{{$salary->basic}}</td>
                                        <td>{{$salary->per_day_rate}}</td>
                                        <td>{{$salary->full_day}}</td>
                                        <td>{{$salary->half_day}}</td>
                                        <td>{{$salary->special_allowance}}</td>
                                        <td>{{$salary->hra}}</td>
                                        <td>{{$salary->ta_da}}</td>
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
                                        <td colspan="15">No Salary found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!--Temporary Nurse Tsalary-->
            <div class="tab-pane fade" id="temporaryNurse" role="tabpanel" aria-labelledby="profile-tab">

                <!-- DataTales Example -->
                <div class="card shadow mb-4" id="usersTable">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-6"><span class="m-0 font-weight-bold text-primary btn ">Nurses</span></div>
                            <div class="col-6 d-flex justify-content-end">
                                <button class="btn btn-primary"
                                        onclick="exportTableToExcel('dataTableTemporary', 'Temporary Nurses Tsalary')">
                                    Export Table
                                    Data To Excel File
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
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
                                    <th>Advance Payment</th>
                                    <th>Total</th>
                                    <th>Deduction</th>
                                    <th>Net Payment</th>
                                </tr>
                                </thead>
                                <tbody id="data">
                                @forelse($tsalaries as $salary)
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
                                        <td>{{$salary->advance}}</td>
                                        <td>{{$salary->total}}</td>
                                        <td>{{$salary->deduction}}</td>
                                        <td>{{$salary->net}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="13">No Salary found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
