@extends('material.material')
@section('sub-title', '')

@section('sub-content')

@section('titlePrincipal', $material->name)

	<a href="/materials/{{$material->id}}/edit" class="btn btn-outline-warning">
		<i class="fa fa-pencil" aria-hidden="true"></i> Editar
	</a>

<p>
	<b>Category:</b> <a href="/categories/{{$material->category->id}}">{{$material->category->name}}</a> 
	<b>Unit:</b> <a href="/units/{{$material->unit->id}}">{{$material->unit->name}} </a>
	
</p>

<div class="box">
	<div class="box-head">
		<h5>Añadir Costo</h5>
	</div>
	<div class="box-body">
		<form action="/materialcosts" method="post">
			{{csrf_field()}}
			<input type="hidden" name="materialId" value="{{$material->id}}">
			<input type="text" placeholder="Nuevo Costo" class="form-control col-md-3 input-close-btn" name="cost" />
			<input type="submit" name="new-cost" class="btn btn-outline-success" value="Agregar" />
		</form>
	</div>
</div>

<div class="box">
	<div class="box-head">
		<h5>Lista de Costos</h5>
	</div>
	<div class="box-body">
		<table class="table table-striped table-bordered">
			<thead>
				<td>Costo</td>
				<td>Fecha</td>
			</thead>
			<tbody>
				@foreach($materialCosts as $cost)
				<tr>
					<td>{{$cost->cost}}</td>
					<td>{{$cost->created_at}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $materialCosts->links('vendor.pagination.bootstrap-4') }}
	</div>
</div>
@stop