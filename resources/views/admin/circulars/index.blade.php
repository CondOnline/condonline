@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Circulares</b></h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Circulares</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                @can('admin.circulars.create')
                    <div class="card-header text-right">
                        <a href="{{ route('admin.circulars.create') }}" class="btn btn-sm btn-success">Cadastrar</a>
                    </div>
                @endcan
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Data Criação</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($circulars as $circular)
                            <tr>
                                <td>
                                    @can('admin.circulars.show')
                                        <a href="{{ route('admin.circulars.show', $circular->id) }}" class="text-dark">{{ $circular->title }}</a>
                                    @else
                                        {{ $circular->title }}
                                    @endcan
                                </td>
                                <td>
                                    {{ $circular->created_at->format('d/m/Y') }}
                                </td>
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
