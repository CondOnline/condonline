@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Editar Grupo de Usuários</b></h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.groups.index') }}">Grupos de Usuários</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.groups.show', $group->id) }}">{{ $group->title }}</a></li>
    <li class="breadcrumb-item active">Editar Grupo de Usuários</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <form action="{{ route('admin.groups.update', $group->id) }}" method="post">
                    <div class="card-body">
                        @method('PUT')
                        @include('admin.groups._partials.form')
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
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();
        })
        function selectAllPermissions() {
            $(".select2 > option").prop("selected","selected");
            $(".select2").trigger("change");
        }

        function removeAllPermissions() {
            $('.select2').val(null).trigger('change');
        }
    </script>

@endsection
