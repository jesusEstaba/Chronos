@extends('material.material')
@section('sub-title', '')

@section('sub-content')
	<div class="notifications">
		@if (session()->has('created'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			  <strong>Correcto</strong> Material Creado.
			</div>
		@endif
	</div>
	<br>
	<div>
		<a href="/materials/create" class="btn btn-outline-success">Crear</a>
	</div>
	<br>
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
					<td>{{$material->name}}</td>
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
@stop