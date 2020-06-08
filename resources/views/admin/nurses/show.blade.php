@extends('layouts.admin')
@section('title')
    Nurse Profile
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
            width: 105px;
        }

        h4 {
            text-transform: initial;
        }

        span {
            text-transform: capitalize;
        }

        .borderdiv {
            position: relative;
            top: -20px;
            padding: 32px;

            border-radius: 10px;
            border: 2px solid #75b3e2;
            margin-top: 2rem;
        }

        .pdfobject-container {
            height: 35rem;
            border: 1rem solid rgba(0, 0, 0, .1);
        }
    </style>
@endsection

@section('content')
    <div class="container p-3">
        <div class="row p-5 bg-light">
            <div class="col-xs-12 col-lg-4">
                <img
                    src="{{ $nurse->user->photo?asset("/storage/".$nurse->user->photo->photo_location) :'http://placehold.it/64x64'}}"
                    width="100%" alt="avatar">
                <div class="pt-5">
                    <h3>{{$nurse->user->name}}</h3>
                    <hr>
                    <h4><i class="fas fa-mobile-alt"></i> {{$nurse->user->phone_no}}</h4>
                    <hr>
                    <h4><i class="fas fa-envelope"></i> {{$nurse->user->email}}</h4>

                </div>
                <br>
                <div class="borderdiv">
                    <h5 class="header font-weight-bold bg-light">Details</h5>
                    <div>
                        <h5 class="font">Age</h5>{{$nurse->age}}
                    </div>
                    <hr>
                    <div>
                        <h5 class="font">Pan Card</h5>
                        <a class="documentData" href="#pdfLoad" data-toggle="modal" data-target="#pdfLoad">pan card</a>
                    </div>
                    <hr>
                    <div>
                        <h5 class="font">Aadhar Card</h5>
                        <a class="documentData" href="#pdfLoad" data-toggle="modal" data-target="#pdfLoad">Aadhar
                            card</a>
                    </div>
                    <hr>
                    <div>
                        <h5 class="font">Voter Card</h5>
                        <a class="documentData" href="#pdfLoad" data-toggle="modal" data-target="#pdfLoad">Voter
                            card</a>
                    </div>
                    <hr>
                    <div>
                        <h5 class="font">License Card</h5>
                        <a class="documentData" href="#pdfLoad" data-toggle="modal" data-target="#pdfLoad">License
                            card</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-lg-6 ">
                <div class="bg-light">

                    <div class="borderdiv">
                        <h5 class="header font-weight-bold bg-light">Current Address</h5>
                        <div>
                            <h5 class="font">Street</h5>
                            <span>: {{$nurse->user->addresses->last() ? $nurse->user->addresses->last()->street : ""}}</span>
                        </div>
                        <div>
                            <h5 class="font">Landmark</h5>
                            <span>: {{$nurse->user->addresses->last() ? $nurse->user->addresses->last()->landmark : "Fill the current Address"}}</span>
                        </div>
                        <div>
                            <h5 class="font">City</h5>
                            <span>: {{$nurse->user->addresses->last() ? $nurse->user->addresses->last()->city : "Fill the current Address"}}</span>
                        </div>
                        <div>
                            <h5 class="font">State</h5>
                            <span>: {{$nurse->user->addresses->last() ? $nurse->user->addresses->last()->state : "Fill the current Address"}}</span>
                        </div>
                        <div>
                            <h5 class="font">Country</h5>
                            <span>: {{$nurse->user->addresses->last() ? $nurse->user->addresses->last()->country : "Fill the current Address"}}</span>
                        </div>
                        <div>
                            <h5 class="font">Pin Code</h5>
                            <span>: {{$nurse->user->addresses->last() ? $nurse->user->addresses->last()->pin_code : "Fill the current Address"}}</span>
                        </div>
                    </div>
                    <div class="borderdiv">
                        <h5 class="header font-weight-bold bg-light">Permanent Address</h5>
                        <div>
                            <h5 class="font">Street</h5>
                            <span>: {{$nurse->user->addresses->first() ? $nurse->user->addresses->first()->street : "Fill the Permanent Address"}}</span>
                        </div>
                        <div>
                            <h5 class="font">Landmark</h5>
                            <span>: {{$nurse->user->addresses->first() ? $nurse->user->addresses->first()->landmark : "Fill the Permanent Address"}}</span>
                        </div>
                        <div>
                            <h5 class="font">City</h5>
                            <span>: {{$nurse->user->addresses->first() ? $nurse->user->addresses->first()->city : "Fill the Permanent Address"}}</span>
                        </div>
                        <div>
                            <h5 class="font">State</h5>
                            <span>: {{$nurse->user->addresses->first() ? $nurse->user->addresses->first()->state : "Fill the Permanent Address"}}</span>
                        </div>
                        <div>
                            <h5 class="font">Country</h5>
                            <span>: {{$nurse->user->addresses->first() ? $nurse->user->addresses->first()->country : "Fill the Permanent Address"}}</span>
                        </div>
                        <div>
                            <h5 class="font">Pin Code</h5>
                            <span>: {{$nurse->user->addresses->first() ? $nurse->user->addresses->first()->pin_code : "Fill the Permanent Address"}}</span>
                        </div>
                    </div>
                    <div class="borderdiv">
                        <h5 class="header font-weight-bold bg-light">Qualification Details</h5>
                        <div>
                            <h5 class="font">Nursing</h5>
                            <a class="documentData" href="#pdfLoad" data-toggle="modal" data-target="#pdfLoad">pan card</a>
                        </div>
                        <hr>
                        <div>
                            <h5 class="font">Aadhar Card</h5>
                            <a class="documentData" href="#pdfLoad" data-toggle="modal" data-target="#pdfLoad">Aadhar
                                card</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- pdf Modal-->
    <div class="modal fade" id="pdfLoad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 80%!important; max-height: 800px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Document</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="pdfLoadData"></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/pdfObject.min.js')}}"></script>

    <script>
        const doc = document.getElementsByClassName('documentData');
        doc[0].addEventListener('click', function () {
            PDFObject.embed('{{asset('/storage/'.$nurse->qualification->pan_card)}}', "#pdfLoadData");
            console.log('working');
        });
        doc[1].addEventListener('click',function () {
        PDFObject.embed('{{asset('/storage/'.$nurse->qualification->adhar_card)}}', "#pdfLoadData");
        });
        doc[2].addEventListener('click', function () {
            PDFObject.embed('{{asset('/storage/'.$nurse->qualification->voter_card)}}', "#pdfLoadData");
        });
        doc[3].addEventListener('click',function () {
        PDFObject.embed('{{asset('/storage/'.$nurse->qualification->license_card)}}', "#pdfLoadData");
        });
        doc[4].addEventListener('click',function () {
            PDFObject.embed('{{asset('/storage/'.$nurse->qualification->qualification)}}', "#pdfLoadData");
        });
        doc[5].addEventListener('click',function () {
            PDFObject.embed('{{asset('/storage/'.$nurse->qualification->other_qualification)}}', "#pdfLoadData");
        });
    </script>
@endsection
