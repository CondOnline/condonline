@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Adicionar Encomenda</b></h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Encomendas</a></li>
    <li class="breadcrumb-item active">Adicionar Encomenda</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <form action="{{ route('admin.orders.store') }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @include('admin.orders._partials.form')
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

        $(document).ready(function () {
            bsCustomFileInput.init();
        });

        $(function(){
            $('select#residence').on('change', function(){
                $('select#user').empty();
                var residence = $('select#residence').val()
                $.ajax({ // ajax
                    type: "POST",
                    url: "{{route('admin.residences.users')}}",
                    data: {
                        "residence" : residence,
                        "_token" : "{{ csrf_token() }}"
                    },
                    success: function(result) {
                        if (result.length <= 0){
                            $('select#user').append('<option value="" disabled selected>Nenhum usuário Encontrador</option>');
                        }else{
                            $('select#user').append('<option value="" disabled selected>Destinatário</option>');
                            for (var i = 0; i < result.length; i++) {
                                $('select#user').append('<option value="' + result[i].id + '">' + result[i].name + "</option>");
                            }
                        }
                    },
                    error: function () {
                        $('select#user').append('<option value="" disabled selected>Nenhum usuário Encontrador</option>');
                    },
                });
            });
        });

    </script>

@endsection
