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
			<span class="pull-right badge badge-success" style="padding: 6px 32px" title="!Eres tú!">
				<i class="fa fa-eye fa-2x" aria-hidden="true"></i>
			</span>
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
@stop