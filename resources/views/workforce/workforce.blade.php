@extends('template.dashboard')
@section('subtitle', 'Mano de Obra')
@section('activeId', 'workforce')

@section('content')
	<h2 class="page-title">
		@yield('titlePrincipal', 'Mano de Obra')
	</h2>

	@include('template.notification-messages')

	@yield('sub-content')
@stop