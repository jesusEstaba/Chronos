@extends('template.dashboard')
@section('subtitle', 'Partidas')
@section('activeId', 'partities')

@section('content')
	<h2 class="page-title">
		@yield('titlePrincipal', 'Partidas')
	</h2>

	@include('template.notification-messages')

	@yield('sub-content')
@stop