@extends('partitie.partitie')
@section('sub-title', 'Inicio')

@section('sub-content')
<a href="/partities/create" class="btn btn-outline-success">Crear</a>

<div class="box">
	<div class="box-body">
		<form action="/partities" method="get">
			
			<p>
				<input type="text" name="search" placeholder="Buscar Partida" class="form-control col-md-3 input-close-btn" />
				<input type="submit" class="btn btn-outline-primary" value="Buscar" />
			</p>
			
		</form>
		@if(count($partities))
			<table class="table table-striped table-bordered">
				<thead>
					<th>Nombre</th>
					<th>Costo</th>
				</thead>
				<tbody>
					@foreach($partities as $partitie)
					<tr>
						<td>
							<a href="/partities/{{$partitie->id}}">
								{{$partitie->name}}
							</a>
						</td>
						<td>0</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $partities->appends(['search' => $search])->links('vendor.pagination.bootstrap-4') }}
		@else
			<h4 class="text-center text-muted my-4">No se encontrarón resultados</h4>
		@endif
	</div>
</div>
@stop