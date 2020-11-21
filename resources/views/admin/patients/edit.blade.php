@extends('layouts.admin')
@section('title')
    Update Patient
@endsection

@section('links')

    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <link href="{{asset('css/error.css')}}" rel="stylesheet">

@endsection

@section('style')
    <style>
        .borderdiv {
            position: relative;
            padding: 32px;
            border-radius: 10px;
            border: 2px solid #75b3e2;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
        .header {
            position: absolute;
            top: -14px;
            left: 1%;
            padding: 0% 2px;
            margin: 0%;
            background: white !important;
        }
    </style>
@endsection

@section('content')

    <div class="container emp-profile mt-3">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Patient Update Form</h3>
        </div>
        @include('partials.errors')
        <form action="{{ route('admin.patient.update', $patient->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Patient User Details</label>
                <div class="row">
                    <div class="col-lg-6 p-2">
                        <div class="form-group font-weight-bold">
                            <label for="user_name">User Full Name:</label>
                            <input required type="text" class="form-control" name="user_name" placeholder="Enter Name"
                                   value="{{$patient->user->name}}">
                        </div>
                    </div>

                    <div class="col-lg-6 p-2">
                        <div class="form-group font-weight-bold">
                            <label for="email">Booked User Email: ( Change With Caution )</label>
                            <input id="email" type="text" class="input form-control" name="email"
                                   value="{{$patient->user->email}}" required autocomplete="email" placeholder="Email">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 p-2">
                    <div class="form-group font-weight-bold">
                        <label for="phone_no">User Phone Number:</label>
                        <input type="number"  required name="phone_no" class="input form-control @error('phone_no') is-invalid @enderror" placeholder="Phone" value="{{$patient->user->phone_no}}">
                        @error('phone_no')
                        <div class="invalid-feedback mt-5" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Patient personal Details</label>
                <div class="row">
                    <div class="col-lg-6 p-2">
                        <div class="form-group font-weight-bold">
                            <label for="patient_name">Patient Full Name:</label>
                            <input required type="text" class="form-control" name="patient_name" placeholder="Enter Name"
                                   value="{{$patient->patient_name}}">
                        </div>
                    </div>

                    <div class="col-lg-6 p-2">
                        <div class="form-group font-weight-bold">
                            <label for="patient_phone_no">Phone Number:</label>
                            <input type="number"  required name="patient_phone_no" class="input form-control" placeholder="Phone" value="{{$patient->phone_no}}">
                        </div>
                    </div>
                    <div class="col-lg-6 p-2">
                        <div class="form-group font-weight-bold">
                            <label for="email">Booked User Email: ( Change With Caution )</label>
                            <input disabled id="email" type="text" class="input form-control" name="email"
                                   value="{{$patient->user->email}}" required autocomplete="email" placeholder="Email">
                        </div>
                    </div>

                    <div class="col-lg-6 p-2">
                        <div class="form-group font-weight-bold">
                            <label for="image">Upload Patient Pic: </label>
                            <input type="file" class="form-control" name="image">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-6 p-2">
                        <div class="form-group font-weight-bold">
                            <label for="age">Age:</label>
                            <input required type="number" class="form-control" name="age" placeholder="Age"
                                   value="{{$patient->age}}">
                        </div>
                    </div>
                    <div class="col-lg-6 p-2">
                        <div class="form-group font-weight-bold">
                            <label for="gender">Gender:</label>
                            <select required name="gender" class="form-control">
                                <option value="{{$patient->gender}}">{{$patient->gender}}</option>
                                <option value="Male" class="form-control">Male</option>
                                <option value="Female" class="form-control">Female</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Address</label>
                <div class="row">
                    <div class="col-lg-4 p-2">
                        <input required type="text" class="form-control" name="permanent_street"
                               placeholder="Street name" value="{{$patient->getFullAddress()->street}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input required type="text" class="form-control" name="permanent_landmark"
                               placeholder="Landmark" value="{{$patient->getFullAddress()->landmark}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <select class="form-control" name="permanent_city" >
                            <option value="{{$patient->getFullAddress()->city}}">{{$patient->getFullAddress()->city}}</option>
                            @foreach($cities as $city)
                                <option value="{{$city->city}}">{{$city->city}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 p-2">
                        <input required type="text" class="form-control" name="permanent_state"
                               placeholder="State" value="{{$patient->getFullAddress()->state}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input required type="text" class="form-control" name="permanent_country"
                               placeholder="Country" value="{{$patient->getFullAddress()->country}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input required type="text" class="form-control" name="permanent_police"
                               placeholder="Police station" value="{{$patient->getFullAddress()->police_station}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input required type="text" class="form-control" name="permanent_post"
                               placeholder="Post office" value="{{$patient->getFullAddress()->post_office}}">
                    </div>
                    <div class="col-lg-4 p-2">
                        <input required type="text" class="form-control" name="permanent_pincode"
                               placeholder="Postal/Zip Code" value="{{$patient->getFullAddress()->pin_code}}">
                    </div>
                </div>
            </div>

            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Family Details</label>
                <div class="row">
                    <div class="col-lg-4 p-2">
                        <div class="form-group font-weight-bold">
                            <label for="family_members">Total Family Member ( Both M/F):</label>
                            <input type="text" class="form-control" name="family_members"
                                   value="{{$patient->family_members}}">
                        </div>
                    </div>
                    <div class="col-lg-4 p-2">
                        <div class="form-group font-weight-bold">
                            <label for="relation_guardian">Relation with the Guardian :</label>
                            <input type="text" class="form-control" name="relation_guardian"
                                   value="{{$patient->relation_guardian}}">
                        </div>
                    </div>
                    <div class="col-lg-4 p-2">
                        <div class="form-group font-weight-bold">
                            <label for="guardian_name">Name of the Guardian:</label>
                            <input type="text" class="form-control" name="guardian_name"
                                   value="{{$patient->guardian_name}}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Service Details</label>
                <div class="row">
                    <div class="col-lg-4 p-2">
                        <div class="form-group font-weight-bold">
                            <label for="shift">Duty Shift of the Nurse:</label>
                            <select required name="shift" class="form-control">
                                <option value="{{$patient->shift}}">
                                    @if($patient->shift === "day")
                                        Day Shift
                                    @elseif($patient->shift === "night")
                                        Night Shift
                                    @elseif($patient->shift === "full")
                                        24 hours
                                    @endif
                                </option>
                                <option value="day">Day Shift</option>
                                <option value="night">Night Shift</option>
                                <option value="full">24 hours</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 p-2">
                        <div class="form-group font-weight-bold">
                            <label for="service_id">Service :</label>
                            <select required name="service_id" required class="form-control">
                                <option value="{{$patient->service_id}}">{{\App\Service::where('id', $patient->service_id)->get()->first()->title}}</option>
                                @foreach($services as $service)
                                    <option value="{{$service->id}}">{{ $service->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 p-2">
                        <div class="form-group font-weight-bold">
                            <label for="days">Period of Required (Days):</label>
                            <select required type="number" name="days" class="form-control">
                                <option value="30">30</option>
                            </select>
                        </div>
                    </div>


                </div>
            </div>


            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Patient Info</label>
                <div class="row">
                    <div class="col-lg-6 p-2">
                        <div class="form-group font-weight-bold">
                            <label for="patient_history">Patient's History :</label>
                            <textarea name="patient_history" cols="30" rows="5"
                                      class="form-control">{{$patient->patient_history}}</textarea>
                        </div>
                    </div>

                    <div class="col-lg-6 p-2">
                        <div class="form-group font-weight-bold">
                            <label for="patient_doctor">Doctor and Hospital:</label>
                            <textarea name="patient_doctor" cols="30" rows="5"
                                      class="form-control">{{$patient->patient_doctor}}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-primary w-50" type="submit">Update</button>
            </div>


        </form>
    </div>

@endsection
