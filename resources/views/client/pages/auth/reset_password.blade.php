<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $client->name_upper }}/Recuperación de Contraseña</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo.ico') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.css') }}">

    @yield('css')

    @yield('custom_css')
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"> <img src="{{ asset('assets/images/logo-login.png') }}" height="50%" class="img-fluid"
                    style="opacity: .8"></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <h5 class="text-right font-weight-bold">{{ $client->info }}</h5>
                <p class="login-box-msg">{{ __('messages.reset_password-title') }}</p>

                <form action="{{ getClientRoute('client.send_mail') }}" method="post">
                    @csrf

                    <!-- Email -->
                    <div class="form-group">
                        <label>{{ __('inputs.email') }}:</label>
                        <div class="input-group">
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="{{ __('inputs.email') }}" value="{{ old('email') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        @error('email')
                            <small class="text-danger">{!! $message !!}</small>
                        @enderror
                    </div>
                    <!-- Email -->

                    <button type="submit" class="btn btn-danger btn-block">{{ __('buttons.send') }}</button>
                </form>

                <p class="mb-1 mt-4">
                    <a href="{{ getClientRoute('client.login') }}" class="btn btn-sm btn-primary">Volver a Inicio de
                        Sesión</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

    @include('messages.alert')
</body>

</html>
