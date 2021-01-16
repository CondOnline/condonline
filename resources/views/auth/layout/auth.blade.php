<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CondOnline - Sistema para condomínios</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminlte_3.1.0-rc/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte_3.1.0-rc/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminlte_3.1.0-rc/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

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
            <b>{{ config('app.name') }} - Teste</b>
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
<script src="{{ asset('adminlte_3.1.0-rc/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte_3.1.0-rc/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte_3.1.0-rc/dist/js/adminlte.min.js') }}"></script>

<script>
    $(document).ready(function(){
        $("form").submit(function(event){
            $("button").attr('disabled', 'disabled');
            $("button").text("Aguarde...");
        });
    });
</script>

@yield('js')

</body>
</html>
