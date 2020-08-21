@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Rua: </b>{{ $street->short }}</h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.streets.index') }}">Ruas</a></li>
    <li class="breadcrumb-item active">{{ $street->short }}</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-right">
                    <a href="{{ route('admin.streets.edit', $street->id) }}" class="btn btn-sm btn-info">Editar</a>
                    <a  href="#" class="btn btn-sm btn-danger"
                        onclick="event.preventDefault();document.getElementById('delete-form').submit();">Excluir</a>
                    <form id="delete-form" action="{{ route('admin.streets.destroy', $street->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>

                <div class="card-body">
                    <p><b>Abreviação: </b>{{ $street->short }}</p>
                    <p><b>Nome: </b>{{ $street->long }}</p>
                </div>

                <div class="card-footer">
                    <h4>Residencias</h4>

                    <table id="tableUserAccessGroups" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Rua - Número</th>
                            <th>Quadra</th>
                            <th>Lote</th>
                            <th>Ramal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($street->residences as $residence)
                            <tr>
                                <td><a href="{{ route('admin.residences.show', $residence->id) }}" class="text-dark">{{ $street->short . ' ' . $residence->number }}</a></td>
                                <td>{{ $residence->block }}</td>
                                <td>{{ $residence->lot }}</td>
                                <td>{{ $residence->extension }}</td>
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
