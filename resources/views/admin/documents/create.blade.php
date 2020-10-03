@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Adicionar Documento</b></h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('user.documents.index') }}">Documentos</a></li>
    <li class="breadcrumb-item active">Adicionar Documento</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <form action="{{ route('admin.documents.store') }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @include('admin.documents._partials.form')
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
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
