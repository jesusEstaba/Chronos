@extends('material.material')
@section('sub-title', '')

@section('sub-content')

@section('titlePrincipal', $material->name)

@include('template.resources-buttons', ['name' => 'materials','resource'=> $material])

<div class="box">
	<div class="box-body">
		<p style="margin: 0;">
			<b>Categoria:</b> {{$material->category->name}}<br> 
			<b>Unidad:</b> {{$material->unit->name}} <br> 
			<b>Porcentaje de Desperdicio:</b> {{$material->junk}}%
		</p>
	</div>
</div>

<div class="box">
	<div class="box-body">
		<h5>Añadir Costo</h5>
		<form action="/materialcosts" method="post">
			{{csrf_field()}}
			<input type="hidden" name="materialId" value="{{$material->id}}">
			<input type="text" placeholder="Nuevo Costo" class="form-control col-md-3 input-close-btn" name="cost" />
			<input type="submit" name="new-cost" class="btn btn-outline-success" value="Agregar" />
		</form>
		<br>
		<h5>Lista de Costos</h5>
		<table class="table table-striped table-bordered">
			<thead>
				<th>Costo</th>
				<th>Fecha</th>
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