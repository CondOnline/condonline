@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Editar Usuário</b></h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Usuários</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a></li>
    <li class="breadcrumb-item active">Editar</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <form action="{{ route('admin.users.update', $user->id) }}" method="post">
                    <div class="card-body">
                        @method('PUT')
                        @include('admin.users._partials.form')
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
