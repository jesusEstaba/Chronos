@extends('template.dashboard')
@section('subtitle', 'Mano de Obra')
@section('activeId', 'workforce')

@section('content')
	<h2 class="page-title">
		@yield('titlePrincipal', 'Mano de Obra')
	</h2>

	<div class="notifications">
		@if (session()->has('success'))
			@include(
				'template.alert-success', 
				['state' => 'Correcto', 'message'=> session()->get('success')]
			)
		@endif
		@include('template.validation')
	</div>

	@yield('sub-content')
@stop