@extends('client.client')
@section('sub-title', 'Crear')

@section('sub-content')
	<div class="box">
		<div class="box-body">
			<form class="space-childs" method="POST" action="/clients">
				{{csrf_field()}}
				<input name="name" type="text" class="form-control" placeholder="Nombre" autocomplete="off" />
				<input name="rif" type="text" class="form-control" placeholder="RIF" autocomplete="off" />
				<input name="phone" type="text" class="form-control" placeholder="Telefono" autocomplete="off" />
				<textarea class="form-control" placeholder="Dirección" name="address"></textarea>
				<input type="submit" class="btn btn-outline-success float-right" value="Crear" />
			</form>
		</div>
	</div>
@stop