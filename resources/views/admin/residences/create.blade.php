@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0"><b>Adicionar Residência</b></h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.residences.index') }}">Residências</a></li>
    <li class="breadcrumb-item active">Adicionar Residência</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <form action="{{ route('admin.residences.store') }}" method="post">
                    <div class="card-body">
                        @include('admin.residences._partials.form')
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
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>

@endsection
