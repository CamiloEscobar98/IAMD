@extends('admin.layout.app')

@section('title', __('pages.admin.profile.title'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.admin.profile.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.admin.home.title') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('pages.admin.profile.title') }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Profile Information -->
                <div class="card card-secondary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('adminlte/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ auth('admin')->user()->name }}</h3>

                        <p class="text-muted text-center">Administrador</p>

                        <form action="{{ route('admin.update-profile') }}" method="post">
                            @csrf
                            @method('PATCH')

                            <!-- Name -->
                            <div class="input-group mb-3">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="{{ __('inputs.name') }}" value="{{ auth('admin')->user()->name }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>

                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <!-- ./Name -->

                            <!-- Email -->
                            <div class="input-group mb-3">
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="{{ __('inputs.email') }}" value="{{ auth('admin')->user()->email }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>

                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <!-- ./Email -->

                            <button type="submit"
                                class="btn btn-secondary btn-block mt-3"><b>{{ __('buttons.update') }}</b></button>
                        </form>
                    </div>
                    <!-- ./Profile Information -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-4">
                <!-- Profile Password -->
                <div class="card card-secondary card-outline">
                    <div class="card-body box-profile">

                        <p class="text-muted text-center">Actualizar Contraseña</p>

                        <form action="{{ route('admin.update-password') }}" method="post">
                            @csrf
                            @method('PATCH')

                            <!-- Password -->
                            <div class="input-group mb-3">
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
                            <!-- ./Password -->

                            <!-- Repeat Password -->
                            <div class="input-group mb-3">
                                <input type="password" name="repeat_password"
                                    class="form-control @error('repeat_password') is-invalid @enderror"
                                    placeholder="{{ __('inputs.repeat_password') }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>

                            @error('repeat_password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <!-- ./Repeat Password -->

                            <button type="submit"
                                class="btn btn-secondary btn-block mt-3"><b>{{ __('buttons.update_password') }}</b></button>
                        </form>
                    </div>
                    <!-- ./Profile Password -->
                </div>
            </div>
        </div>
    @endsection
