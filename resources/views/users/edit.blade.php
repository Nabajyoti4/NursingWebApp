@extends('layouts.home')
@section('title')
    Edit User
@endsection

@section('content')

    <div class="container-fluid profile-bg p-3">
        <!-- navbar start -->
    @include('partials.navbar')
    <!-- navbar ends -->
        <div class="container emp-profile mt-3">
    <form class="">
        @csrf

        <div class="form-row">
            <div class="col-3 mb-3">
                <label for="name">FullName</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="col-3 mb-3">
                <label for="phone_no">Phone No</label>
                <input type="text" class="form-control" id="phone_no" name="phone_no" value="{{$user->phone_no}}"
                       required>
            </div>
        </div>
        <div class="form-row">
            <div class="col-3 mb-3">
                <label for="address1">Address 1</label>
                <textarea class="form-control" id="address1" name="address1" required rows="4"
                          placeholder="Eg:Room No
Street name, landmark
district
state, country"></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="col-3 mb-3">
                <label for="address2">Address 2</label>
                <textarea class="form-control" id="address2" name="address2" rows="4" placeholder="Eg:Room No
Street name, landmark
district
state, country"
                          required></textarea>
            </div>
        </div>
        <button class="btn profile-edit-btn" type="submit">Update</button>
    </form>
        </div>
    </div>
@endsection
