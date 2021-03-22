@extends('auth.layout.auth')

@section('content')
    <div class="card-body login-card-body">
        @if (!$recovery)
            <p class="login-box-msg">Confirme o acesso à sua conta inserindo o código de autenticação fornecido pelo seu aplicativo Google Authenticator.</p>
        @else
            <p class="login-box-msg">Confirme o acesso à sua conta inserindo um dos seus códigos de recuperação de emergência.</p>
        @endif

        <form action="{{ url('/two-factor-challenge') }}" method="post">
            @csrf
            @if (!$recovery)
                <div class="input-group mb-3">
                    <input id="code" type="text" class="form-control border" name="code" required autocomplete="Código" placeholder="Código">
                </div>
            @else
                <div class="input-group mb-3">
                    <input id="recovery_code" type="text" class="form-control border" name="recovery_code" required autocomplete="Código de Recuperação" placeholder="Código de Recuperação">
                </div>
            @endif
            <div class="row">
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <hr>

        @if (!$recovery)
            <a href="{{ route('two-factor.login', ['recovery' => true]) }}">Usar código de recuperação</a>
        @else
            <a href="{{ route('two-factor.login') }}">Usar código de autenticação</a>
        @endif
    </div>
    <!-- /.login-card-body -->
@endsection
