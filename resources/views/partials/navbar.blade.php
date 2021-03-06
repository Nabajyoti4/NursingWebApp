{{-- navbar start --}}

{{--This will change all the navbar style except in the login and signup page.--}}
<nav class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{asset('img/AArogya-new-edit-1.png')}}"
                 style="width: 180px; height: 70px; background: #fff; padding: 10px; border-radius: 4px; color: #28669F; "
                 alt="">
        </a>
        <button class="navbar-toggler navbar-toggler-right hidden-md-up mt-2" type="button" data-target="#stage"
                data-toggle="stage" data-distance="-250">
            <div style="width: 25px;">
                <hr>
                <hr>
                <hr>
            </div>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <div class="navbar-nav ml-auto">
                <li class="nav-item px-1 ">
                    <a class="nav-link navbar-fonts" href="{{url('/')}}">Home</a>
                </li>
                <li class="nav-item px-1 ">
                    <a class="nav-link navbar-fonts" href="{{route('user.service.index')}}">Services</a>
                </li>
                <li class="nav-item px-1 ">
                    <a class="nav-link navbar-fonts" href="{{route('contact_us')}}">Contact Us</a>
                </li>
                <li class="nav-item px-1 ">
                    <a class="nav-link navbar-fonts" href="{{route('about_us')}}">About Us</a>
                </li>
                <li class="nav-item px-1 ">
                    <a class="nav-link navbar-fonts" href="{{route('pay_us')}}">Pay Us</a>
                </li>
                <li class="nav-link navbar-fonts">|</li>
                <!-- Authentication Links -->
                @auth
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle navbar-fonts" href="#"
                           role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <img class="rounded-circle" style="object-fit: cover;" width="40px" height="38px"
                                 src="{{Auth::user()->photo?asset("/storage/".Auth::user()->photo->photo_location):asset('img/avatar1.png')}}">
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
                    <li class="nav-item px-1 ">
                        <a class="nav-link  navbar-fonts" href="{{route('login')}}">Login/register</a>
                        {{--                            if logged in the profile link and --}}
                    </li>
                    @endauth
                    </ul>
            </div>
        </div>
</nav>
{{-- navbar ends --}}
