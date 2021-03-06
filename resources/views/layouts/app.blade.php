<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/logo-circle.png') }}" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Aplikasi HRD') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('themes/dist/css/adminlte.min.css') }}">

    @yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{ asset('assets/logo.png') }}" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">{{ $current_count_informasis }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        @foreach ($current_informasis as $item)
                            <a href="{{ asset('file/' . $item->document) }}" class="dropdown-item text-uppercase text-primary" target="_blank">
                                <i class="fas fa-envelope mr-2"></i> {{ $item->title }}
                            </a>
                            <div class="dropdown-divider"></div>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" role="button">
                        <i class="fas fa-user-circle"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a
                            class="dropdown-item main-btn-edit"
                            href="{{ route('profile.index') }}">
                                <i class="fa fa-id-card px-2"></i> Profil
                        </a>
                        <div class="dropdown-divider"></div>
                        <a
                            class="dropdown-item main-btn-edit"
                            href="{{ route('change_password.index') }}">
                                <i class="fa fa-lock-open px-2"></i> Ubah Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a
                            class="dropdown-item main-btn-delete"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out-alt px-2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('assets/logo-circle.png') }}" alt="mc logo" class="brand-image img-circle" style="opacity: .8">
                <span class="brand-text font-weight-light">Aplikasi HRD</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if (Auth::user()->karyawan)
                            <img src="{{ asset('image/' . Auth::user()->karyawan->foto) }}" class="img-circle elevation-2" alt="User Image">
                        @else
                            <img src="{{ asset('assets/user.jpg') }}" class="img-circle elevation-2" alt="User Image">
                        @endif
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        @if (Auth::user()->karyawan_id == null)
                            <li class="nav-item">
                                <a href="{{ route('dashboard.index') }}" class="nav-link {{ request()->is(['dashboard', 'dashboard/*']) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tachometer-alt text-center mr-2" style="width: 30px"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('master/*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->is('master/*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-database text-center mr-2" style="width: 30px;"></i><p>Master<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('nav_main.index') }}" class="nav-link {{ request()->is('master/nav_main') ? 'active' : '' }}">
                                            <i class="fas fa-angle-right nav-icon"></i><p>Nav Main</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('nav_sub.index') }}" class="nav-link {{ request()->is('master/nav_sub') ? 'active' : '' }}">
                                            <i class="fas fa-angle-right nav-icon"></i><p>Nav Sub</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('master/user') ? 'active' : '' }}">
                                            <i class="fas fa-angle-right nav-icon"></i><p>User</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('cuti_approver.index') }}" class="nav-link {{ request()->is('master/cuti_approver') ? 'active' : '' }}">
                                            <i class="fas fa-angle-right nav-icon"></i><p>Cuti Approver</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('resign_approver.index') }}" class="nav-link {{ request()->is('master/resign_approver') ? 'active' : '' }}">
                                            <i class="fas fa-angle-right nav-icon"></i><p>Resign Approver</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cabang.index') }}" class="nav-link {{ request()->is(['cabang', 'cabang/*']) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-sitemap text-center mr-2" style="width: 30px"></i>
                                    <p>Cabang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('divisi.index') }}" class="nav-link {{ request()->is(['divisi', 'divisi/*']) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-friends text-center mr-2" style="width: 30px"></i>
                                    <p>Divisi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('jabatan.index') }}" class="nav-link {{ request()->is(['jabatan', 'jabatan/*']) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-id-card text-center mr-2" style="width: 30px"></i>
                                    <p>Jabatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('role.index') }}" class="nav-link {{ request()->is(['role', 'role/*']) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-address-book text-center mr-2" style="width: 30px"></i>
                                    <p>Role</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('karyawan.index') }}" class="nav-link {{ request()->is(['karyawan', 'karyawan/*']) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-tie text-center mr-2" style="width: 30px"></i>
                                    <p>Karyawan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cuti.index') }}" class="nav-link {{ request()->is(['cuti', 'cuti/*']) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-mug-hot text-center mr-2" style="width: 30px"></i>
                                    <p>Data Cuti</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cuti_approval.index') }}" class="nav-link {{ request()->is(['cuti_approval', 'cuti_approval/*']) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-check text-center mr-2" style="width: 30px"></i>
                                    <p>Approval Cuti</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('resign.index') }}" class="nav-link {{ request()->is(['resign', 'resign/*']) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-handshake text-center mr-2" style="width: 30px"></i>
                                    <p>Data Resign</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('resign_approval.index') }}" class="nav-link {{ request()->is(['resign_approval', 'resign_approval/*']) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-check text-center mr-2" style="width: 30px"></i>
                                    <p>Approval Resign</p>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('pengajuan/*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->is('pengajuan/*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book text-center mr-2" style="width: 30px;"></i><p>Pengajuan<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('pengajuan_cuti.index') }}" class="nav-link {{ request()->is('pengajuan/cuti') ? 'active' : '' }}">
                                            <i class="fas fa-angle-right nav-icon"></i><p>Cuti</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('pengajuan_resign.index') }}" class="nav-link {{ request()->is('pengajuan/resign') ? 'active' : '' }}">
                                            <i class="fas fa-angle-right nav-icon"></i><p>Resign</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('informasi.index') }}" class="nav-link {{ request()->is(['informasi', 'informasi/*']) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-info-circle text-center mr-2" style="width: 30px"></i>
                                    <p>Informasi</p>
                                </a>
                            </li>
                        @else
                            @foreach ($current_nav_mains as $item)
                                @if ($item->link == '#')
                                    <li class="nav-item {{ request()->is(''.$item->set_active.'/*') ? 'menu-open' : '' }}">
                                        <a href="#" class="nav-link {{ request()->is(''.$item->set_active.'/*') ? 'active' : '' }}">
                                            <i class="nav-icon {{ $item->icon }} text-center mr-2" style="width: 30px;"></i> <p>{{ $item->title }}<i class="right fas fa-angle-left"></i></p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            @foreach ($current_menus as $item_menu)
                                                @if ($item_menu->main_id == $item->id)
                                                    <li class="nav-item">
                                                        <a href="{{ route($item_menu->navSub->link) }}" class="nav-link {{ request()->is([''.$item_menu->navSub->set_active.'', ''.$item_menu->navSub->set_active.'/*']) ? 'active' : '' }}">
                                                            <i class="fas fa-angle-right nav-icon"></i> <p>{{ $item_menu->navSub->title }}</p>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a href="{{ route($item->link) }}" class="nav-link {{ request()->is([''.$item->set_active.'', ''.$item->set_active.'/*']) ? 'active' : '' }}">
                                            <i class="nav-icon {{ $item->icon }} text-center mr-2" style="width: 30px;"></i> <p>{{ $item->title }}</p>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </nav>
            </div>
        </aside>

        @yield('content')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
          <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0
            </div>
        </footer>
      </div>
      <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('themes/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('themes/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('themes/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('themes/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('themes/dist/js/adminlte.js') }}"></script>

    @yield('script')

</body>
</html>
