@extends('layouts.home')
@section('title')
    Edit User
@endsection
@section('links')
    <!-- Theme CSS -->
    <link href="{{asset('css/navbar.css')}}" rel="stylesheet">
    <link href="{{asset('css/toolkit-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/application-startup.css')}}" rel="stylesheet">
    <!--  custom form style link -->
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <link href="{{asset('css/error.css')}}" rel="stylesheet">

    <!--  fontawesome link -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
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
        .required {
            color: red;
        }
    </style>
@endsection
@section('content')

    <div class="container-fluid profile-bg">
        <!-- navbar start -->
    @include('partials.navbar')
    <!-- navbar ends -->
        <div class="p-4">
            <div class="container emp-profile mt-3">
                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group font-weight-bold">
                        <label for="name">Full Name:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Name"
                               value="{{$user->name}}">
                        @error('name')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group font-weight-bold">
                        <label for="phone_no">Phone Number:</label>
                        <input type="number" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" placeholder="Enter Phone number"
                               value="{{$user->phone_no}}">
                        @error('phone_no')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>


                    <div class="form-group font-weight-bold">
                        <label for="image">Upload Profile Pic: </label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror"  name="image">
                        @error('image')
                        <div class="invalid-feedback mt-2" role="alert">
                            <strong class="alert-danger">{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div style="background-color:#22778a;border-radius:10px;"><h4 style="color:white; padding:10px;">
                            Please insert the Current Address Correctly As this address will be used in Booking
                            purposes</h4></div>
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
                                <input type="text" class="form-control @error('permanent_street') is-invalid @enderror" name="permanent_street"
                                       placeholder="Street name"
                                       value="{{$permanent_add->street ?? ""}}">
                                @error('permanent_street')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger" class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control @error('permanent_landmark') is-invalid @enderror" name="permanent_landmark" placeholder="Landmark"
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
                                <input type="text" class="form-control @error('permanent_state') is-invalid @enderror" name="permanent_state" placeholder="State"
                                       value="{{$permanent_add->state ?? ""}}">
                                @error('permanent_state')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control @error('permanent_country') is-invalid @enderror" name="permanent_country" placeholder="Country"
                                       value="{{$permanent_add->country ?? ""}}">
                                @error('permanent_country')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control @error('permanent_police') is-invalid @enderror" id="permanent_police" name="permanent_police"
                                       placeholder="Police station"
                                       value="{{$permanent_add->police_station ?? ""}}">
                                @error('permanent_police')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control @error('permanent_post') is-invalid @enderror" name="permanent_post" placeholder="Post office"
                                       value="{{$permanent_add->post_office ?? ""}}">
                                @error('permanent_post')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 p-2">
                                <input type="text" class="form-control  @error('permanent_pincode') is-invalid @enderror" name="permanent_pincode" placeholder="Pin Code"
                                       value="{{$permanent_add->pin_code ?? ""}}">
                                @error('permanent_pincode')
                                <div class="invalid-feedback mt-2" role="alert">
                                    <strong class="alert-danger">{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="text-center">
                    <button class="btn profile-edit-btn w-25" type="submit">Update</button>
                    </div>

                </form>
            </div>
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
