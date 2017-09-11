@extends('template.dashboard')
@section('subtitle', 'Clientes')
@section('activeId', 'clients')

@section('content')
	<h2 class="page-title">
		@yield('titlePrincipal', 'Clientes')
	</h2>

	@include('template.notification-messages')

	@yield('sub-content')
@stop