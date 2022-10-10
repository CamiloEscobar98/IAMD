@extends('reports.app')

@section('content')
    @include('reports.intangible_assets.components.asset', ['intangibleAsset' => $intangibleAsset])
@endsection
