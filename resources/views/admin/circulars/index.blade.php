@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Grupos de Usuários</b></h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Grupos de Usuários</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                @can('admin.groups.create')
                    <div class="card-header text-right">
                        <a href="{{ route('admin.groups.create') }}" class="btn btn-sm btn-success">Cadastrar</a>
                    </div>
                @endcan
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as $group)
                            <tr>
                                <td>
                                    @can('admin.group.show')
                                        <a href="{{ route('admin.groups.show', $group->id) }}" class="text-dark">{{ $group->title }}</a>
                                    @else
                                        {{ $group->title }}
                                    @endcan
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
