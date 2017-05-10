@extends('template.dashboard')
@section('subtitle', 'Partidas')
@section('activeId', 'partities')

@section('content')
	<h2 class="page-title">
		@yield('titlePrincipal', 'Partidas')
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