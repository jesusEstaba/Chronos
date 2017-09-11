@extends('template.dashboard')
@section('subtitle', 'Materiales')
@section('activeId', 'materials')

@section('content')
	<h2 class="page-title">
		@yield('titlePrincipal', 'Materiales')
	</h2>

	@include('template.notification-messages')

	@yield('sub-content')
@stop