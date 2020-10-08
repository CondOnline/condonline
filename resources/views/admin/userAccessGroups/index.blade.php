@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Grupos de Acesso</b></h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Grupos de Acesso</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                @can('admin.userAccessGroups.create')
                    <div class="card-header text-right">
                        <a href="{{ route('admin.userAccessGroups.create') }}" class="btn btn-sm btn-success">Cadastrar</a>
                    </div>
                @endcan
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Descrição</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($userAccessGroups as $userAccessGroup)
                            <tr>
                                <td>
                                    @can('admin.userAccessGroups.show')
                                        <a href="{{ route('admin.userAccessGroups.show', $userAccessGroup->id) }}" class="text-dark">{{ $userAccessGroup->title }}</a>
                                    @else
                                        {{ $userAccessGroup->title }}
                                    @endcan
                                </td>
                                <td>{{ $userAccessGroup->description }}</td>
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
