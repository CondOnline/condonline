@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0"><b>Residencia: </b>{{ $residence->address }}</h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.residences.index') }}">Resdências</a></li>
    <li class="breadcrumb-item active">{{ $residence->address }}</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-right">
                    @can('admin.residences.edit')
                        <a href="{{ route('admin.residences.edit', $residence->id) }}" class="btn btn-sm btn-info">Editar</a>
                    @endcan
                    @can('admin.residences.destroy')
                        <a  href="#" class="btn btn-sm btn-danger"
                            onclick="event.preventDefault();document.getElementById('delete-form').submit();">Excluir</a>
                        <form id="delete-form" action="{{ route('admin.residences.destroy', $residence->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endcan
                </div>

                <div class="card-body">
                    <p><b>Rua: </b>{{ $residence->street->long }}</p>
                    <p><b>Número: </b>{{ $residence->number }}</p>
                    <p><b>Quadra: </b>{{ $residence->block }}</p>
                    <p><b>Lote: </b>{{ $residence->lot }}</p>
                    <p><b>Vagas: </b>{{ $residence->parking_spaces }}</p>
                    <p><b>Ramal: </b>{{ $residence->extension }}</p>
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
                        @foreach($residence->users as $user)
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
