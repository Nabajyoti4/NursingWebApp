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
    </div>

    <div class="container p-3">
        <form action="{{route('admin.book.extend')}}" method="POST">
            @csrf
            <input type="hidden" value="{{$booking->patient_id}}" name="patient_id">
            <input type="hidden" value="{{$booking->nurse_id}}" name="nurse">

            <!--deatils of user and patient-->
            <div class="row bg-light">
                <div class="col-xs-12 col-lg-4">
                    <img
                        src="{{ $booking->patient->user->photo?asset("/storage/".$booking->patient->user->photo->photo_location) :'http://placehold.it/64x64'}}"
                        width="70%" alt="avatar">
                    <div class="pt-5">
                        <label for="patient_name">Patient Name: </label>
                        <input name="patient_name" type="text" class="form-control" value="{{$booking->patient->patient_name}}">
                        <label for="patient_no"><i class="fas fa-mobile-alt"></i> Patient No.:</label>
                        <input name="patient_no" type="number" class="form-control" value="{{$booking->patient->phone_no}}">
                    </div>
                    <br>
                </div>
                <div class="col-xs-12 col-lg-6 ">
                    <div class="borderdiv">
                        <h5 class="header font-weight-bold bg-light">Address</h5>
                        <div>
                            <h5 class="font">Street</h5>
                            <span>: {{$booking->patient->user->addresses->first() ? $booking->patient->user->addresses->first()->street : "Fill the Permanent Address"}}</span>
                        </div>
                        <div>
                            <h5 class="font">Landmark</h5>
                            <span>: {{$booking->patient->user->addresses->first() ? $booking->patient->user->addresses->first()->landmark : "Fill the Permanent Address"}}</span>
                        </div>
                        <div>
                            <h5 class="font">City</h5>
                            <span>: {{$booking->patient->user->addresses->first() ? $booking->patient->user->addresses->first()->city : "Fill the Permanent Address"}}</span>
                        </div>
                        <div>
                            <h5 class="font">State</h5>
                            <span>: {{$booking->patient->user->addresses->first() ? $booking->patient->user->addresses->first()->state : "Fill the Permanent Address"}}</span>
                        </div>
                        <div>
                            <h5 class="font">Country</h5>
                            <span>: {{$booking->patient->user->addresses->first() ? $booking->patient->user->addresses->first()->country : "Fill the Permanent Address"}}</span>
                        </div>
                        <div>
                            <h5 class="font">Pin Code</h5>
                            <span>: {{$booking->patient->user->addresses->first() ? $booking->patient->user->addresses->first()->pin_code : "Fill the Permanent Address"}}</span>
                        </div>
                    </div>
                    <div class="borderdiv">
                        <h5 class="header font-weight-bold bg-light">Booked By User</h5>
                        <label for="user_name">User Name: </label>
                        <input name="user_name" type="text" class="form-control" value="{{$booking->patient->user->name}}">
                        <label for="user_no">User Number:</label>
                        <input name="user_no" type="number" class="form-control" value="{{$booking->patient->user->phone_no}}">
                        <label for="user_email">User Email</label>
                        <input type="email" class="form-control" value="{{$booking->patient->user->email}}">
                    </div>
                </div>
            </div>

            <!--details of same nurse-->
            <div  class="row">
                <div class="col-lg-12">
                    <div class="borderdiv">
                        <h5 class="header font-weight-bold bg-light">Nurse Details</h5>
                        <div>
                            <h5 class="font">Name</h5>
                            <span>:  {{$booking->nurse->user->name}} </span>
                        </div>
                        <div>
                            <h5 class="font">Employee ID</h5>
                            <span>:  {{$booking->nurse->employee_id}} </span>
                        </div>

                    </div>
                </div>
            </div>


            <!--details of payment-->
            <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="total_payment">Total Payment</label>
                    <input name="total_payment" class="form-control" type="number">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="due_payment">Due Payment</label>
                    <input name="due_payment" class="form-control" type="number">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="days">No of Days</label>
                    <input name="days" class="form-control" type="number">
                </div>
            </div>
            </div>

            <div class="row">
                <div class="col-12">
                        <button class="btn btn-primary" type="submit">Create a Booking</button>
                </div>
            </div>
        </form>
    </div>

@endsection
