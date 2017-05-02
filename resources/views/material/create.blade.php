@extends('material.material')
@section('sub-title', 'Crear')

@section('sub-content')
	<form class="space-childs" method="POST" action="/materials">
		{{csrf_field()}}
		<input name="name" type="text" class="form-control" placeholder="Nombre" autocomplete="off" />
		<select class="form-control" name="unit">
			@foreach($units as $unit)
				<option value="{{$unit->id}}">{{$unit->name}}</option>
			@endforeach
		</select>
		<select class="form-control" name="category">
			@foreach($categories as $category)
				<option value="{{$category->id}}">{{$category->name}}</option>
			@endforeach
		</select>
		<input name="cost" type="text" class="form-control" placeholder="Precio" autocomplete="off" />
		<input type="submit" class="btn btn-outline-success float-right" value="Crear" />
	</form>
@stop