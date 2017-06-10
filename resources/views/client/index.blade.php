@extends('client.client')
@section('sub-title', 'Inicio')

@section('sub-content')
<a href="/clients/create" class="btn btn-outline-success">Crear</a>

<div class="box">
	<div class="box-body">
		<form action="/clients" method="get">
			
			<p>
				<input type="text" name="search" placeholder="Buscar Clientes" class="form-control col-md-3 input-close-btn" />
				<input type="submit" class="btn btn-outline-primary" value="Buscar" />
			</p>
			
		</form>
		@if(count($clients))
			<table class="table table-striped table-bordered">
				<thead>
					<th>Nombre</th>
					<th>RIF</th>
				</thead>
				<tbody>
					@foreach($clients as $client)
					<tr>
						<td>
							<a href="/clients/{{$client->id}}">
								{{$client->name}}
							</a>
						</td>
						<td>
							{{$client->rif}}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $clients->appends(['search' => $search])->links('vendor.pagination.bootstrap-4') }}
		@else
			<h4 class="text-center text-muted my-4">No se encontrarón resultados</h4>
		@endif
	</div>
</div>
@stop