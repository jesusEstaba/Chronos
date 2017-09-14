@extends('user.user')
@section('sub-title', 'Editar')

@section('sub-content')
	<div class="box">
		<div class="box-body">
			<form class="space-childs" method="post" action="/users/{{$user->id}}">
				{{csrf_field()}}
				<input name="_method" type="hidden" value="PUT">
				
				<input name="name" value="{{$user->name}}" type="text" class="form-control" placeholder="Nombre" autocomplete="off" />
				<input name="email" value="{{$user->email}}" type="text" class="form-control" placeholder="Correo" autocomplete="off" readonly />
				<select name="rol" id="" class="form-control">
					<option value="">Rol</option>
					@if($user->rol)
						<option selected value="1">Administrador</option>
						<option value="0">Operador</option>
					@else
						<option value="1">Administrador</option>
						<option selected value="0">Operador</option>
					@endif
				</select>
				<input name="rif" value="{{$user->identificator}}" type="text" class="form-control" placeholder="CI/RIF" autocomplete="off" />
				<input name="phone" value="{{$user->phone}}" type="text" class="form-control" placeholder="Teléfono" autocomplete="off" />
				<textarea class="form-control" placeholder="Dirección" name="address">{{$user->address}}</textarea>

				<input type="submit" class="btn btn-outline-warning float-right" value="Actualizar" />
				<a class="btn btn-outline-secondary float-left" href="/users/{{$user->id}}">Atrás</a>
			</form>
		</div>
	</div>
@stop