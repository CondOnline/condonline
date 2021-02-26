<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="description" content="CondOnline - Sistema para gerenciamento de condomínios">
    <meta name="author" content="Diogo F Medeiros">

    <title>{{ config('app.name') }}</title>

    <!-- Favicon -->
    @laravelPWA

    <!-- Meta Tags -->
    <meta name="robots" content="noindex" />
    <meta name="Googlebot" content="noindex" />

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminlte_3.1.0-rc/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('adminlte_3.1.0-rc/plugins/toastr/toastr.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte_3.1.0-rc/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte_3.1.0-rc/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte_3.1.0-rc/plugins/select2/css/select2.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte_3.1.0-rc/dist/css/adminlte.min.css') }}">
    <!-- summernote Textarea -->
    <link rel="stylesheet" href="{{ asset('adminlte_3.1.0-rc/plugins/summernote/summernote-bs4.min.css') }}">


    <style>
        @media(max-width: 767px) {
            ul.pagination {
                display: inline-flex;
                flex-wrap: wrap;
            }
        }
        .table th, .table td {
            vertical-align: middle !important;
        }
        .white-space{
            white-space: normal;
        }

        .custom-file-input ~ .custom-file-label::after {
            content: "Selecionar";
        }
    </style>

</head>
<body class="hold-transition sidebar-mini @if(auth()->user()->dark_mode) dark-mode @endif">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand text-sm @if(auth()->user()->dark_mode) navbar-dark @else navbar-white navbar-light @endif">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button" onclick="collapse_verify()"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                @if ($notifyCount)
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-primary navbar-badge">{{ $notifyCount }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">{{ $notifyCount }} {{ ($notifyCount>1)?'Notificações':'Notificação' }}</span>
                        <div class="dropdown-divider"></div>
                        @if ($notifyNewOrders)
                            <a href="{{ route('user.orders.index') }}" class="dropdown-item">
                                <i class="fas fa-box mr-2"></i> {{ $notifyNewOrders }} {{ ($notifyNewOrders>1)?'Novas Encomendas':'Nova Encomenda' }}
                            </a>
                            <div class="dropdown-divider"></div>
                        @endif
                        @if ($notifyDeliveredOrders)
                            <a href="{{ route('user.orders.index') }}" class="dropdown-item">
                                <i class="fas fa-box-open mr-2"></i> {{ $notifyDeliveredOrders }} {{ ($notifyDeliveredOrders>1)?'Encomendas Entregues':'Encomenda Entregue' }}
                            </a>
                            <div class="dropdown-divider"></div>
                        @endif
                        @if ($notifyDocuments)
                            <a href="{{ route('user.documents.index') }}" class="dropdown-item">
                                <i class="fas fa-box-open mr-2"></i> {{ $notifyDocuments }} {{ ($notifyDocuments>1)?'Novos Documentos':'Novo Documento' }}
                            </a>
                            <div class="dropdown-divider"></div>
                        @endif
                        @if($notifyCount)
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('user.clear.notifications') }}" class="dropdown-item dropdown-footer">Limpar Notificações</a>
                        @endif
                    </div>
                @endif
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
        <span class="brand-link">
            <a href="{{ route('index') }}" class="brand-link">
                <img src="{{ asset('assets/img/CondOnlineLogo.png') }}" alt="CondOnline Logo" class="brand-image img-circle elevation-3"
                     style="opacity: .8">
                <span class="brand-text font-weight-bolder h3">CondOnline</span>
            </a>
            <div class="font-weight-light white-space text-center text-white mt-2" id="condominium_name">
                <span>{{ config('app.condominium')  }}</span>
            </div>
        </span>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel pb-3 mt-3 mb-3 d-flex">
                <div class="image">
                    @if (Auth()->user()->photo)
                        <img src="{{ route('user.photo', [Auth()->user(), 'date' => Auth()->user()->updated_at->timestamp]) }}" class="img-circle elevation-2" alt="User Image">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{urlencode(Auth()->user()->name)}}&color=7F9CF5&background=EBF4FF" class="img-circle elevation-2" alt="User Image">
                    @endif
                </div>
                <div class="info align-self-center">
                    <a href="{{ route('user.show') }}" class="d-block">{{ Auth()->user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="true">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    @if (auth()->user()->dweller)
                        <li class="nav-item">
                            <a href="{{ route('user.orders.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>
                                    Encomendas
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-envelope-open-text"></i>
                                <p>
                                    Circulares
                                </p>
                            </a>
                        </li>
                    @endif
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Ocorrências
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.documents.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>
                                    Documentos
                                </p>
                            </a>
                        </li>

                    @canany(['admin.residences.index',
                             'admin.streets.index',
                             'admin.users.index',
                             'admin.userAccessGroups.index',
                             'admin.orders.index'])
                        <li class="nav-header"><a href="{{ route('admin.index') }}">Administração</a></li>
                    @endcan

                    @if(config('telescope.enabled') && auth()->user()->userAccessGroup->id == 1)
                        <li class="nav-item">
                            <a href="{{ route('telescope') }}" class="nav-link" target="_blank">
                                <i class="nav-icon fas fa-binoculars"></i>
                                <p>
                                    Telescope
                                </p>
                            </a>
                        </li>
                    @endif

                    @canany(['admin.residences.index', 'admin.streets.index'])
                        <li class="nav-item has-treeview @if(request()->is(['admin/residences*', 'admin/streets*'])) menu-open @endif">
                            <a href="#" class="nav-link @if(request()->is(['admin/residences*', 'admin/streets*'])) active @endif">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Residências
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('admin.streets.index')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.streets.index') }}" class="nav-link @if(request()->is(['admin/streets*'])) active @endif">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Ruas</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('admin.residences.index')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.residences.index') }}" class="nav-link @if(request()->is(['admin/residences*'])) active @endif">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Residências</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @canany(['admin.users.index', 'admin.groups.index', 'admin.userAccessGroups.index'])
                        <li class="nav-item has-treeview @if(request()->is(['admin/users*', 'admin/groups*', 'admin/userAccessGroups*'])) menu-open @endif">
                            <a href="#" class="nav-link @if(request()->is(['admin/users*', 'admin/groups*', 'admin/userAccessGroups*'])) active @endif">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Usuários
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('admin.userAccessGroups.index')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.userAccessGroups.index') }}" class="nav-link @if(request()->is(['admin/userAccessGroups*'])) active @endif">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Grupos de Acesso</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('admin.groups.index')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.groups.index') }}" class="nav-link @if(request()->is(['admin/groups*'])) active @endif">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Grupos de Usuários</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('admin.users.index')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.users.index') }}" class="nav-link @if(request()->is(['admin/users*'])) active @endif">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Usuários</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('admin.orders.index')
                        <li class="nav-item">
                            <a href="{{ route('admin.orders.index') }}" class="nav-link @if(request()->is(['admin/orders*'])) active @endif">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>
                                    Encomendas
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('admin.circulars.index')
                        <li class="nav-item">
                            <a href="{{ route('admin.circulars.index') }}" class="nav-link @if(request()->is(['admin/circulars*'])) active @endif">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>
                                    Circulares
                                </p>
                            </a>
                        </li>
                    @endcan
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

                @if(session()->get('first_login'))
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body bg-warning text-center p-2 rounded">
                                    <h6 class="mt-2"><b>Esse é seu primeiro login, Recomendamos a troca da sua senha!</b></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

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
    <footer class="main-footer text-sm">
        {{--<!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>--}}
        <!-- Default to the left -->
        <strong>Copyright &copy; 2020-{{date('Y')}} <a href="{{ config('app.url') }}">CondOnline</a>.</strong> Todos os direitos reservados.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('adminlte_3.1.0-rc/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte_3.1.0-rc/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('adminlte_3.1.0-rc/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('adminlte_3.1.0-rc/plugins/select2/js/i18n/pt-BR.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('adminlte_3.1.0-rc/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte_3.1.0-rc/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte_3.1.0-rc/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte_3.1.0-rc/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte_3.1.0-rc/dist/js/adminlte.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('adminlte_3.1.0-rc/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('adminlte_3.1.0-rc/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('adminlte_3.1.0-rc/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('adminlte_3.1.0-rc/plugins/toastr/toastr.min.js') }}"></script>
<!-- Summernote Textarea -->
<script src="{{ asset('adminlte_3.1.0-rc/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('adminlte_3.1.0-rc/plugins/summernote/lang/summernote-pt-BR.min.js') }}"></script>

<script>
    $.fn.select2.defaults.set('language', 'pt-BR');

    $(document).ready(function(){
        $("form").submit(function(event){
            $("button").attr('disabled', 'disabled');
            $("button").text("Aguarde...");
        });
    });

    $(".content-wrapper").bind('click mouseover', '#link', function() {
        if ($("body").hasClass("sidebar-collapse") && !$("aside").hasClass("sidebar-focused")) {
            $("#condominium_name").addClass('d-none');
        }
    });

    $(".main-sidebar").mouseenter(function(){
        if ($("body").hasClass("sidebar-collapse")) {
            $("#condominium_name").removeClass('d-none');
        }
    });

    function collapse_verify() {
        setTimeout(function() {
            if (!$("body").hasClass("sidebar-collapse")) {
                $("#condominium_name").removeClass('d-none');
            } else {
                $("#condominium_name").addClass('d-none');
            }
        }, 1);
    }
</script>

@include('_includes.toastr')

@yield('js')

</body>
</html>
