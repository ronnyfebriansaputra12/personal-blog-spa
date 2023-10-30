<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-warning">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link" style="text-decoration: none; ">
        <img src="{{ asset('AdminLTE') }}/dist/img/logo-tab.png" width="150px" alt="AdminLTE Logo"
            class="brand-image img-circle">
        <span class="brand-text font-weight-black" style="font-size: 15px;">Blog</span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img class="img-circle elevation-2" src="{{ asset('adminlte/dist/img/av1.jpg') }}"
                    alt="User profile picture">
            </div>
            <div class="info">
                <a href="{{ url('/profile') }}" style="text-decoration: none" class="d-block">Admin</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item {{ Request::is('view-post', 'view-kategori', 'view-menu','view-group-menu') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Request::is('view-post', 'view-kategori', 'view-menu','view-group-menu') ? 'active' : '' }}"
                        style="">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- @if (Auth::user()->role == 'user') --}}
                        <li class="nav-item">
                            <a href="{{ url('view-post') }}"
                                class="nav-link {{ Request::is('view-post') ? 'active' : '' }}" style="">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Post</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('view-kategori') }}"
                                class="nav-link {{ Request::is('view-kategori') ? 'active' : '' }}" style="">
                                <i class="far fa-circle nav-icon"></i>
                                <p>kategori</p>
                            </a>
                        </li>
                        {{-- @endif --}}
                        <li class="nav-header" style="">MENU</li>
                        <li class="nav-item">
                            <a href="{{ url('view-menu') }}" class="nav-link {{ Request::is('view-menu') ? 'active' : '' }}"
                                style="">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Menu Master</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('view-group-menu') }}" class="nav-link {{ Request::is('view-group-menu') ? 'active' : '' }}"
                                style="">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Group Menu</p>
                            </a>
                        </li>




                    </ul>
                </li>

                <li class="nav-header" style="">SETTINGS</li>
                <li class="nav-item">
                    <a href="{{ url('/logout') }}" class="nav-link" style="">
                        <i class="fa-regular fas fa-right-from-bracket"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
