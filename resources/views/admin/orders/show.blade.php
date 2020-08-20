@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Encomenda: </b>{{ $order->tracking }}</h1>
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
                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-info">Editar</a>
                    <a  href="#" class="btn btn-sm btn-danger"
                        onclick="event.preventDefault();document.getElementById('delete-form').submit();">Excluir</a>
                    <form id="delete-form" action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>

                <div class="card-body">
                    <p><b>Rastreio: </b>{{ $order->tracking }}</p>
                    <p><b>Destinatário: </b>{{ $order->user->name }}</p>
                    <p><b>Residencia: </b>{{ $order->residence->street->short . ' ' . $order->residence->number }}</p>
                    <p><b>Remetente: </b>{{ $order->sender }}</p>
                    <p><b>Quem recebeu: </b>{{ $order->received??'-' }}</p>
                    <p><b>Status: </b>{{ $order->received ? 'Entregue' : 'Pendente' }}</p>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>
        $(function () {
            $("#tableUsers").DataTable({
                "language": {
                    "sEmptyTable":   "Não foi encontrado nenhum registo",
                    "sLoadingRecords": "A carregar...",
                    "sProcessing":   "A processar...",
                    "sLengthMenu":   "Mostrar _MENU_ registos",
                    "sZeroRecords":  "Não foram encontrados resultados",
                    "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registos",
                    "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registos",
                    "sInfoFiltered": "(filtrado de _MAX_ registos no total)",
                    "sInfoPostFix":  "",
                    "sSearch":       "Procurar:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Primeiro",
                        "sPrevious": "Anterior",
                        "sNext":     "Seguinte",
                        "sLast":     "Último"
                    },
                    "oAria": {
                        "sSortAscending":  ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    }
                },
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

@endsection
