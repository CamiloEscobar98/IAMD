<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $client->name_upper }}/Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

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
                <h2 class="text-right font-weight-bold">{{ $client->name_upper }}</h2>
                <p class="login-box-msg">{{ __('messages.login-title') }}</p>

                <form action="{{ route('client.loggin', $client->name) }}" method="post">
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
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- Email -->

                    <!-- Password -->
                    <div class="form-group mt-3">
                        <label>{{ __('inputs.password') }}:</label>
                        <div class="input-group">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="{{ __('inputs.password') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- ./Password -->

                    <!-- Role -->
                    <div class="form-group mt-3">
                        <label>{{ __('inputs.role_id') }}:</label>
                        <div class="input-group">
                            <select name="role_id"
                                class="form-control select2bs4 @error('role_id') is-invalid @enderror">
                                @foreach ($roles as $role => $value)
                                    <option value="{{ $role }}"
                                        {{ twoOptionsIsEqual(old('role_id'), $role) }}>
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-box"></span>
                                </div>
                            </div>
                        </div>

                        @error('role_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- ./Role -->

                    <div class="row mt-3">
                        <div class="col-7">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    {{ __('inputs.remember_me') }}
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-5">
                            <button type="submit"
                                class="btn btn-primary btn-block">{{ __('buttons.loggin') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                @if (Route::has('admin.reset_password'))
                    <p class="mb-1">
                        <a href="forgot-password.html">I forgot my password</a>
                    </p>
                @endif

                @if (Route::has('admin.register'))
                    <p class="mb-0">
                        <a href="register.html" class="text-center">Register a new membership</a>
                    </p>
                @endif
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
</body>

</html>
