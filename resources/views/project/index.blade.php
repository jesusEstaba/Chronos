@extends('project.project')
@section('sub-title', 'Inicio')

@section('sub-content')
<a href="/projects/create" class="btn btn-outline-success">Crear</a>

<div class="box">
	<div class="box-body">
		<form action="/projects" method="get">
			
			<p>
				<input type="text" name="search" placeholder="Buscar Proyecto" class="form-control col-md-3 input-close-btn" />
				<input type="submit" class="btn btn-outline-primary" value="Buscar" />
			</p>
			
		</form>
		@if(count($projects))
			<table class="table table-striped table-bordered">
				<thead>
					<th>Nombre</th>
					<th>Cliente</th>
					<th>Estado</th>
					<th>Creación</th>
					<th>Costo</th>
				</thead>
				<tbody>
					@foreach($projects as $project)
					<tr>
						<td>
							<a href="/projects/{{$project->id}}">
								{{$project->name}}
							</a>
						</td>
						<td>
							{{Repo\Client::find($project->clientId)->name}}
						</td>
						<td>
							<?php
								if ($project->stateId == 2) {
									$color = 'primary';
								} elseif ($project->stateId == 3) {
									$color = 'warning';
								}else {
									$color = 'default';
								}
							?>
							<span class="badge badge-{{$color}}">

							{{Repo\State::find($project->stateId)->name}}
							</span>
						</td>
						<td>
							{{$project->created_at}}
						</td>
						<td></td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $projects->appends(['search' => $search])->links('vendor.pagination.bootstrap-4') }}
		@else
			<h4 class="text-center text-muted my-4">No se encontrarón resultados</h4>
		@endif
	</div>
</div>
@stop