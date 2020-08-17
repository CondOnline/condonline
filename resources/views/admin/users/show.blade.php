@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Usuário: </b>{{ $user->name }}</h1>
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
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-info">Editar</a>
                    <a  href="#" class="btn btn-sm btn-danger"
                        onclick="event.preventDefault();document.getElementById('delete-form').submit();">Excluir</a>
                    <form id="delete-form" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>

                <div class="card-body">
                    <p><b>Grupo: </b>{{ $user->userGroup->title }}</p>
                    <p><b>CPF: </b>{{ $user->cpf }}</p>
                    <p><b>RG: </b>{{ $user->rg }}</p>
                    <p><b>Gênero: </b>{{ $user->gender }}</p>
                    <p><b>Celular: </b>{{ $user->mobile_phone }}</p>
                    <p><b>Aniverário: </b>{{ $user->birth }}</p>
                    <p><b>Email: </b>{{ $user->email }}</p>
                </div>

                <div class="card-footer">
                    <h4>Residências</h4>
                </div>
            </div>
        </div>
    </div>

@endsection
