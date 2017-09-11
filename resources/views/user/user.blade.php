@extends('template.dashboard')
@section('subtitle', 'Usuarios')
@section('activeId', 'users')

@section('content')
	<h2 class="page-title">
		@yield('titlePrincipal', 'Usuarios')
	</h2>

	@include('template.notification-messages')

	@yield('sub-content')
@stop