@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Circular: </b>{{ $circular->title }}</h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.circulars.index') }}">Circulares</a></li>
    <li class="breadcrumb-item active">{{ $circular->title }}</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-right">
                    @can('admin.circulars.send')
                        <a href="{{--{{ route('admin.circulars.send', $circular->id) }}--}}" class="btn btn-sm btn-success">Enviar</a>
                    @endcan
                    @can('admin.circulars.edit')
                        <a href="{{ route('admin.circulars.edit', $circular->id) }}" class="btn btn-sm btn-info">Editar</a>
                    @endcan
                    @can('admin.circulars.destroy')
                        <a href="#" class="btn btn-sm btn-danger"
                            onclick="event.preventDefault();document.getElementById('delete-form').submit();">Excluir</a>
                        <form id="delete-form" action="{{ route('admin.circulars.destroy', $circular->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endcan
                </div>

                <div class="card-body">
                    <p><b>{{ $circular->title }}</b></p>
                    <div>
                        {!! $circular->text_mod !!}
                    </div>

                    <h4 class="float-left mr-2">Anexos</h4> <a href="{{--{{ route('admin.circulars.send', $circular->id) }}--}}"
                                                                class="btn btn-sm btn-success" data-toggle="modal" data-target="#addArchive">Adicionar</a>

                    <table class="table table-bordered table-striped mt-2">
                        <thead>
                        <tr>
                            <th>Arquivo</th>
                            <th width="120">Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($circular->archives as $archive)
                            <tr>
                                <td><a href="{{ route('admin.circulars.archive.show', [$archive->id, $archive->name]) }}" target="_blank" class="text-dark">{{ $archive->name }}</a></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-danger"
                                       onclick="event.preventDefault();document.getElementById('delete-archive-{{$archive->id}}').submit();">Excluir</a>
                                    <form id="delete-archive-{{$archive->id}}" action="{{ route('admin.circulars.archive.destroy', $archive->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="card-footer">
                    <h4>Usuários</h4>

                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Nome</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($circular->recipients as $user)
                            <tr>
                                <td><a href="{{ route('admin.users.show', $user->id) }}" class="text-dark">{{ $user->name }}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal addArchive -->
    <div class="modal fade" id="addArchive" tabindex="" role="dialog" aria-labelledby="Adicionar Anexo" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bolder" id="exampleModalLongTitle">Adicionar Anexo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.circulars.archive', $circular->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input  type="file" id="archive" name="archives[]" accept="application/pdf" multiple>
                        <button type="submit" class="col-12 btn btn-primary mt-2 font-weight-bolder">Carregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    @include('_includes.dataTables')
@endsection
