@extends('auth.layout.auth')

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Confirmar Senha</p>

        <p>Confirme sua senha para continuar!</p>

        <form action="{{ route('password.confirm') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="senha" placeholder="Senha">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span id="show_password" class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <hr>

        <a href="{{ route('password.request') }}">Esqueceu sunha senha?</a>
    </div>
    <!-- /.login-card-body -->
@endsection
