@extends('template.dashboard')
@section('subtitle', 'Equipos')
@section('activeId', 'equipment')

@section('content')
	<h2 class="page-title">
		@yield('titlePrincipal', 'Equipos')
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