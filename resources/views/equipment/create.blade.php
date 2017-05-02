@extends('equipment.equipment')

@section('sub-content')
	<div class="box">
		<div class="box-body">
			<form class="space-childs" method="POST" action="/equipments">
				{{csrf_field()}}
				<input name="name" type="text" class="form-control" placeholder="Nombre" autocomplete="off" />
				<select class="form-control" name="category">
					@foreach($categories as $category)
					<option value="{{$category->id}}">{{$category->name}}</option>
					@endforeach
				</select>
				<input name="cost" type="text" class="form-control" placeholder="Precio" autocomplete="off" />
				<input type="submit" class="btn btn-outline-success float-right" value="Crear" />
			</form>
		</div>
	</div>
@stop