<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo.ico') }}">

    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/alt/adminlte.light.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/report.css') }}">
    @yield('css')

    <title>Reporte Individual del Activo Intangible</title>
</head>

<body>

    @if ($client == 'ufpso')
        <!-- Logo UFPSO -->
        <div class="row justify-content-start">
            <img src="{{ asset('assets/images/LogoufpsoMen17.png') }}" class="img-fluid" width="250em">
        </div>
        <!-- ./Logo UFPSO -->
    @else
        <!-- Logo UFPS -->
        <div class="row justify-content-start">
            <img src="{{ asset('assets/images/Logoufpsc.jpg') }}" class="img-fluid" width="250em">
        </div>
        <!-- ./Logo UFPS -->
    @endif




    @yield('content')

    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/overlayScrollbars/js/OverlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

    @yield('js')

    @yield('custom_js')

</body>

</html>
