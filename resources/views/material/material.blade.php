@extends('template.dashboard')
@section('subtitle', 'Materiales')
@section('activeId', 'materials')

@section('content')
	<div class="row">
		<div class="col-md-6">
			<h2 class="page-title">
			@yield('titlePrincipal', 'Materiales')
			</h2>
		</div>
		<div class="col-md-6">
			<p class="text-right active">
				/ @yield('sub-title')
			</p>
		</div>
		
	</div>

	@yield('sub-content')
@stop