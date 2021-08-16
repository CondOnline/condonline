<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CondOnline - Sistema para condomínios</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">

    <!-- Favicon -->
    @laravelPWA

    <!-- Meta Tags -->
    <meta name="robots" content="noindex" />
    <meta name="Googlebot" content="noindex" />

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ route('index') }}">
            <img src="{{ asset('assets/img/CondOnlineLogo.png') }}" height="50">
            <b>{{ config('app.name') }}</b>
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="card text-center">
        <h1>Ops!!</h1>
        <h3>Tivemos um problema ao acessar o servidor.</h3>
        <h6>Por favor, verifique sua conexão!</h6>
    </div>
</div>
<!-- /.login-box -->

<!-- REQUIRED SCRIPTS -->

<script src="{{ asset(mix('js/app.js')) }}"></script>

</body>
</html>
