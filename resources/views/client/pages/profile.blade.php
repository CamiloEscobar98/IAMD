@extends('client.layout.app')

@section('title', __('pages.default.profile'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.profile.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">{{ __('pages.default.profile') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-danger">
                        <h4 class="font-weight-bold">{{ __('pages.client.profile.form-titles.show') }}</h4>
                    </div>
                    <div class="card-body">
                        <!-- Name -->
                        <div class="form-group mt-3">
                            <label>{{ __('inputs.name') }}:</label>
                            <div class="input-group">
                                <input type="text" name="name"
                                    class="form-control {{ isInvalidByError($errors, 'name') }}"
                                    placeholder="{{ __('inputs.name') }}" value="{{ $item->name }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>

                            @error('name')
                                <small class="text-danger">{!! $message !!}</small>
                            @enderror
                        </div>
                        <!-- ./Name -->

                        <!-- Email -->
                        <div class="form-group mt-3">
                            <label>{{ __('inputs.email') }}:</label>
                            <div class="input-group">
                                <input type="email" name="email"
                                    class="form-control {{ isInvalidByError($errors, 'email') }}"
                                    placeholder="{{ __('inputs.email') }}" value="{{ $item->email }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-at"></span>
                                    </div>
                                </div>
                            </div>

                            @error('email')
                                <small class="text-danger">{!! $message !!}</small>
                            @enderror
                        </div>
                        <!-- ./Email -->

                        <div class="form-group mt-3">
                            <button class="btn btn-danger btn-sm">{{ __('buttons.update') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-danger">
                        <h4 class="font-weight-bold">{{ __('pages.client.profile.form-titles.password') }}</h4>
                    </div>
                    <div class="card-body">
                        <!-- Password -->
                        <div class="form-group mt-3">
                            <label>{{ __('inputs.password') }}:</label>
                            <div class="input-group">
                                <input type="password" name="password"
                                    class="form-control {{ isInvalidByError($errors, 'password') }}"
                                    placeholder="{{ __('inputs.password') }}" value="{{ old('password') }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-key"></span>
                                    </div>
                                </div>
                            </div>

                            @error('password')
                                <small class="text-danger">{!! $message !!}</small>
                            @enderror
                        </div>
                        <!-- ./Password -->

                        <!-- Repeat Password -->
                        <div class="form-group mt-3">
                            <label>{{ __('inputs.repeat_password') }}:</label>
                            <div class="input-group">
                                <input type="password" name="repeat_password"
                                    class="form-control {{ isInvalidByError($errors, 'repeat_password') }}"
                                    placeholder="{{ __('inputs.repeat_password') }}" value="{{ $item->repeat_password }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-key"></span>
                                    </div>
                                </div>
                            </div>

                            @error('repeat_password')
                                <small class="text-danger">{!! $message !!}</small>
                            @enderror
                        </div>
                        <!-- ./Repeat Password -->

                        <div class="form-group mt-3">
                            <button class="btn btn-danger btn-sm">{{ __('buttons.update') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
