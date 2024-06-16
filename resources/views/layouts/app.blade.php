<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">
</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
 
    <ul class="navbar-nav bg-custom sidebar sidebar-dark accordion" id="accordionSidebar">


        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                
            </div>
            <div class="sidebar-brand-text mx-3">{{$config['system-name']}}<sup></sup></div>
        </a>

 
        <hr class="sidebar-divider my-0">

        <li class="nav-item {{ Nav::isRoute('home') }}">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>{{ __('home.Dashboard') }}</span></a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            {{ __('home.Modules') }}
        </div>
        <li class="nav-item {{ request()->is(['projects*','invoices*']) ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProjects" aria-expanded="true" aria-controls="collapseProjects">
                <i class="fas fa-fw fa-list"></i>
                <span>{{ __('home.Projects Panel') }}</span>
            </a>
            <div id="collapseProjects" class="collapse {{ request()->is('projects*') ? 'show' : '' }}" aria-labelledby="headingProjects" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ request()->is('projects') ? 'active' : '' }}" href="{{ route('projects.index') }}">{{ __('home.Projects') }}</a>
                </div>
            </div>
            <div id="collapseProjects" class="collapse {{ request()->is('invoices*') ? 'show' : '' }}" aria-labelledby="headingInvoices" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ request()->is('invoices') ? 'active' : '' }}" href="{{ route('invoices.index') }}">{{ __('home.Invoices') }}</a>
                </div>
            </div>
        </li>
        <li class="nav-item {{ request()->is('clients*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClients" aria-expanded="true" aria-controls="collapseClients">
                <i class="fas fa-fw fa-user"></i>
                <span>{{ __('home.Clients') }}</span>
            </a>
            <div id="collapseClients" class="collapse {{ request()->is('clients*') ? 'show' : '' }}" aria-labelledby="headingClients" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('clients.index') }}">{{ __('home.Manage Clients') }}</a>
                </div>
            </div>
        </li>
        

        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            {{ __('home.Settings') }}
        </div>

        <li class="nav-item {{ Nav::isRoute('profile') }}">
            <a class="nav-link" href="{{ route('profile') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>{{ __('home.Profile') }}</span>
            </a>
        </li>
       
        <hr class="sidebar-divider d-none d-md-block">

  
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
  
    <div id="content-wrapper" class="d-flex flex-column">


        <div id="content">


            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">


                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>


                <ul class="navbar-nav ml-auto">


                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">3+</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Alerts Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 12, 2019</div>
                                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-donate text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 7, 2019</div>
                                    $290.29 has been deposited into your account!
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 2, 2019</div>
                                    Spending Alert: We've noticed unusually high spending for your account.
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </li>

                    

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                            <figure class="img-profile rounded-circle avatar font-weight-bold" data-initial="{{ Auth::user()->name[0] }}"></figure>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('home.Profile') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('home.Logout') }}
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('main-content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; <a href="https://goalsoluciones.com/" target="_blank">Goal Soluciones</a> {{ now()->year }}</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('home.Ready to Leave?') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">{{ __('home.Select Logout below if you are ready to end your current session')}}</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('home.Cancel') }}</button>
                <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('home.Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{asset('vendor/popper.js/popper.min.js')}}"></script>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<script src="{{asset('js/Sortable.min.js')}}"></script>
<script src="{{asset('js/select2.min.js')}}"></script>
<script src="{{asset('js/datatables.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2();
        $('.dataTable').DataTable(
            {
                "language": {
                    "url": "{{ asset('js/datatablesEsp.json') }}"
                }
            }
        
        );
    });
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
@yield('scripts')

</body>
</html>
