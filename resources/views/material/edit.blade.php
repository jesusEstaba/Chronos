@extends('material.material')
@section('sub-title', 'Editar')

@section('sub-content')
	<div class="notifications">
		@if (session()->has('updated'))
			@include('template.alert-success', ['state' => 'Correcto', 'message'=> 'Material Actualizado.'])
		@endif
	</div>
	<div class="box">
		<div class="box-body">
			<form class="space-childs" method="post" action="/materials/{{$material->id}}">
				{{csrf_field()}}
				<input name="_method" type="hidden" value="PUT">
				<input name="name" type="text" class="form-control" placeholder="Nombre" autocomplete="off" value="{{$material->name}}" />
				<select class="form-control" name="unit">
					@foreach($units as $unit)
						@if($unit->id == $material->unit->id)
							<option selected="selected" value="{{$unit->id}}">{{$unit->name}}</option>
						@else
							<option value="{{$unit->id}}">{{$unit->name}}</option>
						@endif
						
					@endforeach
				</select>
				<select class="form-control" name="category">
					@foreach($categories as $category)
						@if($category->id == $material->category->id)
							<option selected="selected" value="{{$category->id}}">{{$category->name}}</option>
						@else
							<option value="{{$category->id}}">{{$category->name}}</option>
						@endif
					@endforeach
				</select>
				<input type="submit" class="btn btn-outline-warning float-right" value="Actualizar" />
			</form>
		</div>
	</div>
@stop