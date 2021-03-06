@extends('layouts.admin')
@section('title')
    Booking Update
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
    <div class="container p-3">
        <form action="{{route('admin.book.booking-update', $booking->id)}}" method="POST">
            @csrf
            @method('patch')
            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Payment Details</label>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="total_payment">Total Payment</label>
                        <input required name="total_payment" class="form-control" type="number" value="{{$booking->total_payment}}">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="due_payment">Advance Payment</label>
                        <input required name="due_payment" class="form-control" type="number" value="{{$booking->due_payment}}" placeholder="0 if not paid">
                    </div>
                </div>
            </div>
            </div>
            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Date details</label>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="start_date">Start Date </label>
                        <input required type="date" class="form-control" name="start_date"
                               placeholder="Enter booking start date" value="{{$booking->start_date}}">
                    </div>
                    <div class="col-lg-6">
                        <label for="due_date">Due Date</label>
                        <input required type="date" class="form-control" name="due_date"
                               placeholder="Enter booking due date" value="{{$booking->due_date}}">
                    </div>
                </div>
            </div>
            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Booking Days</label>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="days">Days</label>
                        <select required type="number" name="days" class="form-control">
                            <option value="{{$booking->patient->days}}">{{$booking->patient->days}}</option>
                            <option value="30">30</option>
                            <option value="15">15</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group font-weight-bold">
                <label for="payment_mode">Payment Mode</label>
                <select name="payment_mode" class="form-control @error('payment_mode') is-invalid @enderror" required>
                    @if($booking->payment_mode == "")
                        <option class="form-control" value="" selected>Select Mode</option>
                    @else
                        <option class="form-control" value="{{$booking->payment_mode}}" selected>{{$booking->payment_mode}}</option>
                    @endif <hr>
                    <option class="form-control" value="ONLINE" >ONLINE</option>
                    <option class="form-control" value="CASH" >CASH</option>
                    <option class="form-control" value="CHEQUE" >CHEQUE</option>
                    <option class="form-control" value="CARD" >CARD</option>
                </select>
                @error('payment_mode')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="row">
                <div class="col-12">
                        <button class="btn btn-primary" type="submit">Update a Booking</button>
                </div>
            </div>
        </form>
    </div>

@endsection
