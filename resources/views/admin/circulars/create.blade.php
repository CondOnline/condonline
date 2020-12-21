@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Criar Circular</b></h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.groups.index') }}">Circulares</a></li>
    <li class="breadcrumb-item active">Criar Circular</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <form action="{{ route('admin.circulars.store') }}" method="post">
                    <div class="card-body">
                        @include('admin.circulars._partials.form')
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
        $(function () {
            // Summernote
            $('.textarea').summernote({
                lang: "pt-BR",
                placeholder: 'Texto',
                tabsize: 2,
                height: 200,
                maximumImageFileSize: 5240000,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']]
                ]
            })
        })
    </script>

@endsection
