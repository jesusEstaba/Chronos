@extends('template.dashboard')
@section('subtitle', 'Categorias')
@section('activeId', 'categories')

@section('content')
	<h2 class="page-title">
		@yield('titlePrincipal', 'Categorias')
	</h2>

	@include('template.notification-messages')

	@yield('sub-content')
@stop