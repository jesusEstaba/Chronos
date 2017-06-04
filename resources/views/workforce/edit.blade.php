@extends('workforce.workforce')
@section('sub-title', 'Editar')

@section('sub-content')
	<div class="box">
		<div class="box-body">
			<form class="space-childs" method="post" action="/workforces/{{$workforce->id}}">
				{{csrf_field()}}
				<input name="_method" type="hidden" value="PUT">
				<input name="name" type="text" class="form-control" placeholder="Nombre del Cargo" autocomplete="off" value="{{$workforce->name}}" />
				<input type="submit" class="btn btn-outline-warning float-right" value="Actualizar" />
				<a class="btn btn-outline-secondary float-left" href="/workforces/{{$workforce->id}}">Atrás</a>
			</form>
		</div>
	</div>
@stop