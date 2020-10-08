@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0 text-dark"><b>Usuário: </b>{{ $user->name }}</h1>
@endsection

@section('content_header_breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Meus Dados</li>

@endsection


@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-right">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalPassword">
                        Alterar Senha
                    </button>
                </div>
                <div class="card-body d-md-flex">
                    <div class="col-12 col-md-auto mb-4 order-2 align-self-start">
                        @if ($user->photo)
                            <h6><b>Foto</b>
                                <a href="{{ route('user.remove.photo') }}" class="badge badge-danger"><i class="fas fa-1x fa-times"></i></a>
                                <a href="#" class="badge badge-info" data-toggle="modal" data-target="#modalPhoto"><i class="fas fa-1x fa-pen"></i></a>
                            </h6>
                            <img src="{{ route('user.photo', $user->photo) }}" class="elevation-2 img-circle" width="150px" alt="User Image">
                        @else
                            <h6><b>Foto</b>
                                <a href="#" class="badge badge-success" data-toggle="modal" data-target="#modalPhoto"><i class="fas fa-1x fa-plus"></i></a>
                            </h6>
                            <img src="https://ui-avatars.com/api/?name={{urlencode(Auth()->user()->name)}}&color=7F9CF5&background=EBF4FF&size=128" class="elevation-2 img-circle" width="150px" alt="User Image">
                        @endif
                    </div>
                    <div class="col-12 col-md-auto order-1 mr-auto">
                        <p><b>CPF: </b>{{ $user->cpf }}</p>
                        <p><b>RG: </b>{{ $user->rg }}</p>
                        <p><b>Gênero: </b>{{ ($user->gender == 'male')?'Masculino':(($user->gender == 'female')?'Feminino':'') }}</p>
                        <p><b>Celular: </b>{{ $user->mobile_phone }}</p>
                        <p><b>Nascimento: </b>{{ $user->birth ? $user->birth->format('d/m/Y') : '-' }}</p>
                        <p><b>Email: </b>{{ $user->email }}</p>
                    </div>
                </div>

                <div class="card-footer">
                    <h4>Residências</h4>

                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Rua - Número</th>
                            <th>Quadra - Lote</th>
                            <th>Ramal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->residences as $residence)
                            <tr>
                                <td>{{ $residence->address }}</td>
                                <td>{{ $residence->block }} - {{ $residence->lot }}</td>
                                <td>{{ $residence->extension??'-' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


    <!-- Modal Password -->
    <div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alterar Senha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.alter.password') }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Senha Antiga</label>
                            <input type="password" name="old_password" class="form-control" pattern="^\S{8,}$" placeholder="Senha Antiga" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimo 8 dígitos' : '');" required>
                        </div>
                        <div class="form-group">
                            <label>Nova Senha</label>
                            <input type="password" name="password" class="form-control" placeholder="Nova Senha" pattern="^\S{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimo 8 dígitos' : ''); if(this.checkValidity()) form.password_confirmation.pattern = this.value;" required>
                        </div>
                        <div class="form-group">
                            <label>Corfirmar Senha</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar Senha" pattern="^\S{8,}$" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Alterar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Photo -->
    <div class="modal fade" id="modalPhoto" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alterar Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.update.photo') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Foto</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="photo" id="photo" accept="image/*">
                                <label class="custom-file-label" for="photo">Foto</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Alterar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>
        $('#modalPassword').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
        })
        $('#modalPhoto').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
        })

        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>

    @include('_includes.dataTables')

@endsection
