@extends('user.user')
@section('sub-title', 'Crear')

@section('sub-content')
	<div class="box">
		<div class="box-body">
			<form autocomplete="off" class="space-childs" method="POST" action="/users/password/change">
				{{csrf_field()}}
				<label for="">Contraseña Actual</label>
				<input name="oldpassword" type="password" class="form-control" placeholder="Contraseña" />
                <label for="">Nueva Contraseña</label>
				<input name="password" type="password" class="form-control" placeholder="Nueva Contraseña" />
                <label for="">Repetir Nueva Contraseña</label>
				<input name="password_confirmation" type="password" class="form-control" placeholder="Repetir Nueva Contraseña" />
				
                <input type="submit" class="btn btn-outline-warning float-right" value="Cambiar" />
			</form>
		</div>
	</div>
@stop