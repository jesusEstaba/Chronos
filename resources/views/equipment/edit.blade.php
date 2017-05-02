@extends('equipment.equipment')

@section('sub-content')
	<div class="box">
		<div class="box-body">
			<form class="space-childs" method="post" action="/equipments/{{$equipment->id}}">
				{{csrf_field()}}
				<input name="_method" type="hidden" value="PUT">
				<input name="name" type="text" class="form-control" placeholder="Nombre" autocomplete="off" value="{{$equipment->name}}" />
				<select class="form-control" name="category">
					@foreach($categories as $category)
						@if($category->id == $equipment->category->id)
							<option selected="selected" value="{{$category->id}}">{{$category->name}}</option>
						@else
							<option value="{{$category->id}}">{{$category->name}}</option>
						@endif
					@endforeach
				</select>
				<input type="submit" class="btn btn-outline-warning float-right" value="Actualizar" />
				<a class="btn btn-outline-secondary float-left" href="/equipments/{{$equipment->id}}">Atrás</a>
			</form>
		</div>
	</div>
@stop