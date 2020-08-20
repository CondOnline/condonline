@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Editar Encomenda</b></h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Encomendas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.show', $order->id) }}">{{ $order->tracking }}</a></li>
    <li class="breadcrumb-item active">Editar Encomenda</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                    <div class="card-body">
                        @method('PUT')
                        @include('admin.orders._partials.form')
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
            $('.select2').select2()
        })

        $(function(){
            $('select#residence').on('change', function(){
                $('select#user').empty();
                $('select#user').append('<option>Destinatário</option>');
                var residence = $('select#residence').val()
                if (!isNaN(residence)){
                    $.ajax({ // ajax
                        type: "GET",
                        url: "{{route('admin.residences.users')}}",
                        data: { residence : residence },
                        success: function(result) {
                            for (var i = 0; i < result.length; i++) {
                                $('select#user').append('<option value="' + result[i].id + '">' + result[i].name + "</option>");
                            }
                        },
                    });
                }
            });
        });

    </script>

@endsection
