@extends('workforce.workforce')
@section('sub-title', 'Inicio')

@section('sub-content')
<a href="/workforces/create" class="btn btn-outline-success">Crear</a>

<div class="box">
	<div class="box-body">
		<form action="/workforces" method="get">
			
			<p>
				<input type="text" name="search" placeholder="Buscar Mano de Obra" class="form-control col-md-3 input-close-btn" />
				<input type="submit" class="btn btn-outline-primary" value="Buscar" />
			</p>
			
		</form>
		@if(count($workforces))
			<table class="table table-striped table-bordered">
				<thead>
					<th>Cargo</th>
					<th>% Salario Minimo</th>
				</thead>
				<tbody>
					@foreach($workforces as $workforce)
					<tr>
						<td>
							<a href="/workforces/{{$workforce->id}}">
								{{$workforce->name}}
							</a>
						</td>
						<td>{{ number_format($workforce->lastCost(),2)}}%</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $workforces->appends(['search' => $search])->links('vendor.pagination.bootstrap-4') }}
		@else
			<h4 class="text-center text-muted my-4">No se encontrarón resultados</h4>
		@endif
	</div>
</div>
@stop