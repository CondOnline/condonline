@extends('auth.layout.auth')

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Confirme o acesso à sua conta inserindo o código de autenticação fornecido pelo seu aplicativo Google Authenticator.</p>

        <form action="/two-factor-challenge" method="post">
            @csrf
            <div class="input-group mb-3">
                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" required autocomplete="Código" placeholder="Código">
                @error('code')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        {{--<hr>

        <a href="{{ route('password.request') }}">Esqueceu sunha senha?</a>--}}
    </div>
    <!-- /.login-card-body -->
@endsection
