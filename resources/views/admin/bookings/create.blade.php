@extends('layouts.admin')
@section('title')
    Patient Profile
@endsection

@section('links')
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <link href="{{asset('css/error.css')}}" rel="stylesheet">
@endsection

@section('style')
    <style>
        .header {
            position: absolute;
            top: -14px;
            left: 1%;
            padding: 0% 2px;
            margin: 0%;
            background: rgb(242, 247, 250) !important;
        }

        .font {
            display: inline-block;
            width: 8rem;
        }

        h4 {
            text-transform: initial;
        }

        span {
            font-size: 1.2rem;
            text-transform: capitalize;
        }

        .borderdiv {
            position: relative;
            top: -20px;
            padding: 1rem;

            border-radius: .2rem;
            border: .2rem solid #75b3e2;
            margin-top: 2rem;
        }
    </style>
@endsection

@section('content')
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Patient Details</h6>
        <span><b>Status:</b>
            @if($patient->status == 1)
                Approved
            @elseif($patient->status == 0)
                Disapproved
            @else
                Pending
            @endif</span>
    </div>

    <div class="container p-3">
        <form action="{{route('admin.book.store')}}" method="POST">
            @csrf
            <input type="hidden" value="{{$patient->id}}" name="patient_id">
            <div class="row bg-light">
                <div class="col-xs-12 col-lg-4">
                    <img
                        src="{{ $patient->photo?asset("/storage/".$patient->photo->photo_location) :'http://placehold.it/64x64'}}"
                        width="70%" alt="avatar">
                    <div class="pt-5">
                        <label for="patient_name">Patient Name: </label>
                        <input name="patient_name" type="text" class="form-control" value="{{$patient->patient_name}}">
                        <label for="patient_no"><i class="fas fa-mobile-alt"></i> Patient No.:</label>
                        <input name="patient_no" type="number" class="form-control" value="{{$patient->phone_no}}">
                    </div>
                    <br>
                </div>
                <div class="col-xs-12 col-lg-6 ">
                    <div class="borderdiv">
                        <h5 class="header font-weight-bold bg-light">Address</h5>
                        <div>
                            <h5 class="font">Street</h5>
                            <span>: {{$patient->user->addresses->first() ? $patient->user->addresses->first()->street : "Fill the Permanent Address"}}</span>
                        </div>
                        <div>
                            <h5 class="font">Landmark</h5>
                            <span>: {{$patient->user->addresses->first() ? $patient->user->addresses->first()->landmark : "Fill the Permanent Address"}}</span>
                        </div>
                        <div>
                            <h5 class="font">City</h5>
                            <span>: {{$patient->user->addresses->first() ? $patient->user->addresses->first()->city : "Fill the Permanent Address"}}</span>
                        </div>
                        <div>
                            <h5 class="font">State</h5>
                            <span>: {{$patient->user->addresses->first() ? $patient->user->addresses->first()->state : "Fill the Permanent Address"}}</span>
                        </div>
                        <div>
                            <h5 class="font">Country</h5>
                            <span>: {{$patient->user->addresses->first() ? $patient->user->addresses->first()->country : "Fill the Permanent Address"}}</span>
                        </div>
                        <div>
                            <h5 class="font">Pin Code</h5>
                            <span>: {{$patient->user->addresses->first() ? $patient->user->addresses->first()->pin_code : "Fill the Permanent Address"}}</span>
                        </div>
                    </div>
                    <div class="borderdiv">
                        <h5 class="header font-weight-bold bg-light">Booked By User</h5>
                        <label for="user_name">User Name: </label>
                        <input name="user_name" type="text" class="form-control" value="{{$patient->user->name}}">
                        <label for="user_no">User Number:</label>
                        <input name="user_no" type="number" class="form-control" value="{{$patient->user->phone_no}}">
                        <label for="user_email">User Email</label>
                        <input type="email" class="form-control" value="{{$patient->user->email}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Available Nurses</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Profile Image</th>
                                        <th>Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @forelse($nurses as $nurse)
                                        <tr>
                                            <td>{{$nurse->employee_id}}</td>
                                            <td><img
                                                    src="{{ $nurse->user->photo?asset("/storage/".$nurse->user->photo->photo_location) :'http://placehold.it/64x64'}}"
                                                    alt="" width="100" height="100"/>
                                            </td>
                                            <td>{{$nurse->user->name}}</td>
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
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="total_payment">Total Payment</label>
                        <input required name="total_payment" class="form-control" type="number">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="due_payment">Advance Payment</label>
                        <input required name="due_payment" class="form-control" type="number" placeholder="0 if not paid">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="nurse">Select Nurse</label>
                        <select required name="nurse"  class="form-control">
                            <option value="">Select</option>
                            @forelse($nurses as $nurse)
                                <option value="{{$nurse->id}}">{{$nurse->employee_id}}</option>
                            @empty
                                No users found
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>
            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Date details</label>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="start_date">Start Date </label>
                        <input required type="date" class="form-control" name="start_date"
                               placeholder="Enter booking start date" value="{{old('start_date')}}">
                    </div>
                    <div class="col-lg-6">
                        <label for="due_date">Due Date</label>
                        <input required type="date" class="form-control" name="due_date"
                               placeholder="Enter booking due date" value="{{old('due_date')}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if($patient->status ==1)
                        <button class="btn btn-primary" type="submit">Create a Booking</button>
                    @endif
                </div>
            </div>
        </form>
    </div>

@endsection
