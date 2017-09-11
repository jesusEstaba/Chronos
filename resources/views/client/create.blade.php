@extends('client.client')
@section('sub-title', 'Crear')

@section('sub-content')
	<div class="box">
		<div class="box-body">
			<form class="space-childs" method="POST" action="/clients">
				{{csrf_field()}}
				<input name="name" value="{{old('name')}}" type="text" class="form-control" placeholder="Nombre" autocomplete="off" />
				<input name="rif" value="{{old('rif')}}" type="text" class="form-control" placeholder="RIF" autocomplete="off" />
				<input name="phone" value="{{old('phone')}}" type="text" class="form-control" placeholder="Teléfono" autocomplete="off" />
				<textarea class="form-control" placeholder="Dirección" name="address">{{old('address')}}</textarea>
				<input type="submit" class="btn btn-outline-success float-right" value="Crear" />
			</form>
		</div>
	</div>
@stop