@extends('workforce.workforce')
@section('sub-title', 'Crear')

@section('sub-content')
	<div class="box">
		<div class="box-body">
			<form class="space-childs" method="POST" action="/workforces">
				{{csrf_field()}}
				<input name="name" type="text" class="form-control" placeholder="Nombre del Cargo" autocomplete="off" />
				<input name="cost" type="text" class="form-control" placeholder="% del Salario Minimo" autocomplete="off" />
				<input type="submit" class="btn btn-outline-success float-right" value="Crear" />
			</form>
		</div>
	</div>
@stop