@extends('layouts.app')

@section('content')
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
            <div class="small-box bg-warning">
                <div class="inner text-white">
                    <h3>38</h3>

                    <h5><b>Em andamento</b></h5>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <a href="#" class="small-box-footer">
                    <span class="text-white">Listar <i class="fas fa-arrow-circle-right"></i></span>
                </a>
            </div>
        </div>
        {{--<div class="col-md-2">
            <!-- small card -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>87</h3>

                    <h5><b>Finalizadas</b></h5>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Listar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-2">
            <!-- small card -->
            <div class="small-box bg-light">
                <div class="inner">
                    <h3>190</h3>

                    <h5><b>Total</b></h5>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Listar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>--}}
    </div>
    <!-- /.row -->
@endsection
