@extends('layouts.admin')
@section('title')
     Attendance Report
@endsection

@section('content')
    <div class="card shadow mb-4" id="nurseTable">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Patient Requests</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Present</th>
                        <th>Absent</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($nurses as $nurse)
                        <tr>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">No Patient Request found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
@endsection
