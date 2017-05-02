@extends('equipment.equipment')

@section('sub-content')
<a href="/equipments/create" class="btn btn-outline-success">Crear</a>

<div class="box">
	<div class="box-body">
		<form action="/equipments" method="get">
			
			<p>
				<input type="text" name="search" placeholder="Buscar Equipo" class="form-control col-md-3 input-close-btn" />
				<input type="submit" class="btn btn-outline-primary" value="Buscar" />
			</p>
			
		</form>
		@if(count($equipments))
			<table class="table table-striped table-bordered">
				<thead>
					<td>Nombre</td>
					<td>Categoria</td>
					<td>Costo</td>
				</thead>
				<tbody>
					@foreach($equipments as $equipment)
					<tr>
						<td>
							<a href="/equipments/{{$equipment->id}}">
								{{$equipment->name}}
							</a>
						</td>
						<td>
							{{$equipment->category->name}}
						</td>
						<td>{{ $equipment->lastCost()}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $equipments->appends(['search' => $search])->links('vendor.pagination.bootstrap-4') }}
		@else
			<h4 class="text-center text-muted my-4">No se encontrarón resultados</h4>
		@endif
	</div>
</div>
@stop