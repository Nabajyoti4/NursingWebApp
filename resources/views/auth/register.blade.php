@extends('layouts.app')
@section('title')
    Register
@endsection
@section('content')
    <img class="wave" src="{{asset('img/wave.png')}}">
    <div class="container_login">
        <div class="img">
            <img src="{{asset('img/bg.png')}}">
        </div>
        <div class="login-content">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                @error('name')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                @error('email')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                @error('password')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                <img src="{{asset('img/avatar1.png')}}">
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Full Name</h5>
                        <input id="name" type="text" class="input @error('name') is-invalid @enderror" name="name"
                               value="{{ old('name') }}" required autocomplete="name">
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-phone-square-alt"></i>
                    </div>
                    <div class="div">
                        <h5>Phone</h5>
                        <input type="text" name="phone_no" class="input">
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input id="email" type="text" class="input @error('email') is-invalid @enderror" name="email"
                               value="{{ old('email') }}" required autocomplete="email">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input id="password" type="password" class="input @error('password') is-invalid @enderror"
                               name="password"
                               required autocomplete="new-password">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Confirm Password</h5>
                        <input id="password-confirm" type="password" class="input" name="password_confirmation" required
                               autocomplete="new-password">
                    </div>
                </div>
                <a href="{{route('login')}}">Already have an account?Click here</a>
                <input type="submit" class="login_register_btn" value="Register">
                {{--                <button type="submit" class="btn btn-primary">--}}
                {{--                    {{ __('Register') }}--}}
                {{--                </button>--}}
            </form>
        </div>
    </div>
@endsection
