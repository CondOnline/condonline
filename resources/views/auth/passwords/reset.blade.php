@extends('auth.layout.auth')

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Alterar Senha</p>

        <form action="{{ route('password.update') }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="input-group mb-3">
                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="password" type="password" placeholder="Senha" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="senha">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="password-confirm" type="password" placeholder="Confirmar Senha" class="form-control" name="password_confirmation" required autocomplete="senha">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Alterar Senha</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <hr>

        <a href="{{ route('login') }}" class="text-center">Entrar</a>
    </div>
    <!-- /.login-card-body -->
@endsection
