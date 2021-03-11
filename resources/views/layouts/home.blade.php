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

    @yield('links')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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

        @media screen and(min-width: 768px) {
            #sidebar {
                display: none;
            }
        }

    </style>
    @yield('style')
</head>

<body>
<!--nav sidebar -->
<div class="stage-shelf stage-shelf-right hidden" id="sidebar_custom">
    <ul class="navbar-nav nav-bordered nav-stacked flex-column">
        <!-- Authentication Links -->
        @auth
            <li class="nav-item dropdown">

                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                   role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <img class="rounded-circle" width="32px" src="{{asset('img/avatar1.png')}}">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                     aria-labelledby="userDropdown">
                    @if(Auth::user()->role==="nurse")
                        <a class="dropdown-item" href="{{ route('nurse.index') }}">
                            <i class="fas fa-user-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                    @else
                        <a class="dropdown-item" href="{{ route('users.index') }}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>

                    @endif
                    @if(Auth::user()->role === 'admin' or Auth::user()->role === 'super')
                        <a class="dropdown-item" href="{{route('admin.index')}}">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Admin Panel
                        </a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </a>

                </div>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}">Login/register</a>
            </li>
        @endauth

        <div class="dropdown-divider"></div>
        <li class="nav-header">Menu</li>

        <li class="nav-item">
            <a class="nav-link" href="{{url('/')}}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('user.service.index')}}">Services</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('contact_us')}}">Contact Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('about_us')}}">About Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('pay_us')}}">Pay Us</a>
        </li>
    </ul>
</div>
<!--nav sidebar ends-->

{{--main body with navbar--}}
<div class="stage" id="stage">
    @yield('content')
</div>

<!-- footer -->
<div class="block block-inverse app-footer" style="display: flex;align-self: end">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mb-5">
                <ul class="list-unstyled list-spaced">
                    <li class="mb-2">
                        <h6 class="text-uppercase">About</h6>
                    </li>

                    <li class="text-muted">
                        About AarogyaHomeCare.
                        We provide high quality Nursing Support and Aide 24x7 on demand.
                        <a href="{{route('about_us')}}">Read more...</a>
                    <li class="text-muted">Registered Office Address: GIYAMOY FOUNDATION <br>
                    C/O Ranjan Deori, 1 No. Choudaung Gaon, Cinamora, Jorhat,Assam, India, 785008</li>
                    </li>
                    <li class="text-muted">© aarogyahomecare.com 2020</li>
                </ul>
            </div>
            <div class="col-md-2 offset-md-1 mb-5">
                <ul class="list-unstyled list-spaced">
                    <li class="mb-2">
                        <h6 class="text-uppercase">Quick links</h6>
                    </li>
                    <li class="text-muted"><a href="/">Home</a></li>
                    <li class="text-muted"><a href="{{route('about_us')}}">Our Services</a></li>
                    <li class="text-muted"><a href="{{route('contact_us')}}">Contact Us</a></li>
                </ul>
            </div>
            {{--            <div class="col-md-2 mb-5">--}}
            {{--                <ul class="list-unstyled list-spaced">--}}
            {{--                    <li class="mb-2">--}}
            {{--                        <h6 class="text-uppercase">Apis</h6>--}}
            {{--                    </li>--}}
            {{--                    <li class="text-muted">Rich data</li>--}}
            {{--                    <li class="text-muted">Simple data</li>--}}
            {{--                    <li class="text-muted">Real time</li>--}}
            {{--                    <li class="text-muted">Social</li>--}}
            {{--                </ul>--}}
            {{--            </div>--}}
            {{--            <div class="col-md-2 mb-5">--}}
            {{--                <ul class="list-unstyled list-spaced">--}}
            {{--                    <li class="mb-2">--}}
            {{--                        <h6 class="text-uppercase">Legal</h6>--}}
            {{--                    </li>--}}
            {{--                    <li class="text-muted">Terms</li>--}}
            {{--                    <li class="text-muted">Legal</li>--}}
            {{--                    <li class="text-muted">Privacy</li>--}}
            {{--                    <li class="text-muted">License</li>--}}
            {{--                </ul>--}}
            {{--            </div>--}}
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
{{--required js --}}
<script src="{{asset('js/tether.min.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/toolkit.js')}}"></script>

@yield('scripts')

<script>
    AOS.init({
        delay: 40,
        duration: 900,
    });
</script>
</body>
</html>
