@extends('layouts.app')

@section('content_header_title')
    <h1 class="m-0"><b>Usuário: </b>{{ $user->name }}</h1>
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
                    <a href="{{ route('user.dark.mode') }}" class="btn btn-sm
                        @if ($user->dark_mode)
                            btn-bg-light
                        @else
                            btn-bg-black
                        @endif">
                        @if ($user->dark_mode)
                            Modo Claro
                        @else
                            Modo Escuro
                        @endif
                        </a>
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
                            <img src="{{ route('user.photo', [$user, 'date' => $user->updated_at->timestamp]) }}" class="elevation-2" width="150px" alt="User Image">
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
                        </div>
                    @endif
                </div>

                <div class="card-footer">
                    @if (!$user->two_factor_secret)
                        <form action="{{ url('/user/two-factor-authentication') }}" id="form2fa" method="post" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" class="btn-2fa btn btn-sm btn-success">
                            Ativar Autenticação em 2 Fatores
                        </a>
                    @else
                        <form action="{{ url('user/two-factor-recovery-codes') }}" id="recoveryCodes" method="post" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" class="btn-recoveryCodes btn btn-sm btn-secondary">
                            Gerar códigos de recuperação
                        </a>
                        <form action="{{ url('/user/two-factor-authentication') }}" id="form2fa" method="post" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a href="#" class="btn-2fa btn btn-sm btn-danger">
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

                    @forelse($sessions as $session)
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
                    @empty
                        <div class="col-md-6">
                            <p class="text-justify">Caso você desconfie que alguém está utilizando sua conta indevidamente,
                                poderá clicar no botão de deslogar outros dispositivos. Dessa forma sua conta será deslogada
                                de todos os outros dispositivos, ficando conectada apenas no dispositivo atual!</p>
                        </div>
                    @endforelse
                </div>

                {{--@if($sessions->count() > 1)--}}
                    <div class="card-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalLogout">
                            Deslogar Outros Dispositivos
                        </button>
                    </div>
                {{--@endif--}}
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
                            <input type="password" name="old_password" class="form-control" placeholder="Senha Antiga" required>
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
                    <h5 class="modal-title">Deslogar Outros Dispositivos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form action="{{ route('user.logoutOtherDevices') }}" method="POST">
                        @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" name="password" class="form-control" placeholder="Senha">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-danger">
                            Deslogar Outros Dispositivos
                        </button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Pass 2FA -->
    <div class="modal fade" id="modalPass2fa" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ !$user->two_factor_secret ? 'Ativar' : 'Desativar' }} Autenticação em 2 Fatores</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" id="confirmPass" name="password" class="form-control" placeholder="Senha" required>
                            <div class="invalid-feedback hide">
                                Senha Incorreta
                            </div>
                            <input type="hidden" id="action2fa" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" id="btn-confirmPass" class="btn btn-sm {{ !$user->two_factor_secret ? 'btn-success' : 'btn-danger' }}">

                        </a>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
            </div>
        </div>
    </div>

    @if ((session('status') == 'two-factor-authentication-enabled') || session('status') == 'recovery-codes-generated')
    <!-- Modal 2fa -->
    <div class="modal fade" id="modal2fa" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Autenticação em dois fatores</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        @if (session('status') == 'two-factor-authentication-enabled')
                            <p class="text-justify"><span class="font-weight-bolder">Você ativou a autenticação de dois fatores.</span>
                            <br>
                            A autenticação de dois fatores agora está habilitada. Leia o seguinte código QR
                            usando o aplicativo autenticador do seu telefone, ou <a href="{{ $user->twoFactorQrCodeUrl() }}" class="@if(auth()->user()->dark_mode) text-white @else text-dark @endif"><u>clique aqui</u> </a>.</p>
                        @else
                            <p class="text-justify"><span class="font-weight-bolder">Códigos de recuperação.</span>
                        @endif
                    </div>
                    @if (session('status') == 'two-factor-authentication-enabled')
                        <div class="col-md-2">
                            {!! $user->twoFactorQrCodeSvg() !!}
                        </div>

                        <div class="mt-2">
                            <div class="bg-transparent bg-light">
                                @foreach (json_decode(decrypt($user->two_factor_recovery_codes), true) as $code)
                                    <div><em>{{ $code }}</em></div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-2">
                                <span class="text-gray"><small>Armazene esses códigos de recuperação em um gerenciador de senhas seguro.
                                    Eles podem ser usados para recuperar o acesso à sua conta se o seu dispositivo de autenticação de
                                    dois fatores for perdido.</small></span>
                        </div>
                    @else
                        <div class="mt-2">
                            <div class="bg-transparent bg-light">
                                @foreach (json_decode(decrypt($user->two_factor_recovery_codes), true) as $code)
                                    <div><em>{{ $code }}</em></div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-2">
                            <span class="text-gray"><small>Armazene esses códigos de recuperação em um gerenciador de senhas seguro.
                                Eles podem ser usados para recuperar o acesso à sua conta se o seu dispositivo de autenticação de
                                dois fatores for perdido.</small></span>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn-2fa btn btn-sm btn-danger">
                        Desativar
                    </a>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection

@section('js')

    <script>
        var textBtn2fa = '{{ !$user->two_factor_secret ? 'Ativar' : 'Desativar' }} Autenticação em 2 Fatores';
        $("#btn-confirmPass").text(textBtn2fa);


        $('#modalPassword').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
        })
        $('#modalPhoto').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
        })
        $('#modalLogout').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
        })
        $('#modalPass2fa').on('hidden.bs.modal', function () {
            $("#confirmPass").val('');
            $("#action2fa").val('');
            $("#confirmPass").removeClass('is-invalid');
        })

        $(".btn-2fa").click(function(e){
            $("#action2fa").val('2fa');
            enable2fa();
            e.preventDefault();
        });

        $(".btn-recoveryCodes").click(function(e){
            $("#action2fa").val('recoveryCodes');
            recoveryCodes();
            e.preventDefault();
        });

        $("#btn-confirmPass").click(function(e){
            $("#btn-confirmPass").text('Aguarde...');
            $("#btn-confirmPass").addClass('disabled');
            $.ajax({ // ajax
                type: "POST",
                dataType: "json",
                url: "{{ url('user/confirm-password') }}",
                data: {
                    "password" : $("#confirmPass").val(),
                    "_token" : "{{ csrf_token() }}"
                },
                complete: function(result) {
                    if (result.status == 201) {
                        if ($("#action2fa").val() == '2fa') {
                            enable2fa();
                        }
                        if ($("#action2fa").val() == 'recoveryCodes') {
                            recoveryCodes();
                        }
                    } else {
                        $("#confirmPass").addClass('is-invalid');
                        $("#btn-confirmPass").text(textBtn2fa);
                        $("#btn-confirmPass").removeClass('disabled');
                    }
                }
            });
            e.preventDefault();
        });

        function enable2fa() {
            confirmPassStatus(function (result) {
                if (result.confirmed) {
                    document.getElementById('form2fa').submit();
                }
            });
        }

        function recoveryCodes() {
            confirmPassStatus(function (result) {
                if (result.confirmed) {
                    document.getElementById('recoveryCodes').submit();
                }
            });
        }

        function confirmPassStatus(handleData){
            $.ajax({ // ajax
                type: "GET",
                url: "{{ route('password.confirmation') }}",
                success: function(result) {
                    if (!result.confirmed) {
                        $('#modalPass2fa').modal('show');
                    }
                    handleData(result);
                }
            });
        }

        function confirmPass(handleData){
            $.ajax({ // ajax
                type: "GET",
                url: "{{ route('password.confirmation') }}",
                success: function(result) {
                    handleData(result);
                }
            });
        }


        @if ((session('status') == 'two-factor-authentication-enabled') || session('status') == 'recovery-codes-generated')
            $('#modal2fa').modal('show')
        @endif

        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>

    @include('_includes.dataTables')

@endsection
