{{-- navbar start --}}

{{--This will change all the navbar style except in the login and signup page.--}}
<nav class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{asset('img/AArogya-new-edit-1.png')}}"
                 style="width: 150px; height: 60px; background: #fff; padding: 2px; border-radius: 4px; color: #28669F;"
                 alt="">
        </a>
        <button class="navbar-toggler navbar-toggler-right hidden-md-up mt-2" type="button" data-target="#stage"
                data-toggle="stage" data-distance="-250">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <div class="navbar-nav ml-auto">
                <li class="nav-item px-1 ">
                    <a class="nav-link navbar-fonts" href="#">Home</a>
                </li>
                <li class="nav-item px-1 ">
                    <a class="nav-link navbar-fonts" href="#">Services</a>
                </li>
                <li class="nav-item px-1 ">
                    <a class="nav-link navbar-fonts" href="#">Contact Us</a>
                </li>
                <li class="nav-item px-1 ">
                    <a class="nav-link navbar-fonts" href="#">About Us</a>
                </li>
                <li class="nav-link navbar-fonts">|</li>
                <!-- Authentication Links -->
                @auth
                    <li class="nav-item dropdown no-arrow">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle navbar-fonts" href="#"
                           role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle" width="32px" src="{{asset('img/avatar1.png')}}">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Admin Panel
                            </a>
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
