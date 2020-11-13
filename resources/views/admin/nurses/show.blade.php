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
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Nurse Details</h6>
    </div>
    <div class="container p-3">

        <div class="row bg-light" >
            <div class="col-xs-12 col-lg-4">
                <img
                    src="{{ $nurse->user->photo?asset("/storage/".$nurse->user->photo->photo_location) :'http://placehold.it/64x64'}}"
                    width="100%" alt="avatar">
                <div class="pt-5">
                    <h4><strong>{{$nurse->employee_id}}</strong></h4>
                    <h3>{{$nurse->user->name}}</h3>
                    <hr>
                    <h4><i class="fas fa-mobile-alt"></i> {{$nurse->user->phone_no}}</h4>
                    <hr>
                    <h4><i class="fas fa-envelope"></i>{{$nurse->user->email}}</h4>

                </div>
                <br>
                <div class="borderdiv">
                    <h5 class="header font-weight-bold bg-light">Details</h5>
                    <div>
                        <h5 class="font">Age</h5>{{$nurse->age}}
                    </div>
                    <hr>
                    <div>
                        <h5 class="font">Voter/Pan Card</h5>
                        <a class="documentData" href="#pdfLoad" data-toggle="modal" data-target="#pdfLoad">Voter/Pan Card</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-lg-6 ">
                <div class="bg-light">

                    <div class="borderdiv">
                        <h5 class="header font-weight-bold bg-light">Current Address</h5>
                        <div>
                            <h5 class="font">Street</h5>
                            <span>: {{$nurse->user->address($nurse->user->getCAddressId($nurse->user->id))->city?? ""}}</span>
                        </div>
                        <div>
                            <h5 class="font">Landmark</h5>
                            <span>: {{$nurse->user->address($nurse->user->getCAddressId($nurse->user->id))->landmark?? ""}}</span>
                        </div>
                        <div>
                            <h5 class="font">City</h5>
                            <span>: {{$nurse->user->address($nurse->user->getCAddressId($nurse->user->id))->city?? ""}}</span>
                        </div>
                        <div>
                            <h5 class="font">State</h5>
                            <span>: {{$nurse->user->address($nurse->user->getCAddressId($nurse->user->id))->state?? ""}}</span>
                        </div>
                        <div>
                            <h5 class="font">Country</h5>
                            <span>: {{$nurse->user->address($nurse->user->getCAddressId($nurse->user->id))->country?? ""}}</span>
                        </div>
                        <div>
                            <h5 class="font">Pin Code</h5>
                            <span>: {{$nurse->user->address($nurse->user->getCAddressId($nurse->user->id))->pin_code?? ""}}</span>
                        </div>
                    </div>
                    <div class="borderdiv">
                        <h5 class="header font-weight-bold bg-light">Permanent Address</h5>
                        <div>
                            <h5 class="font">Street</h5>
                            <span>: {{$nurse->user->address($nurse->user->getPAddressId($nurse->user->id))->city?? ""}}</span>
                        </div>
                        <div>
                            <h5 class="font">Landmark</h5>
                            <span>: {{$nurse->user->address($nurse->user->getPAddressId($nurse->user->id))->landmark?? ""}}</span>
                        </div>
                        <div>
                            <h5 class="font">City</h5>
                            <span>: {{$nurse->user->address($nurse->user->getPAddressId($nurse->user->id))->city?? ""}}</span>
                        </div>
                        <div>
                            <h5 class="font">State</h5>
                            <span>: {{$nurse->user->address($nurse->user->getPAddressId($nurse->user->id))->state?? ""}}</span>
                        </div>
                        <div>
                            <h5 class="font">Country</h5>
                            <span>: {{$nurse->user->address($nurse->user->getPAddressId($nurse->user->id))->country?? ""}}</span>
                        </div>
                        <div>
                            <h5 class="font">Pin Code</h5>
                            <span>: {{$nurse->user->address($nurse->user->getPAddressId($nurse->user->id))->pin_code?? ""}}</span>
                        </div>
                    </div>
                    <div class="borderdiv">
                        <h5 class="header font-weight-bold bg-light">Address Proof</h5>
                        <div>
                            <h5 class="font">Adhar / License</h5>
                            <a class="documentData" href="#pdfLoad" data-toggle="modal" data-target="#pdfLoad">Adhar / License</a>
                        </div>
                        <hr>
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
            PDFObject.embed('{{asset('/storage/'.$nurse->qualification->identification)}}', "#pdfLoadData");
            console.log('working');
        });
        doc[1].addEventListener('click',function () {
        PDFObject.embed('{{asset('/storage/'.$nurse->qualification->address)}}', "#pdfLoadData");
        });
    </script>
@endsection
