@extends('template.dashboard')
@section('subtitle', 'Proyectos')
@section('activeId', 'projects')

@section('content')
	<h2 class="page-title">
		@yield('titlePrincipal', 'Proyectos')
	</h2>

	@include('template.notification-messages')

	@yield('sub-content')
@stop