@extends('client.client')
@section('sub-title', '')

@section('sub-content')

@section('titlePrincipal', $client->name)

@include('template.resources-buttons', ['name' => 'clients','resource'=> $client])

<div class="box">
	<div class="box-body">
		<p>
			<b>Nombre:</b> {{$client->name}}
		</p>
		<p>
			<b>RIF:</b> {{$client->rif}}
		</p>
		<p>
			<b>Teléfono:</b> {{$client->phone}}
		</p>
		<p>
			<b>Dirección:</b> {{$client->address}}
		</p>
	</div>
</div>

<div class="box">
	<div class="box-head">
		<h5>Lista de Proyectos</h5>
	</div>
	
	<div class="box-body">
	@if(count($clientProjects))
		<table class="table table-striped table-bordered">
			<thead>
				<th>Nombre</th>
				<th>Responsable</th>
			</thead>
			<tbody>
				@foreach($clientProjects as $project)
					<tr>
						<td><a href="/projects/{{$project->id}}">{{$project->name}}</a></td>
						<td><a href="/users/{{$project->userId}}">{{$project->user()->name}}</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{ $clientProjects->links('vendor.pagination.bootstrap-4') }}
		@else
			<p class="text-center">
				<em>
					No existen Proyectos asociados a {{$client->name}}
				</em>
			</p>
			
		@endif
	</div>

</div>
@stop