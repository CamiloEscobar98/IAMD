@extends('reports.app')

@section('content')
    @foreach ($intangibleAssets as $intangibleAsset)
        @include('reports.intangible_assets.components.asset', ['intangibleAsset' => $intangibleAsset])
    @endforeach
@endsection
