@extends('layouts.admin')
@section('title')
    Create Nurse
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
            background: white !important;
        }

        .borderdiv {
            position: relative;
            padding: 32px;
            border-radius: 10px;
            border: 2px solid #75b3e2;
            margin-top: 2rem;
        }
    </style>
@endsection

@section('content')

    <div class="container emp-profile mt-3 mb-5">
        @include('partials.errors')
        <form action="{{ route('admin.nurse.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{$user->id}}" name="user_id">

            <div class="form-group font-weight-bold">
                <label for="name">Full Name:</label>
                <input type="text" disabled class="form-control" name="name" value="{{$user->name}}"
                       placeholder="Enter Name">
            </div>

            <div class="form-group font-weight-bold">
                <label for="phone_no">Phone Number:</label>
                <input type="number" disabled class="form-control" name="phone_no" value="{{$user->phone_no}}"
                       placeholder="Enter Phone number">
            </div>

            <div class="form-group font-weight-bold">
                <label for="age">Age</label>
                <input required type="number" class="form-control" name="age" placeholder="Enter Age">
            </div>

            <div>
                <img src="{{ $user->photo?asset("/storage/".$user->photo->photo_location) :'No Photo'}}" width="20%"
                     height="30%"/>
            </div>


            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Current Address<span class="required">*</span></label>
                <div class="row">
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('current_street') is-invalid @enderror"
                               name="current_street" placeholder="Town/Village"
                               value="{{ $current_add->street ?? ""}}">
                        @error('current_street')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('current_landmark') is-invalid @enderror"
                               name="current_landmark" placeholder="Landmark"
                               value="{{$current_add->landmark ?? ""}}">
                        @error('current_landmark')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <select class="form-control @error('current_city') is-invalid @enderror" name="current_city">
                            @if($current_add)
                                <option selected value="{{$current_add->city}}">{{$current_add->city}}</option>
                            @else
                                <option value="">Select District</option>
                            @endif
                            @foreach($cities as $city)
                                <option value="{{$city->city}}" style="text-transform: uppercase">{{$city->city}}</option>
                            @endforeach
                        </select>
                        @error('current_city')
                        <div class="invalid-feedback mt-2 alert-danger" role="alert">
                            <strong class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('current_state') is-invalid @enderror"
                               name="current_state" placeholder="State"
                               value="{{$current_add->state ?? ""}}">
                        @error('current_state')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('current_country') is-invalid @enderror"
                               name="current_country" placeholder="Country"
                               value="{{$current_add->country ?? ""}}">
                        @error('current_country')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('current_police') is-invalid @enderror"
                               name="current_police"
                               placeholder="Police station"
                               value="{{$current_add->police_station ?? ""}}">
                        @error('current_police')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('current_post') is-invalid @enderror"
                               name="current_post" placeholder="Post office"
                               value="{{$current_add->post_office ?? ""}}">
                        @error('current_post')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('current_pincode') is-invalid @enderror"
                               name="current_pincode" placeholder="Pin Code"
                               value="{{$current_add->pin_code ?? ""}}">
                        @error('current_pincode')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Permanent Address<span class="required">*</span></label>
                <div class="row">
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('permanent_street') is-invalid @enderror"
                               name="permanent_street"
                               placeholder="Town/Village"
                               value="{{$permanent_add->street ?? ""}}">
                        @error('permanent_street')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('permanent_landmark') is-invalid @enderror"
                               name="permanent_landmark" placeholder="Landmark"
                               value="{{$permanent_add->landmark ?? ""}}">
                        @error('permanent_landmark')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('permanent_city') is-invalid @enderror"
                               name="permanent_city" placeholder="District"
                               value="{{$permanent_add->city ?? ""}}">
                        @error('permanent_city')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('permanent_state') is-invalid @enderror"
                               name="permanent_state" placeholder="State"
                               value="{{$permanent_add->state ?? ""}}">
                        @error('permanent_state')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('permanent_country') is-invalid @enderror"
                               name="permanent_country" placeholder="Country"
                               value="{{$permanent_add->country ?? ""}}">
                        @error('permanent_country')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('permanent_police') is-invalid @enderror"
                               name="permanent_police"
                               placeholder="Police station"
                               value="{{$permanent_add->police_station ?? ""}}">
                        @error('permanent_police')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control @error('permanent_post') is-invalid @enderror"
                               name="permanent_post" placeholder="Post office"
                               value="{{$permanent_add->post_office ?? ""}}">
                        @error('permanent_post')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input type="text" class="form-control  @error('permanent_pincode') is-invalid @enderror"
                               name="permanent_pincode" placeholder="Pin Code"
                               value="{{$permanent_add->pin_code ?? ""}}">
                        @error('permanent_pincode')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="borderdiv">
                <label class="header font-weight-bold bg-light text-dark">Identification And Qualification
                    Details</label>


                <div class="form-group font-weight-bold">
                    <label for="identification">Pan card/Passport/Aadhar card/Driving License ( Identification
                        ) </label>
                    <input required type="file" class="form-control-file w-25" name="identification">
                </div>

                <div class="form-group font-weight-bold">
                    <label for="address">Aadhar card/Driving License/Voter ( Address Proof )</label>
                    <input required type="file" class="form-control-file w-25" name="address">
                </div>

                <div class="form-group font-weight-bold">
                    <label for="education">Education Qualification</label>
                    <input required type="text" class="form-control-file w-25" name="education"
                           placeholder="eg : 10th pass">
                </div>

                <div class="form-group font-weight-bold">
                    <label for="other">Other Qualification</label>
                    <input required type="text" class="form-control-file w-25" name="other">
                </div>

            </div>

            <br>
            <button class="btn btn-primary" type="submit">Create</button>

        </form>
    </div>



@endsection
