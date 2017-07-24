@extends('material.material')
@section('sub-title', 'Inicio')

@section('sub-content')
<a href="/materials/create" class="btn btn-outline-success">Crear</a>

<div class="box">
	<div class="box-body">
		<form action="/materials" method="get">
			
			<p>
				<input type="text" name="search" placeholder="Buscar Material" class="form-control col-md-3 input-close-btn" />
				<input type="submit" class="btn btn-outline-primary" value="Buscar" />
			</p>
			
		</form>
		@if(count($materials))
			<table class="table table-striped table-bordered">
				<thead>
					<th>Nombre</th>
					<th>Categoria</th>
					<th>Unidad</th>
					<th>Costo</th>
				</thead>
				<tbody>
					@foreach($materials as $material)
					<tr>
						<td>
							<a href="/materials/{{$material->id}}">
								{{$material->name}}
							</a>
						</td>
						<td>
							{{$material->category->name}}
						</td>
						<td>
							{{$material->unit->name}}
						</td>
						<td>{{number_format($material->lastCost(),2)}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $materials->appends(['search' => $search])->links('vendor.pagination.bootstrap-4') }}
		@else
			<h4 class="text-center text-muted my-4">No se encontrarón resultados</h4>
		@endif
	</div>
</div>
@stop