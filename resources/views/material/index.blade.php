@extends('material.material')
@section('sub-title', 'Inicio')

@section('sub-content')
	<div class="notifications">
		@if (session()->has('created'))
			@include('template.alert-success', ['state' => 'Correcto', 'message'=> 'Material Creado.'])
		@endif
	</div>
	<br>
	<div>
		<a href="/materials/create" class="btn btn-outline-success">Crear</a>
	</div>

<div class="box">
	<div class="box-body">
		<form action="/materials" method="get">
			
			<p>
				<input type="text" name="search" placeholder="Buscar Material" class="form-control col-md-3 input-close-btn" />
				<input type="submit" class="btn btn-outline-primary" value="Buscar" />
			</p>
			
		</form>
		<table class="table table-striped table-bordered">
			<thead>
				<td>Nombre</td>
				<td>Categoria</td>
				<td>Unidad</td>
				<td>Costo</td>
				<td>Editar</td>
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
					<td>{{ $material->lastCost()}}</td>
					<td>
						<a href="/materials/{{$material->id}}/edit" class="btn btn-outline-warning">
							<i class="fa fa-pencil" aria-hidden="true"></i>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $materials->appends(['search' => $search])->links('vendor.pagination.bootstrap-4') }}
	</div>
</div>
@stop