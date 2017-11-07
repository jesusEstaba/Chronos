@extends('template.dashboard')
@section('subtitle', 'Configuración')
@section('activeId', 'configuration')

@section('content')
	<h2 class="page-title">
		@yield('titlePrincipal', 'Configuración')
	</h2>

	@include('template.notification-messages')

	@yield('sub-content')
@stop