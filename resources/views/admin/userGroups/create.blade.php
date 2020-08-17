@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Adicionar Grupo de Usuários</b></h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.userGroups.index') }}">Grupo de Usuários</a></li>
    <li class="breadcrumb-item active">Adicionar Grupo de Usuários</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <form action="{{ route('admin.userGroups.store') }}" method="post">
                    <div class="card-body">
                        @include('admin.userGroups._partials.form')
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
