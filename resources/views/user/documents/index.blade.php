@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Documentos</b></h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Documentos</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                @can('admin.documents.create')
                    <div class="card-header text-right">
                        <a href="{{ route('admin.documents.create') }}" class="btn btn-sm btn-success">Cadastrar</a>
                    </div>
                @endcan
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Documento</th>
                                @can('admin.documents.edit')
                                    <th width="60px" class="text-center">Editar</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($documents as $document)
                            <tr>
                                <td>
                                    <a href="{{ route('user.documents.show', [$document->id, $document->title]) }}" target="_blank" class="text-dark" onclick="window.location.reload(true);">{{ $document->title }}</a>
                                    @if (in_array($document->id, $DocumentsNews))
                                        <span class="badge badge-warning badge-pill float-right">Novo</span>
                                    @endif
                                </td>
                                @canany(['admin.documents.edit',
                                         'admin.documents.destroy'])
                                    <td class="text-center">
                                        @can('admin.documents.edit')
                                            <a href="{{ route('admin.documents.edit', $document->id) }}" class="text-info"><i class="fas fa-edit"></i></a>
                                        @endcan
                                        @can('admin.documents.destroy')
                                                <a  href="#" class="text-danger"
                                                    onclick="event.preventDefault();document.getElementById('delete-form-{{$document->id}}').submit();"><i class="fas fa-trash-alt"></i></a>
                                                <form id="delete-form-{{$document->id}}" action="{{ route('admin.documents.destroy', $document->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                        @endcan
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
