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
                            <img src="{{ route('user.photo', $user->photo) }}" class="elevation-2" width="150px" alt="User Image">
                        @else
                            <h6><b>Foto</b>
                                <a href="#" class="badge badge-success" data-toggle="modal" data-target="#modalPhoto"><i class="fas fa-1x fa-plus"></i></a>
                            </h6>
                            <img src="https://ui-avatars.com/api/?name={{urlencode(Auth()->user()->name)}}&color=7F9CF5&background=EBF4FF&size=128" class="elevation-2" width="150px" alt="User Image">
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

    <div class="row" id="2fa">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Autenticação em 2 Fatores</h4>
                </div>

                <div class="card-body">
                    @if (!$user->two_factor_secret)
                        <div class="col-md-6">
                            <p class="text-justify"><span class="font-weight-bolder">Você não ativou a autenticação de dois fatores.</span><br>
                                Quando a autenticação de dois fatores está habilitada, você será solicitado a fornecer um token
                                aleatório seguro durante a autenticação. Você pode recuperar esse token do aplicativo Google
                                Authenticator do seu telefone.</p>
                        </div>
                    @else
                        <div class="col-md-6">
                            <p class="text-justify"><span class="font-weight-bolder">Você ativou a autenticação de dois fatores.</span>
                                <br>
                                Quando a autenticação de dois fatores está habilitada, você será solicitado a
                                fornecer um token aleatório seguro durante a autenticação. Você pode recuperar esse
                                token do aplicativo Google Authenticator do seu telefone.
                                <br>
                                A autenticação de dois fatores agora está habilitada. Leia o seguinte código QR
                                usando o aplicativo autenticador do seu telefone.</p>
                        </div>
                        @if (session('enabled2fa'))
                            <div class="col-md-2">
                                {!! $user->twoFactorQrCodeSvg() !!}
                                <br>
                                {{ decrypt($user->two_factor_secret) }}
                            </div>

                            <div class="col-md-2 mt-2">
                                <div class="bg-transparent bg-light">
                                    @foreach (json_decode(decrypt($user->two_factor_recovery_codes), true) as $code)
                                        <div><em>{{ $code }}</em></div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <span class="text-gray"><small>Armazene esses códigos de recuperação em um gerenciador de senhas seguro.
                                    Eles podem ser usados para recuperar o acesso à sua conta se o seu dispositivo de autenticação de
                                    dois fatores for perdido.</small></span>
                            </div>
                        @endif
                        @if (session('regenerate2fa'))
                            <div class="col-md-2 mt-2">
                                <div class="bg-transparent bg-light">
                                    @foreach (json_decode(decrypt($user->two_factor_recovery_codes), true) as $code)
                                        <div><em>{{ $code }}</em></div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <span class="text-gray"><small>Armazene esses códigos de recuperação em um gerenciador de senhas seguro.
                                    Eles podem ser usados para recuperar o acesso à sua conta se o seu dispositivo de autenticação de
                                    dois fatores for perdido.</small></span>
                            </div>
                        @endif
                    @endif
                </div>

                <div class="card-footer">
                    @if (!$user->two_factor_secret)
                        <a class="btn btn-sm btn-success" href="{{ route('user.enable2fa') }}">
                            Ativar Autenticação em 2 Fatores
                        </a>
                    @else
                        <a class="btn btn-sm btn-secondary" href="{{ route('user.regenerate2fa') }}">
                            Gerar códigos de recuperação
                        </a>
                        <a class="btn btn-sm btn-danger" href="{{ route('user.disable2fa') }}">
                            Desativar
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Sessões Ativas</h4>
                </div>

                <div class="card-body">

                    @foreach($sessions as $session)
                        <div class="d-flex align-items-center mt-3">
                            @if ($session->agent->isDesktop())
                                <div>
                                    <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"
                                         style="  display: block;
                                                  top: 0;
                                                  left: 0;
                                                  width: 40px;
                                                  overflow: visible;">
                                        <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                         style="  display: block;
                                                  top: 0;
                                                  left: 0;
                                                  width: 40px;
                                                  overflow: visible;">>
                                    <path d="M0 0h24v24H0z" stroke="none"></path><rect x="7" y="4" width="10" height="16" rx="1"></rect><path d="M11 5h2M12 17v.01"></path>
                                </svg>
                            @endif

                            <div class="ml-3">
                                <div class="font-weight-bolder">
                                    {{ $session->agent->platform() }} - {{ $session->agent->browser() }}
                                </div>

                                <div>
                                    <div class="text-gray">
                                        {{ $session->ip_address }},

                                        @if ($session->is_current_device)
                                            <span class="text-green">Este Dispositivo</span>
                                        @else
                                            Ultima Atividade {{ $session->last_active }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($sessions->count() > 1)
                    <div class="card-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalLogout">
                            Deslogar dos Outros Dispositivos
                        </button>
                    </div>
                @endif
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
                        <button type="submit" class="btn btn-sm btn-primary">Alterar</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fechar</button>
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
                        <button type="submit" class="btn btn-sm btn-primary">Alterar</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Logout -->
    <div class="modal fade" id="modalLogout" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Fazer Logout dos Outros Dispositivos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form action="{{ route('user.logoutOtherDevices') }}" method="POST">
                        @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" name="password" class="form-control" placeholder="Senha" pattern="^\S{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimo 8 dígitos' : ''); if(this.checkValidity()) form.password_confirmation.pattern = this.value;" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-danger">
                            Deslogar dos Outros Dispositivos
                        </button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fechar</button>
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
