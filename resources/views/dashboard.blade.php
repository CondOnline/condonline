@extends('layouts.app')

@section('content_header_title', 'Dashboard')

@section('content_header_breadcrumb')

    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
    <li class="breadcrumb-item active">Dashboard</li>

@endsection


@section('content')

    <div class="row">
        <div class="col-md-3">
            <!-- small card -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h5><b>Residências</b></h5>

                    <h3>236</h3>
                </div>
                <div class="icon">
                    <i class="fas fa-home"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Listar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <!-- small card -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h5><b>Usuários</b></h5>

                    <h3>587</h3>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Listar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->

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
                <a href="#" class="small-box-footer">
                    Listar <i class="fas fa-arrow-circle-right"></i>
                </a>
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
                <a href="#" class="small-box-footer">
                    Listar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <br>

    <h4 class="mb-2">Correspondências</h4>
    <div class="row">
        <div class="col-md-3">
            <!-- small card -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>61</h3>

                    <h5><b>Pendentes</b></h5>
                </div>
                <div class="icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Listar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection
