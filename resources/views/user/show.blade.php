@extends('user.user')
@section('sub-title', '')

@section('sub-content')

@section('titlePrincipal', $user->name)

<div class="box">
	<div class="box-body">
		<a href="/users/{{$user->id}}/edit" class="btn btn-outline-warning">
			<i class="fa fa-pencil" aria-hidden="true"></i> Editar
		</a>

		
		
		@if($user->id != Auth::user()->id)
			<a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-outline-danger">
				<i class="fa fa-key" aria-hidden="true"></i> Restablecer Contraseña
			</a>
			@if(!$user->state)
				<a href="/users/{{$user->id}}/enabled" class="btn btn-outline-info pull-right">
					<i class="fa fa-eye" aria-hidden="true"></i> Activar
				</a>
			@else
				<a href="/users/{{$user->id}}/disabled" class="btn btn-outline-secondary pull-right">
					<i class="fa fa-eye-slash" aria-hidden="true"></i> Desactivar
				</a>
			@endif
		@else
			<a href="/users/password/change" class="btn btn-outline-info">
				<i class="fa fa-key" aria-hidden="true"></i> Cambiar Contraseña
			</a>
		@endif
	</div>
</div>

@if($user->rol)
<h4 class="text-center"><em>Administrador</em></h4>
@endif
<div class="box">
	<div class="box-body">
		<p>
			<b>Nombre:</b> {{$user->name}}
		</p>
		<p>
			<b>Correo:</b> <a href="mailto:{{$user->email}}">{{$user->email}}</a>
		</p>
		<p>
			<b>RIF:</b> {{$user->identificator}}
		</p>
		<p>
			<b>Teléfono:</b> {{$user->phone}}
		</p>
		<p>
			<b>Dirección:</b> {{$user->address}}
		</p>
	</div>
</div>

<div class="box">
	<div class="box-head">
		<h5>Lista de Proyectos</h5>
	</div>
	
	<div class="box-body">
	@if(count($userProjects))
		<table class="table table-striped table-bordered">
			<thead>
				<th>Nombre</th>
				<th>Responsable</th>
			</thead>
			<tbody>
				@foreach($userProjects as $project)
					<tr>
						<td><a href="/projects/{{$project->id}}">{{$project->name}}</a></td>
						<td><a href="/users/{{$project->userId}}">{{$project->user()->name}}</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{ $userProjects->links('vendor.pagination.bootstrap-4') }}
		@else
			<p class="text-center">
				<em>
					No existen Proyectos asociados a {{$user->name}}
				</em>
			</p>
			
		@endif
	</div>

</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Restablecer Contraseña</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>
							¿Realmente desea restablecer la contraseña de {{$user->name}}?<br>
							<small>Ahora el usuario solo tendria acceso con la nueva clave a generar.</small>
						</p>
					</div>
					<div class="modal-footer">
						<a href="/users/{{$user->id}}/password/reset" class="btn btn-outline-danger">Restablecer</a>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
@stop