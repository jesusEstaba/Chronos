@extends('user.user')
@section('sub-title', 'Inicio')

@section('sub-content')
<a href="/users/create" class="btn btn-outline-success">Crear</a>

<div class="box">
	<div class="box-body">
		<form action="/users" method="get">
			
			<p>
				<input type="text" name="search" placeholder="Buscar Usuarios" class="form-control col-md-3 input-close-btn" />
				<input type="submit" class="btn btn-outline-primary" value="Buscar" />
			</p>
			
		</form>
		@if(count($users))
			<table class="table table-striped table-bordered">
				<thead>
					<th>Nombre</th>
					<th>Email</th>
					<th>Rol</th>
					<th>Estado</th>
				</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<td>
							<a href="/users/{{$user->id}}">
								{{$user->name}}
							</a>
						</td>
						<td>
							{{$user->email}}
						</td>
						<td>
							
							@if($user->rol == 0)
								Operador
							@else
								Administrador
							@endif
						</td>
						<td>
							@if($user->state)
								<span class="badge badge-success">activado</span>
							@else
								<span class="badge badge-default">desactivado</span>
							@endif
							
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $users->appends(['search' => $search])->links('vendor.pagination.bootstrap-4') }}
		@else
			<h4 class="text-center text-muted my-4">No se encontrarón resultados</h4>
		@endif
	</div>
</div>
@stop