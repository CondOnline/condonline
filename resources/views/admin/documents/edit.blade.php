@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Editar Documento</b></h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('user.documents.index') }}">Documentos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('user.documents.show', [$document->id, $document->title]) }}">{{ $document->title }}</a></li>
    <li class="breadcrumb-item active">Editar Documento</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <form action="{{ route('admin.documents.update', $document->id) }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @method('PUT')
                        @include('admin.documents._partials.form')
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>

@endsection
