@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Usuários</b></h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Usuários</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                @can('admin.users.create')
                    <div class="card-header text-right">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-success">Cadastrar</a>
                    </div>
                @endcan
                <div class="card-body">
                    <table id="tableUsers" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>CPF</th>
                                <th>Celular</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    @can('admin.users.show')
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="text-dark">{{ $user->name }}</a>
                                    @else
                                        {{ $user->name }}
                                    @endcan
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->cpf }}</td>
                                <td>{{ $user->mobile_phone }}</td>
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
