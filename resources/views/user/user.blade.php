@extends('template.dashboard')
@section('subtitle', 'Usuarios')
@section('activeId', 'users')

@section('content')
	<h2 class="page-title">
		@yield('titlePrincipal', 'Usuarios')
	</h2>

	<div class="notifications">
		@if (session()->has('success'))
			@include(
				'template.alert-success', 
				['state' => 'Correcto', 'message'=> session()->get('success')]
			)
		@endif
	</div>

	@yield('sub-content')
@stop