@extends('material.material')
@section('sub-title', 'Crear')

@section('sub-content')
	<div class="box">
		<div class="box-body">
			<form class="space-childs" method="POST" action="/materials">
				{{csrf_field()}}
				<input value="{{old('name')}}" name="name" type="text" class="form-control" placeholder="Nombre" autocomplete="off" />
				<div class="input-group">
					<input value="{{old('junk')}}" name="junk" type="text" class="form-control" placeholder="Desperdicio" autocomplete="off" />
					<div class="input-group-addon">%</div>
				</div>
				<select class="form-control" name="unit">
					@foreach($units as $unit)
						<option value="{{$unit->id}}"
							@if($unit->id == old('unit'))
								selected 
							@endif
						>
							{{$unit->name}}
						</option>
					@endforeach
				</select>
				<select class="form-control" name="category">
					@foreach($categories as $category)
						<option value="{{$category->id}}"
							@if($category->id == old('category'))
								selected 
							@endif
						>
							{{$category->name}}
						</option>
					@endforeach
				</select>
				<input value="{{old('cost')}}" name="cost" type="text" class="form-control" placeholder="Precio" autocomplete="off" />
				<input type="submit" class="btn btn-outline-success float-right" value="Crear" />
			</form>
		</div>
	</div>
@stop