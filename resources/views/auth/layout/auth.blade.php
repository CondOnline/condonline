<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CondOnline - Sistema para condomínios</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    {{--<link rel="manifest" href="{{ asset('assets/img/favicon/manifest.json') }}">--}}
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}">
    <meta name="theme-color" content="#ffffff">
    <meta name="application-name" content="CondOnline - Sistema para condomínios">

    <!-- Open Graph -->
    <meta property="og:title" content="CondOnline" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Sistema para condomínios." />
    <meta property="og:image" content="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}" />
    <meta property="og:url" content="{{ config('app.url') }}" />

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:url" content="{{ config('app.url') }}" />
    <meta name="twitter:title" content="CondOnline" />
    <meta property="twitter:description" content="Sistema para condomínios." />
    <meta name="twitter:image" content="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}" />

    <!-- Meta Tags -->
    <meta name="robots" content="noindex" />
    <meta name="Googlebot" content="noindex" />

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html">
            <img src="{{ asset('adminlte/dist/img/CondOnlineLogo.png') }}" height="50">
            <b>{{ config('app.name') }}</b>
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        @yield('content')
    </div>
</div>
<!-- /.login-box -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

@yield('js')

</body>
</html>
