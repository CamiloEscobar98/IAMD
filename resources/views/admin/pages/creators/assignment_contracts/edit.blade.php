@extends('admin.layout.app')

@section('title', __('pages.admin.creators.assignment_contracts.route-titles.edit'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.admin.creators.assignment_contracts.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ __('pages.admin.creators.title') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.creators.assignment_contracts.index') }}">
                                {{ __('pages.admin.creators.assignment_contracts.title') }} </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.creators.assignment_contracts.show', $item->id) }}">
                                {{ $item->slug }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="container-fluid">
        <h3 class="font-weight-bold"><u>{{ __('pages.default.title-information') }}</u></h3>
        <p>{!! __('pages.admin.creators.assignment_contracts.info.edit', ['assignment_contract' => $item->name]) !!}</p>

        <div class="card">
            <div class="card-header bg-danger">
                <h5 class="font-weight-bold">{{ __('pages.admin.creators.assignment_contracts.form-titles.create') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.creators.assignment_contracts.store') }}" method="post">
                    @csrf

                    @include('admin.pages.creators.assignment_contracts.components.form')

                    <div class="form-group mt-3">
                        <button class="btn btn-danger btn-sm">{{ __('buttons.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
