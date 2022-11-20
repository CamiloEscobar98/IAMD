@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', 'EL USUARIO NO TIENE LOS PERMISOS NECESARIOS' ?: 'Forbidden')

@section('content')
    <button class="btn btn-danger">Regresar</button>
@endsection