<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>
        @yield('title')
    </title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!--Bootstrap link-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- CSS only -->
    <link href="{{asset('css/toolkit-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/application-startup.css')}}" rel="stylesheet">
    <link href="{{asset('css/index.css')}}" rel="stylesheet">
    <link href="{{asset('css/navbar.css')}}" rel="stylesheet">
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">

    <!-- link -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

    {{--    fontawesome link    --}}
    <script src="https://kit.fontawesome.com/282f852346.js"></script>

    <style>
        @media (max-width: 768px) and (-webkit-min-device-pixel-ratio: 2) {
            body {
                width: 1px;
                min-width: 100%;
                *width: 100%;
            }

            #stage {
                height: 1px;
                overflow: auto;
                min-height: 100vh;
                -webkit-overflow-scrolling: touch;
            }
        }
        @media screen and(min-width: 768px){
            #sidebar{
                display: none;
            }
        }

    </style>
    @yield('style')
</head>

<body>
<!--nav sidebar -->
<div class="stage-shelf stage-shelf-right hidden" id="sidebar">
    <ul class="navbar-nav nav-bordered nav-stacked flex-column">
        <li class="nav-header">Menu</li>
        <!-- Authentication Links -->
        @auth
            <li class="nav-item dropdown">

                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                   role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <img class="rounded-circle" width="32px" src="{{asset('img/avatar1.png')}}">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <ul class="navbar-nav ml-auto flex-column">
                        <li class="nav-link">
                            <a class="dropdown-item" href="#">Profile</a>
                        </li>
                        <li class="nav-link">
                            <a class="dropdown-item" href="#">Admin Panel</a>
                        </li>
                        <li class="nav-link">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}">Login/register</a>
            </li>
        @endauth
        <div class="dropdown-divider"></div>
        <li class="nav-item">
            <a class="nav-link" href="index.html">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">About Us</a>
        </li>
    </ul>
</div>
<!--nav sidebar ends-->

{{--main body with navbar--}}
<div class="stage" id="stage">
    @yield('content')
</div>

<!-- footer -->
<div class="block block-inverse app-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mb-5">
                <ul class="list-unstyled list-spaced">
                    <li class="mb-2">
                        <h6 class="text-uppercase">About</h6>
                    </li>
                    <li class="text-muted">
                        We’ve been working on Go Analytics for the better part of a decade and are super proud of
                        what
                        we’ve
                        created. If you’d like to learn more, or are interested in a job, address us anytime at <a
                            href="mailto: themes@getbootstrap.com">themes@getbootstrap.com</a>.
                    </li>
                </ul>
            </div>
            <div class="col-md-2 offset-md-1 mb-5">
                <ul class="list-unstyled list-spaced">
                    <li class="mb-2">
                        <h6 class="text-uppercase">Product</h6>
                    </li>
                    <li class="text-muted">Features</li>
                    <li class="text-muted">Examples</li>
                    <li class="text-muted">Tour</li>
                    <li class="text-muted">Gallery</li>
                </ul>
            </div>
            <div class="col-md-2 mb-5">
                <ul class="list-unstyled list-spaced">
                    <li class="mb-2">
                        <h6 class="text-uppercase">Apis</h6>
                    </li>
                    <li class="text-muted">Rich data</li>
                    <li class="text-muted">Simple data</li>
                    <li class="text-muted">Real time</li>
                    <li class="text-muted">Social</li>
                </ul>
            </div>
            <div class="col-md-2 mb-5">
                <ul class="list-unstyled list-spaced">
                    <li class="mb-2">
                        <h6 class="text-uppercase">Legal</h6>
                    </li>
                    <li class="text-muted">Terms</li>
                    <li class="text-muted">Legal</li>
                    <li class="text-muted">Privacy</li>
                    <li class="text-muted">License</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- footer end -->

{{--loading the needed scripts--}}
<script>

    const counters = document.querySelectorAll('.counter');
    const speed = 200;
    counters.forEach(counter => {
        const UpdateCount = () => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;

            const inc = target / speed;

            if (count < target) {
                counter.innerText = count + inc;
                setTimeout(UpdateCount, 1);
            } else {
                count.innerText = target;
            }
        }
        UpdateCount();
    });
    //refresh the tab when screen size change
    // window.onresize = function(event)
    // {
    //     document.location.reload(true);
    // }
</script>

{{--<script src="{{asset('js/tether.min.js')}}"></script>--}}
{{--<script src="{{asset('js/jquery.min.js')}}"></script>--}}
{{--<script src="{{asset('js/toolkit.js')}}"></script>--}}


</body>
</html>
