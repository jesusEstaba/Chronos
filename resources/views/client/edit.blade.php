@extends('client.client')
@section('sub-title', 'Editar')

@section('sub-content')
	<div class="box">
		<div class="box-body">
			<form class="space-childs" method="post" action="/clients/{{$client->id}}">
				{{csrf_field()}}
				<input name="_method" type="hidden" value="PUT">
				
				<input name="name" value="{{$client->name}}" type="text" class="form-control" placeholder="Nombre" autocomplete="off" />
				<input name="rif" value="{{$client->rif}}" type="text" class="form-control" placeholder="RIF" autocomplete="off" />
				<input name="phone" value="{{$client->phone}}" type="text" class="form-control" placeholder="Teléfono" autocomplete="off" />
				<textarea class="form-control" placeholder="Dirección" name="address">{{$client->address}}</textarea>

				<input type="submit" class="btn btn-outline-warning float-right" value="Actualizar" />
				<a class="btn btn-outline-secondary float-left" href="/clients/{{$client->id}}">Atrás</a>
			</form>
		</div>
	</div>
@stop