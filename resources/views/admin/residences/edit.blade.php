@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Editar Residência</b></h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.residences.index') }}">Residências</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.residences.show', $residence->id) }}">{{ $residence->street->short . ' ' . $residence->number }}</a></li>
    <li class="breadcrumb-item active">Editar Residência</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <form action="{{ route('admin.residences.update', $residence->id) }}" method="post">
                    <div class="card-body">
                        @method('PUT')
                        @include('admin.residences._partials.form')
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
