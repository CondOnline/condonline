@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0"><b>Rua: </b>{{ $street->short }}</h1>
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
                    @can('admin.streets.edit')
                        <a href="{{ route('admin.streets.edit', $street->id) }}" class="btn btn-sm btn-info">Editar</a>
                    @endcan
                    @can('admin.streets.destroy')
                        <a  href="#" class="btn btn-sm btn-danger"
                            onclick="event.preventDefault();document.getElementById('delete-form').submit();">Excluir</a>
                        <form id="delete-form" action="{{ route('admin.streets.destroy', $street->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endcan
                </div>

                <div class="card-body">
                    <p><b>Abreviação: </b>{{ $street->short }}</p>
                    <p><b>Nome: </b>{{ $street->long }}</p>
                </div>

                <div class="card-footer">
                    <h4>Residencias</h4>

                    <table id="table" class="table table-bordered table-striped">
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
                                <td><a href="{{ route('admin.residences.show', $residence->id) }}" class="@if(auth()->user()->dark_mode) text-white @else text-dark @endif">{{ $residence->address }}</a></td>
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
    @include('_includes.dataTables')
@endsection
