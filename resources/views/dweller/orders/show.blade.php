@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Encomenda: </b>{{ $order->tracking }}</h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dweller.orders.index') }}">Minhas Encomendas</a></li>
    <li class="breadcrumb-item active">{{ $order->tracking }}</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body d-md-flex">
                    <div class="col-12 col-md-auto order-1 mr-auto">
                        <p><b>Rastreio: </b>{{ $order->tracking }}</p>
                        <p><b>Destinatário: </b>{{ $order->user->name }}</p>
                        <p><b>Residencia: </b>{{ $order->residence->address }}</p>
                        <p><b>Remetente: </b>{{ $order->sender }}</p>
                        <p><b>Transportadora: </b>{{ $order->shipping_company }}</p>
                        <p><b>Data Recebimento: </b>{{ $order->input_at->format('d/m/Y') }}</p>
                        @if ($order->delivered_at)
                            <p><b>Data Entraga: </b>{{ $order->delivered_at->format('d/m/Y') }}</p>
                            <p><b>Quem recebeu: </b>{{ $order->received??'-' }}</p>
                        @endif
                        <p><b>Status: </b><span class="@if($order->delivered_at) text-success @else text-warning @endif">{{ $order->status }}</span></p>
                    </div>
                    <div class="col-auto mb-4 order-2 align-self-start">
                        <div class="row">
                            <div class="col-auto mb-3 mb-md-0">
                                @if ($order->image)
                                    <h6><b>Foto Encomenda</b></h6>
                                    <img src="{{ route('dweller.orders.image', [$order->id, $order->image]) }}" class="elevation-2 mb-0" width="200px" alt="User Image">
                                @endif
                            </div>

                            <div class="col-auto">
                                @if ($order->image_signature)
                                    <h6><b>Foto Assinatura</b></h6>
                                    <img src="{{ route('dweller.orders.image', [$order->id, $order->image_signature]) }}" class="elevation-2" width="200px" alt="User Image">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
