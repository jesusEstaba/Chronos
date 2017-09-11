@extends('template.dashboard')
@section('subtitle', 'Unidades')
@section('activeId', 'units')

@section('content')
	<h2 class="page-title">
		@yield('titlePrincipal', 'Unidades')
	</h2>

	@include('template.notification-messages')

	@yield('sub-content')
@stop