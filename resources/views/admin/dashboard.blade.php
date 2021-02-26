@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0"><b>Dashboard</b></h1>
@endsection

@section('content_header_breadcrumb')

    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
    <li class="breadcrumb-item active">Dashboard</li>

@endsection


@section('content')

    @canany(['admin.residences.index', 'admin.users.index'])
        <div class="row">
            @can('admin.residences.index')
                <div class="col-md-3">
                    <!-- small card -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h5><b>Residências</b></h5>

                            <h3>{{ $residences }}</h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <a href="{{ route('admin.residences.index') }}" class="small-box-footer">
                            Listar <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            @endcan
            @can('admin.users.index')
                <div class="col-md-3">
                    <!-- small card -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h5><b>Usuários</b></h5>

                            <h3>{{ $users }}</h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                            Listar <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            @endcan
        </div>
        <!-- /.row -->
    @endcan
{{--
    <br>

    <h4 class="mb-2">Ocorrências</h4>
    <div class="row">
        <div class="col-md-3">
            <!-- small card -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>

                    <h5><b>Abertas</b></h5>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                @can('...')
                    <a href="#" class="small-box-footer">
                        Listar <i class="fas fa-arrow-circle-right"></i>
                    </a>
                @endcan
            </div>
        </div>
        <div class="col-md-3">
            <!-- small card -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>38</h3>

                    <h5><b>Em andamento</b></h5>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                @can('...')
                    <a href="#" class="small-box-footer">
                        Listar <i class="fas fa-arrow-circle-right"></i>
                    </a>
                @endcan
            </div>
        </div>
    </div>
    <!-- /.row -->--}}
    @can('admin.orders.index')
        <br>

        <h4 class="mb-2">Encomendas</h4>
        <div class="row">
            <div class="col-md-3">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $orders }}</h3>

                        <h5><b>Pendentes</b></h5>
                    </div>
                    <div class="icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="small-box-footer">
                        Listar <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    @endcan
    <!-- /.row -->

@endsection
