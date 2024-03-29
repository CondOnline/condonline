@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0"><b>Minhas Encomendas</b></h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Minhas Encomendas</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Rastreio</th>
                                <th>Residencia</th>
                                <th>Data Recebimenro</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    <a href="{{ route('user.orders.show', $order->id) }}" class="@if(auth()->user()->dark_mode) text-white @else text-dark @endif">{{ $order->tracking }}</a>
                                    @if (in_array($order->tracking, $trackingsNews))
                                        <span class="badge badge-warning badge-pill float-right">Novo</span>
                                    @endif
                                    @if(in_array($order->tracking, $trackingsDelivered))
                                        <span class="badge badge-success badge-pill float-right">Entregue</span>
                                    @endif
                                </td>
                                <td>{{ $order->residence->address }}</td>
                                <td>{{ $order->input_at->format('d/m/Y') }}</td>
                                <td><span class="@if($order->delivered_at) text-success @else text-warning @endif">{{ $order->status }}</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    @include('_includes.dataTables')
@endsection
