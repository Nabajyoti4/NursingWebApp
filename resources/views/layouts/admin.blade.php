<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        @yield('title')
    </title>

@yield('links')
<!-- Custom styles for this template-->
    {{--    <link rel="stylesheet" href="{{asset('css/app.css')}}">--}}
    <link href="{{asset('css/adminPanel.min.css')}}" rel="stylesheet">
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <link rel="stylesheet" href="{{asset('css/dataTables.min.css')}}">

    @yield('style')

</head>
<style>
    tr:hover {
        background: #ffffff;
        transition: all .1s;
        color: #5d5656;
    }

</style>
<body>

<!-- Page Wrapper -->
<span id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.index')}}">
            <div class="sidebar-brand-icon">
                <!-- <i class="fas fa-laugh-wink"></i> -->
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Admin Panel</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-home"></i>
            <span>Go To Home</span>
        </a>
        </li>
         <hr class="sidebar-divider">
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{route('admin.index')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
         @if(Auth::user()->role == 'super')
            <div class="sidebar-heading">
            Addons
        </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
               aria-expanded="true"
               aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Pages</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">HomePage Sections:</h6>
                    <a class="collapse-item" href="{{route('admin.services.index')}}">Services</a>
                    <div class="collapse-divider"></div>
                    <a class="collapse-item" href="{{route('admin.teams.index')}}">Team</a>
                    <div class="collapse-divider"></div>
                    <a class="collapse-item" href="{{route('admin.price.index')}}">Packs</a>
                    <div class="collapse-divider"></div>
                    <a class="collapse-item" href="{{route('admin.rating.index')}}">Rating</a>
                      <div class="collapse-divider"></div>
                    <a class="collapse-item" href="{{route('admin.role.index')}}">Role</a>
                      <div class="collapse-divider"></div>
                    <a class="collapse-item" href="{{route('admin.city.index')}}">City</a>
                    <div class="collapse-divider"></div>
                </div>
            </div>
        </li>
        @endif
                <hr class="sidebar-divider">

        @if(Auth::user()->role == 'super')
            <li class="nav-item ">
            <a class="nav-link" href="">
                <i class="fas fa-id-card"></i>
                <span>Super Admins</span></a>
        </li>
        @endif
        @if(Auth::user()->role == 'super')
            <li class="nav-item">
            <a class="nav-link" href="{{route('admin.admins.index')}}">
                <i class="fas fa-id-card-alt"></i>
                <span>Admins</span></a>
        </li>
        @endif

       <li class="nav-item">
            <a class="nav-link" href="{{route('admin.query.index')}}">
                <i class="fas fa-id-card-alt"></i>
                <span>Query</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.nurse.index')}}">
                <i class="fas fa-user-md"></i>
                <span>Nurses</span></a>
        </li>
         <li class="nav-item">
            <a class="nav-link" href="{{route('admin.patient.approved')}}">
                <i class="fas fa-procedures fa-4x"></i>
                <span>Patients</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.users.index')}}">
                <i class="fas fa-users"></i>
                <span>Users</span></a>
        </li>
         <li class="nav-item">
            <a class="nav-link" href="{{route('admin.book.index')}}">
                <i class="fas fa-book-medical"></i>
                <span>Bookings</span></a>
        </li>



        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRequest"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-user"></i>
                <span>Requests</span>
            </a>
            <div id="collapseRequest" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Requests:</h6>
                    <a class="collapse-item" href="{{ route('nursejoin.index') }}"><i class="fas fa-user-nurse"></i> Nurse Requests</a>
                    <a class="collapse-item" href="{{route('admin.patient.index')}}"><i class="fas fa-bed"></i> Patient Requests</a>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
  <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSalary"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-user"></i>
                <span>Salary</span>
            </a>
            <div id="collapseSalary" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Salary:</h6>
                     <a class="collapse-item" href="{{route('admin.salary.index')}}">Monthly Salary </a>
                    <a class="collapse-item" href="{{ route('admin.salary.temporary') }}">Temporary Nurse </a>
                    <a class="collapse-item" href="{{route('admin.salary.permanent')}}">Permanent Nurse</a>
                </div>
            </div>



        </li>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
         @include('partials.admin_navbar')
        <!-- End of navbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('content')


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2019</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

</span>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">Logout</a>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/admin/adminPanel.js')}}"></script>
{{--<!-- Page level plugins -->--}}
{{--<script src="{{asset('js/admin/jquery.dataTables.min.js')}}"></script>--}}
{{--<script src="{{asset('js/admin/dataTables.bootstrap4.min.js')}}"></script>--}}

{{--<!-- Page level custom scripts -->--}}
{{--<script src="{{asset('js/admin/datatables-demo.js')}}"></script>--}}

{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>--}}
@yield('script')
</body>
</html>


