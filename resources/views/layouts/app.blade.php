<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>CondOnline - Sistema para condomínios</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    {{--<link rel="manifest" href="{{ asset('assets/img/favicon/manifest.json') }}">--}}
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <meta name="theme-color" content="#ffffff">
    <meta name="application-name" content="CondOnline - Sistema para condomínios">

    <!-- Open Graph -->
    <meta property="og:title" content="CondOnline" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Sistema para condomínios." />
    <meta property="og:image" content="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}" />
    <meta property="og:url" content="{{ config('app.url') }}" />

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:url" content="{{ config('app.url') }}" />
    <meta name="twitter:title" content="CondOnline" />
    <meta property="twitter:description" content="Sistema para condomínios." />
    <meta name="twitter:image" content="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}" />

    <!-- Meta Tags -->
    <meta name="robots" content="noindex" />
    <meta name="Googlebot" content="noindex" />

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
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
                    <span class="badge badge-primary navbar-badge">8</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">4 Notificações</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 1 Circular
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-box mr-2"></i> 3 Encomendas
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">Ver todas as notificações</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" title="Sair" onclick="event.preventDefault(); document.querySelector('form.logout').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <form action="{{ route('logout') }}" class="logout" method="post" style="display: none;">
                        @csrf
                    </form>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('index') }}" class="brand-link">
            <img src="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth()->user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview @if(request()->is(['admin/users*', 'admin/userGroups*'])) menu-open @endif">
                        <a href="#" class="nav-link @if(request()->is(['admin/users*', 'admin/userGroups*'])) active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Usuários
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.userGroups.index') }}" class="nav-link @if(request()->is(['admin/userGroups*'])) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Grupo de Usuários</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}" class="nav-link @if(request()->is(['admin/users*'])) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Usuários</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{--<li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Usuários
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Adicionar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Meus dados
                            </p>
                        </a>
                    </li>--}}
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @yield('content_header_title')
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('content_header_breadcrumb')
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <hr>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        {{--<!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>--}}
        <!-- Default to the left -->
        <strong>Copyright &copy; 2020-2020 <a href="{{ config('app.url') }}">CondOnline</a>.</strong> Todos os direitos reservados.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

@yield('js')

</body>
</html>
