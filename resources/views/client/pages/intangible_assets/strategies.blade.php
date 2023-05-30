@extends('client.layout.app')

@section('title', __('pages.client.intangible_assets.route-titles.show'))

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.intangible_assets.strategies.title') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.intangible_assets.index', $client->name) }}">
                                {{ __('pages.client.intangible_assets.title') }} </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.intangible_assets.show', [$client->name, $item->id]) }}">
                                {{ $item->name }} </a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('pages.client.intangible_assets.strategies.title') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="container-fluid">
        @foreach ($strategyCategories as $strategyCategory)
            <div class="card">
                <div class="card-header bg-gradient-danger">
                    <h3>{{ $strategyCategory->name }}</h3>
                </div>
                <div class="card-body">

                    <!-- Create Intangible Asset Strategy -->
                    @if (role_can_permission('intangible_assets.strategies.store'))
                        <form action="{{ route('client.intangible_assets.strategies.store', [$client->name, $item->id]) }}"
                            method="post">
                            @csrf

                            <input type="hidden" name="strategy_category_id" value="{{ $strategyCategory->id }}">

                            <!-- Strategies -->
                            <div class="form-group">
                                <label>{{ __('pages.client.intangible_assets.strategies.form.strategies') }}</label>
                                <select name="strategy_id" class="form-control form-control-sm select2bs4">
                                    @foreach ($strategies as $strategy)
                                        <option value="{{ $strategy->id }}">{{ $strategy->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Strategies -->

                            <!-- Users -->
                            <div class="form-group">
                                <label>{{ __('pages.client.intangible_assets.strategies.form.users') }}</label>
                                <select name="user_id" class="form-control form-control-sm select2bs4">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Users -->

                            <!-- Button Save -->
                            <div class="form-group">
                                <button class="btn btn-danger btn-sm">{{ __('buttons.add') }}</button>
                            </div>
                            <!-- ./Button Save -->

                        </form>
                    @endif
                    <!-- ./Create Intangible Asset Strategy -->

                    @if (intangibleAssetHasStrategyByStrategyCategory($item, $strategyCategory->id))
                        <div class="form-group">
                            <button class="collapsed btn btn-outline-danger" data-toggle="collapse"
                                href="#collapse_{{ $strategyCategory->id }}_list">{{ __('pages.client.intangible_assets.strategies.buttons.list') }}</button>
                        </div>


                        <!-- Intangible Asset  Strategies List -->
                        <div id="collapse_{{ $strategyCategory->id }}_list" class="collapse">
                            <ul class="list-group">
                                @foreach ($item->strategies as $strategy)
                                    @if (intangibleAssetHasStrategy($strategy, $strategyCategory->id))
                                        <li class="list-group-item text-center">
                                            <div class="float-left">
                                                <span
                                                    class="font-weight-bold">{{ __('pages.client.intangible_assets.strategies.list.strategy') }}
                                                </span>{{ $strategy->strategy->name }}
                                            </div>
                                            <div class="float-center">
                                                <span
                                                    class="font-weight-bold">{{ __('pages.client.intangible_assets.strategies.list.user') }}
                                                </span>{{ $strategy->user->name }}
                                            </div>
                                            <form
                                                action="{{ route('client.intangible_assets.strategies.destroy', [$client->name, $item->id, $strategy->id]) }}"
                                                method="post" id="form-delete-{{ $strategy->id }}">

                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-sm btn-danger float-right"
                                                    onclick="destroy(event, {{ $strategy->id }})">
                                                    <i class="fas fa-sm fa-trash"></i>
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <!-- Intangible Asset  Strategies List -->
                    @else
                        <p>No tiene Estrategias de Gestión asociadas...</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection

@section('custom_js')
    <script src="{{ asset('adminlte/dist/js/iamd/intangible_asset_levels.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/iamd/intangible_asset_phases.js') }}"></script>

    @include('messages.delete_item', [
        'title' => __('pages.client.intangible_assets.strategies.messages.confirm'),
    ])

    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
