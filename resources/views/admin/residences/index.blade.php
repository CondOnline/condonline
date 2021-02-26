@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0"><b>Residências</b></h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Residências</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                @can('admin.residences.create')
                    <div class="card-header text-right">
                        <a href="{{ route('admin.residences.create') }}" class="btn btn-sm btn-success">Cadastrar</a>
                    </div>
                @endcan
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Rua - Número</th>
                                <th>Quadra - Lote</th>
                                <th>Ramal</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($residences as $residence)
                            <tr>
                                <td>
                                    @can('admin.residences.show')
                                        <a href="{{ route('admin.residences.show', $residence->id) }}" class="@if(auth()->user()->dark_mode) text-white @else text-dark @endif">{{ $residence->address }}</a>
                                    @else
                                        {{ $residence->address }}
                                    @endcan
                                </td>
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
@endsection
