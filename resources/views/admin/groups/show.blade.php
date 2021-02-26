@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0"><b>Grupo: </b>{{ $group->title }}</h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.groups.index') }}">Grupos de Usuários</a></li>
    <li class="breadcrumb-item active">{{ $group->title }}</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-right">
                    @can('admin.groups.edit')
                        <a href="{{ route('admin.groups.edit', $group->id) }}" class="btn btn-sm btn-info">Editar</a>
                    @endcan
                    @can('admin.groups.destroy')
                        <a href="#" class="btn btn-sm btn-danger"
                            onclick="event.preventDefault();document.getElementById('delete-form').submit();">Excluir</a>
                        <form id="delete-form" action="{{ route('admin.groups.destroy', $group->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endcan
                </div>

                <div class="card-body">
                    <p><b>Titulo: </b>{{ $group->title }}</p>
                </div>

                <div class="card-footer">
                    <h4>Usuários</h4>

                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>CPF</th>
                            <th>Celular</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($group->users as $user)
                            <tr>
                                <td><a href="{{ route('admin.users.show', $user->id) }}" class="@if(auth()->user()->dark_mode) text-white @else text-dark @endif">{{ $user->name }}</a></td>
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
    @include('_includes.dataTables')
@endsection
