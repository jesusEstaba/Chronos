@extends('user.user')
@section('sub-title', 'Crear')

@section('sub-content')
	<div class="box">
		<div class="box-body">
			<form autocomplete="false" class="space-childs" method="POST" action="/users">
				{{csrf_field()}}
				
				<input name="name" type="text" class="form-control" placeholder="Nombre" autocomplete="off" />
				
				<input name="email" type="email" class="form-control" placeholder="Correo" value="" />
				
				<input name="password" type="password" class="form-control" placeholder="Contraseña" autocomplete="new-password" value="" />

				

				<select name="rol" id="" class="form-control">
					<option value="">Rol</option>
					<option value="1">Administrador</option>
					<option value="0">Operador</option>
				</select>
				<select name="state" id="" class="form-control">
					<option value="">Estado</option>
					<option value="1">Activado</option>
					<option value="0">Desactivado</option>
				</select>
				<input name="rif"  type="text" class="form-control" placeholder="CI/RIF" autocomplete="off" />
				<input name="phone" type="text" class="form-control" placeholder="Telefono" autocomplete="off" />
				<textarea name="address" class="form-control" placeholder="Dirección" ></textarea>
				<input type="submit" class="btn btn-outline-success float-right" value="Crear" />
			</form>
		</div>
	</div>
@stop