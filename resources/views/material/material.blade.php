@extends('template.dashboard')
@section('subtitle', 'Materiales')
@section('activeId', 'materials')

@section('content')
	<h2 style="margin-top: 1em;">Materiales @yield('sub-title')</h2>
	@yield('sub-content')
@stop