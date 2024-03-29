@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0"><b>Usuário: </b>{{ $user->name }}</h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Usuários</a></li>
    <li class="breadcrumb-item active">{{ $user->name }}</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-right">
                    @can('admin.users.edit')
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-info">Editar</a>
                    @endcan
                    @can('admin.users.destroy')
                        <a  href="#" class="btn btn-sm btn-danger" id="deleteUser">Excluir</a>
                        <form id="delete-form" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endcan
                </div>

                <div class="card-body d-md-flex">
                    <div class="col-12 col-md-auto mb-4 order-2 align-self-start">
                        @if ($user->photo)
                            <h6><b>Foto</b> <a href="{{ route('admin.users.remove.photo', $user->id) }}" class="badge badge-danger"><i class="fas fa-1x fa-times"></i></a></h6>
                            <img src="{{ route('admin.users.photo', [$user->id, $user->photo]) }}" class="elevation-2" width="200px" alt="User Image">
                        @else
                            <h6><b>Foto</b></h6>
                            <img src="https://ui-avatars.com/api/?name={{urlencode($user->name)}}&color=7F9CF5&background=EBF4FF&size=128" class="elevation-2" width="150px" alt="User Image">
                        @endif
                    </div>
                    <div class="col-12 col-md-auto order-1 mr-auto">
                        <p><b>Grupo: </b>{{ $user->userAccessGroup->title }}</p>
                        <p><b>CPF: </b>{{ $user->cpf }}</p>
                        <p><b>RG: </b>{{ $user->rg }}</p>
                        <p><b>Gênero: </b>{{ ($user->gender == 'male')?'Masculino':(($user->gender == 'female')?'Feminino':'') }}</p>
                        <p><b>Celular: </b>{{ $user->mobile_phone }}</p>
                        <p><b>Nascimento: </b>{{ $user->birth ? $user->birth->format('d/m/Y') : '-' }}</p>
                        <p><b>Email: </b>{{ $user->email }}</p>
                        <p><b>Morador: </b>{{ $user->dweller ? 'Sim' : 'Não' }}</p>
                        <p><b>Bloqueado: </b>{{ $user->blocked ? 'Sim' : 'Não' }}</p>
                    </div>
                </div>

                <div class="card-footer">
                    <h4>Residências</h4>

                    <table id="table" class="table table-bordered table-striped">
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
                                <td><a href="{{ route('admin.residences.show', $residence->id) }}" class="@if(auth()->user()->dark_mode) text-white @else text-dark @endif">{{ $residence->address }}</a></td>
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
    @include('_includes.dataTables')

    <script>
        $(function() {
            $('#deleteUser').click(function (event) {
                event.preventDefault();
                //const url = $(this).attr('href');
                Swal.fire({
                    title: 'Confirmação de exclusão',
                    text: "Ao excluir um usuário, o mesmo não poderá mais ser recuperado!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sim, Deletar usuário!',
                    cancelButtonText: 'Não, Cancelar!',
                    reverseButtons: true,
                    customClass: {
                        confirmButton: 'btn btn-success mx-auto',
                        cancelButton: 'btn btn-danger mx-auto'
                    },
                    buttonsStyling: false
                }).then(function(value) {
                    if (value.isConfirmed) {
                        document.getElementById('delete-form').submit();
                    }
                });
            });
        });
    </script>
@endsection
