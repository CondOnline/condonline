@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Usuário: </b>{{ $user->name }}</h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Meus Dados</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-right">
                    <a href="#" class="btn btn-sm btn-primary">Alterar Senha</a>
                </div>
                <div class="card-body d-md-flex">
                    <div class="col-12 col-md-auto mb-4 order-2 align-self-start">
                        @if ($user->photo)
                            <h6><b>Foto</b>
                                <a href="{{ route('user.remove.photo') }}" class="badge badge-danger"><i class="fas fa-1x fa-times"></i></a>
                                <a href="#" class="badge badge-info"><i class="fas fa-1x fa-pen"></i></a>
                            </h6>
                            <img src="{{ route('user.photo', $user->id) }}" class="elevation-2" width="200px" alt="User Image">
                        @else
                            <h6><b>Foto</b>
                                <a href="#" class="badge badge-success"><i class="fas fa-1x fa-plus"></i></a>
                            </h6>
                            <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="elevation-2" width="200px" alt="User Image">
                        @endif
                    </div>
                    <div class="col-12 col-md-auto order-1 mr-auto">
                        <p><b>CPF: </b>{{ $user->cpf }}</p>
                        <p><b>RG: </b>{{ $user->rg }}</p>
                        <p><b>Gênero: </b>{{ ($user->gender == 'male')?'Masculino':(($user->gender == 'female')?'Feminino':'') }}</p>
                        <p><b>Celular: </b>{{ $user->mobile_phone }}</p>
                        <p><b>Nascimento: </b>{{ $user->birth ? $user->birth->format('d/m/Y') : '-' }}</p>
                        <p><b>Email: </b>{{ $user->email }}</p>
                    </div>
                </div>

                <div class="card-footer">
                    <h4>Residências</h4>

                    <table id="tableResidences" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Rua - Número</th>
                            <th>Quadra - Lote</th>
                            <th>Ramal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->residences as $residence)
                            <tr>
                                <td>{{ $residence->address }}</td>
                                <td>{{ $residence->block }} - {{ $residence->lot }}</td>
                                <td>{{ $residence->extension??'-' }}</td>
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
            $("#tableResidences").DataTable({
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
