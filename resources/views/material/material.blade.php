@extends('template.dashboard')
@section('subtitle', 'Materiales')
@section('activeId', 'materials')

@section('content')
	<h2 class="page-title">
		@yield('titlePrincipal', 'Materiales')
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