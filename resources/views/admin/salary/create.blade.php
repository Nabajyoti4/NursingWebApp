@extends('layouts.admin')
@section('title')
    Create Nurse Salary
@endsection

@section('links')

    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <link href="{{asset('css/error.css')}}" rel="stylesheet">

@endsection
@section('content')


    <div class="container emp-profile mt-3 mb-5">
        <form action="{{ route('admin.salary.store')}}" method="POST">
            @csrf
            <div class="form-group font-weight-bold">
                <label for="nurse_id">Nurse Employee ID</label>
                <select name="nurse_id" class="form-control @error('nurse_id') is-invalid @enderror"
                        onmousedown="this.value='';" onchange="getSalary(this.value);">
                    <option class="form-control" value="" selected>Select Nurse</option>
                    @foreach($nurses as $nurse)
                        <option class="form-control" value="{{$nurse->employee_id}}">{{$nurse->employee_id}}</option>
                    @endforeach

                </select>
                @error('nurse_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="basic">Basic Salary</label>
                <input id="basic" type="number" name="basic" class="form-control @error('basic') is-invalid @enderror"/>
                @error('basic')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="month_days">Month-Year</label>
                <input type="month" name="month_days" class="form-control @error('month_days') is-invalid @enderror"/>
                @error('month_days')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="shift">Shift</label>
                <select name="shift" class="form-control @error('shift') is-invalid @enderror" required>
                    <option class="form-control" value="" selected>Select Shift</option>
                    <option class="form-control" value="24 hrs">24 hrs</option>
                    <option class="form-control" value="Day">Day</option>
                    <option class="form-control" value="Night">Night</option>
                </select>
                @error('shift')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="full_day">Total Days of Duty 24hrs</label>
                <input type="number" name="full_day" class="form-control @error('full_day') is-invalid @enderror"/>
                @error('full_day')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="half_day">Total Days of Duty 12hrs</label>
                <input type="number" name="half_day" class="form-control @error('half_day') is-invalid @enderror"/>
                @error('half_day')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group font-weight-bold">
                <label for="special_allowance">Special Allowance</label>
                <input type="number" name="special_allowance"
                       class="form-control @error('special_allowance') is-invalid @enderror"/>
                @error('special_allowance')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group font-weight-bold">
                <label for="ta_da">TA & DA</label>
                <input type="number" name="ta_da" class="form-control @error('ta_da') is-invalid @enderror"/>
                @error('ta_da')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group font-weight-bold">
                <label for="hra">HRA</label>
                <input type="number" name="hra" class="form-control @error('hra') is-invalid @enderror"/>
                @error('hra')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group font-weight-bold">
                <label for="advance">Advance Payment</label>
                <input type="number" name="advance" class="form-control @error('advance') is-invalid @enderror"/>
                @error('advance')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            @if($permanent == 1)
                <div class="form-group font-weight-bold">
                    <label for="pf">PF</label>
                    <input type="number" name="pf" class="form-control @error('pf') is-invalid @enderror"/>
                    @error('pf')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            @endif
            <div class="form-group font-weight-bold">
                <label for="area">Area</label>
                <select name="area" class="form-control @error('area') is-invalid @enderror">
                    <option class="form-control" value="" selected>SELECT DISTRICT</option>
                    <option class="form-control" value="DIBRUGARH, ASSAM">DIBRUGARH, ASSAM</option>
                    <option class="form-control" value="SIVASAGAR, ASSAM">SIVASAGAR, ASSAM</option>
                    <option class="form-control" value="JORHAT, ASSAM">JORHAT, ASSAM</option>
                </select>
                @error('area')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group font-weight-bold">
                <label for="payment_mode">Payment Mode</label>
                <select name="payment_mode" class="form-control @error('payment_mode') is-invalid @enderror" required>
                    <option class="form-control" value="" selected>Select</option>
                    <option class="form-control" value="BANK NEFT">BANK NEFT</option>
                    <option class="form-control" value="RTGS">RTGS</option>
                    <option class="form-control" value="CASH">CASH</option>
                    <option class="form-control" value="CHEQUE">CHEQUE</option>
                    <option class="form-control" value="ACCOUNT PAY">ACCOUNT PAY</option>
                </select>
                @error('payment_mode')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Create</button>

        </form>
    </div>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>

           function getSalary(id){
               axios.get(`http://127.0.0.1:8000/api/getSalary/${id}`)
                   .then(result => {
                       document.getElementById('basic').value = result.data.basic;
                       // console.log(result.data.basic);
                   })
                   .catch(err => {
                       console.log(err);
                   })
           }
    </script>
@endsection
