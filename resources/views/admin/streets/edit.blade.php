@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Editar Rua </b>{{ $street->short }}</h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.streets.index') }}">Ruas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.streets.show', $street->id) }}">{{ $street->short }}</a></li>
    <li class="breadcrumb-item active">Editar Rua</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <form action="{{ route('admin.streets.update', $street->id) }}" method="post">
                    <div class="card-body">
                        @method('PUT')
                        @include('admin.streets._partials.form')
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
