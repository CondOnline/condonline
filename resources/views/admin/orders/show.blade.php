@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0"><b>Encomenda: </b>{{ $order->tracking }}</h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Encomendas</a></li>
    <li class="breadcrumb-item active">{{ $order->tracking }}</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-right">
                    @can('admin.orders.edit')
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-info">Editar</a>
                    @endcan
                    @can('admin.orders.destroy')
                        <a  href="#" class="btn btn-sm btn-danger"
                            onclick="event.preventDefault();document.getElementById('delete-form').submit();">Excluir</a>
                        <form id="delete-form" action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endcan
                </div>

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
                                    <h6><b>Foto Encomenda</b> <a href="{{ route('admin.orders.remove.image', $order->id) }}" class="badge badge-danger"><i class="fas fa-1x fa-times"></i></a></h6>
                                    <img src="{{ route('admin.orders.image', [$order->id, 'image']) }}" class="elevation-2 mb-0" width="200px" alt="User Image">
                                @endif
                            </div>

                            <div class="col-auto">
                                @if ($order->image_signature)
                                    <h6><b>Foto Assinatura</b></h6>
                                    <img src="{{ route('admin.orders.image', [$order->id, 'signature']) }}" class="elevation-2" width="200px" alt="User Image">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')
    @include('_includes.dataTables')
@endsection
