@extends('auth.layout.auth')

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Verificação de Email</p>

        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                <p>Um novo link de verificação foi enviado para o seu endereço de e-mail.</p>
            </div>
        @endif

        <p>Antes de continuar, é necessário verificar o seu Email!</p>
        <p>Se você não recebeu o email de verificação,</p>

        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Clique aqui para enviar novamente</button>.
        </form>

        <hr>

        <a href="{{ route('password.request') }}">Esqueceu sunha senha?</a>
    </div>
    <!-- /.login-card-body -->
@endsection
