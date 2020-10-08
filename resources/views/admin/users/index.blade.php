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
                    <table id="table" class="table table-bordered table-striped data-table text-dark">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>CPF</th>
                                <th>Celular</th>
                            </tr>
                        </thead>
                        <tbody>
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
            var table = $('#table').DataTable({
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "<br>(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": ">",
                        "sPrevious": "<",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    },
                    "select": {
                        "rows": {
                            0: "Nenhuma linha selecionada",
                            1: "Selecionado 1 linha",
                            _: "Selecionado %d linhas"
                        }
                    },
                    "buttons": {
                        "copy": "Copiar para a área de transferência",
                        "copyTitle": "Cópia bem sucedida",
                        "copySuccess": {
                            1: "Uma linha copiada com sucesso",
                            _: "%d linhas copiadas com sucesso"
                        }
                    }
                },
                "responsive": true,
                "autoWidth": false,
                "order": [[0, "ASC"]],
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.users.index') }}",
                columns: [
                    {data: 'name', name: 'name', render:function(data, type, row){
                            return "<a  class=\"text-dark\" href='/admin/users/"+ row.id +"'>" + row.name + "</a>"
                        }},
                    {data: 'email', name: 'email'},
                    {data: 'cpf', name: 'cpf'},
                    {data: 'mobile_phone', name: 'mobile_phone'},
                ]
            });
        });
    </script>
@endsection
