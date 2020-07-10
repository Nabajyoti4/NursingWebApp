<!-- navbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">




        <!-- Nav Item - User Information -->
        <!-- Authentication Links -->
        @auth
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                   data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                    <img class="img-profile rounded-circle"
                         src="{{Auth::user()->photo?asset("/storage/".Auth::user()->photo->photo_location):asset('img/avatar1.png')}}">
                </a>
                <!-- Dropdown - User Information -->
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
                    <a class="dropdown-item" href="{{route('admin.index')}}">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Admin Panel
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
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

</nav>
<!-- End of Topbar -->
