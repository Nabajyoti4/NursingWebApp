@extends('layouts.app')
@section('title')
    Login
@endsection
@section('content')
    <img class="wave" src="img/wave.png">
    <div class="container_login">
        <div class="img">
            <img src="img/bg.png">
        </div>
        <div class="login-content">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <img src="img/avatar1.png">
                <h2 class="title">Welcome</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input type="text" class="input" @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" class="input" @error('password') is-invalid @enderror" name="password"
                        required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                @endif
                <button type="submit" class="login_register_btn">
                    {{ __('Login') }}
                </button>
{{--                <input type="submit" class="btn" value="Login">--}}
            </form>
        </div>
    </div>

@endsection
