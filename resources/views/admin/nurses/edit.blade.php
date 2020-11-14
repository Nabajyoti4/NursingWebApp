@extends('layouts.admin')
@section('title')
    Edit User
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
            background: white!important;
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

    <div class="container emp-profile mt-3">
        @include('partials.errors')
        <form action="{{ route('admin.nurse.update', $nurse->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group font-weight-bold">
                <label for="name">Full Name:</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Name"
                       value="{{$nurse->user->name}}">
            </div>

            <div class="form-group font-weight-bold">
                <label for="phone_no">Phone Number:</label>
                <input type="number" class="form-control" name="phone_no" placeholder="Enter Phone number"
                       value="{{$nurse->user->phone_no}}">
            </div>

            <div class="form-group font-weight-bold">
                <label for="age">Age</label>
                <input type="number" class="form-control" name="age" value="{{$nurse->age}}" placeholder="Enter Age">
            </div>

            <div >
                <img src="{{ $nurse->user->photo?asset("/storage/".$nurse->user->photo->photo_location) :'http://placehold.it/64x64'}}" width="20%" height="30%" />
            </div>

            <div class="form-group font-weight-bold">
                <label for="image">Upload Profile Pic: </label>
                <input type="file" class="form-control" name="image">
            </div>

            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Working Or On Leave</label>
                <div class="form-group font-weight-bold">
                    <label for="active">Active</label>
                    <select  name="active">
                        <option value="{{$nurse->is_active == 1 ? 1 : 0}}">{{$nurse->is_active == 1 ? "active" : "On leave"}}</option>
                        <option value="1">active</option>
                        <option value="0">on leave</option>
                    </select>
                </div>
            </div>

            <div class="borderdiv">
                <label class="header font-weight-bold bg-light">Office Address<span class="required">*</span></label>
                <div class="row">
                    <div class="col-lg-4 p-2">
                        <select id="current_city" class="form-control @error('current_city') is-invalid @enderror" name="current_city" onchange="selectionchange();">
                            @if($current_add)
                                <option selected value="{{$current_add->city}}">{{$current_add->city}}</option>
                            @else
                                <option value="">Select City</option>
                            @endif
                            @foreach($cities as $city)
                                <option value="{{$city->city}}" >{{$city->city}}</option>
                            @endforeach
                        </select>
                        @error('current_city')
                        <div class="invalid-feedback mt-2 alert-danger" role="alert">
                            <strong class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input readonly id="current_street" type="text" class="form-control @error('current_street') is-invalid @enderror" name="current_street" placeholder="Street name"
                               value="{{ $current_add->street ?? ""}}">
                        @error('current_street')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror </div>
                    <div class="col-lg-4 p-2">
                        <input readonly id="current_landmark" type="text" class="form-control @error('current_landmark') is-invalid @enderror" name="current_landmark" placeholder="Landmark"
                               value="{{$current_add->landmark ?? ""}}">
                        @error('current_landmark')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input readonly id="current_state" type="text" class="form-control @error('current_state') is-invalid @enderror" name="current_state" placeholder="State"
                               value="{{$current_add->state ?? ""}}">
                        @error('current_state')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input readonly id="current_country" type="text" class="form-control @error('current_country') is-invalid @enderror" name="current_country" placeholder="Country"
                               value="{{$current_add->country ?? ""}}">
                        @error('current_country')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input readonly id="current_police" type="text" class="form-control @error('current_police') is-invalid @enderror" name="current_police"
                               placeholder="Police station"
                               value="{{$current_add->police_station ?? ""}}">
                        @error('current_police')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input readonly id="current_post" type="text" class=" form-control @error('current_post') is-invalid @enderror" name="current_post" placeholder="Post office"
                               value="{{$current_add->post_office ?? ""}}">
                        @error('current_post')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 p-2">
                        <input readonly id="current_pincode" type="text" class="form-control @error('current_pincode') is-invalid @enderror" name="current_pincode" placeholder="Pin Code"
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
                               placeholder="Street name"
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
                               name="permanent_city" placeholder="City"
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
                <label class="header font-weight-bold bg-light text-dark ">Identification And Qualification Details</label>
                <div class="form-group font-weight-bold">
                    <label for="identification">Pan card/Passport/Aadhar card/Driving License ( Identification ) </label>
                    <input type="file" class="form-control-file w-25" name="identification">
                </div>

                <div class="form-group font-weight-bold">
                    <label for="address">Aadhar card/Driving License/Voter ( Address Proof )</label>
                    <input type="file" class="form-control-file w-25" name="address">
                </div>

                <div class="form-group font-weight-bold">
                    <label for="education">Education Qualification</label>
                    <input required type="text" value="{{$nurse->qualification->education}}" class="form-control-file w-25" name="education" placeholder="eg : 10th pass">
                </div>

                <div class="form-group font-weight-bold">
                    <label for="other">Other Qualification</label>
                    <input required type="text" value="{{$nurse->qualification->other}}" class="form-control-file w-25" name="other">
                </div>
            </div>
            <br>
            <button class="btn btn-primary" type="submit">Update</button>

        </form>
    </div>
    <script>
        function selectionchange()
        {
            var e = document.getElementById("current_city");
            var str = e.options[e.selectedIndex].value;

            var jorhat={
                "landmark":"Mandakini Bibah Bhawan Complex",
                "street":"Katoky Pukhuri",
                "post":"RRL PULIBOR",
                "police":"PULIBOR",
                "pin":785006,
                "state":"Assam",
                "country":"India"};
            var sivasagar={
                "landmark":"GANAK PATTY",
                "street":"OLD AMALAPATTY",
                "post":"SIVASAGAR",
                "police":"SIVASAGAR",
                "pin":786001,
                "state":"ASSAM",
                "country":"India"};
            var dibrugarh={
                "landmark":"NEAR SANKAR DEV HOSPITAL",
                "street":"SASHAN PARA RAOD",
                "post":"DIBRUGARH",
                "police":"DIBRUGARH",
                "pin":786003,
                "state":"Assam",
                "country":"India"};
            if (str === "jorhat"){
                document.getElementById('current_street').value = jorhat['street'];
                document.getElementById('current_landmark').value = jorhat['landmark'];
                document.getElementById('current_post').value = jorhat['post'];
                document.getElementById('current_police').value = jorhat['police'];
                document.getElementById('current_state').value = jorhat['state'];
                document.getElementById('current_pincode').value = jorhat['pin'];
                document.getElementById('current_country').value = jorhat['country'];
            }else if(str === "dibrugarh"){
                document.getElementById('current_street').value = dibrugarh['street'];
                document.getElementById('current_landmark').value = dibrugarh['landmark'];
                document.getElementById('current_post').value = dibrugarh['post'];
                document.getElementById('current_police').value = dibrugarh['police'];
                document.getElementById('current_state').value = dibrugarh['state'];
                document.getElementById('current_pincode').value = dibrugarh['pin'];
                document.getElementById('current_country').value = dibrugarh['country'];
            }else{
                document.getElementById('current_street').value = sivasagar['street'];
                document.getElementById('current_landmark').value = sivasagar['landmark'];
                document.getElementById('current_post').value = sivasagar['post'];
                document.getElementById('current_police').value = sivasagar['police'];
                document.getElementById('current_state').value = sivasagar['state'];
                document.getElementById('current_pincode').value = sivasagar['pin'];
                document.getElementById('current_country').value = sivasagar['country'];

            }

        }
    </script>
@endsection
