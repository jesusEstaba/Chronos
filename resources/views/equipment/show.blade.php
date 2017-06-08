@extends('equipment.equipment')

@section('titlePrincipal', $equipment->name)

@section('sub-content')

<a href="/equipments/{{$equipment->id}}/edit" class="btn btn-outline-warning">
	<i class="fa fa-pencil" aria-hidden="true"></i> Editar
</a>
<p>
	<b>Category:</b> <a href="/categories/{{$equipment->category->id}}">{{$equipment->category->name}}</a>
</p>

<div class="box">
	<div class="box-head">
		<h5>Añadir Costo</h5>
	</div>
	<div class="box-body">
		<form action="/equipmentcosts" method="post">
			{{csrf_field()}}
			<input type="hidden" name="equipmentId" value="{{$equipment->id}}">
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
				<th>Costo</th>
				<th>Fecha</th>
			</thead>
			<tbody>
				@foreach($equipmentCosts as $cost)
				<tr>
					<td>{{$cost->cost}}</td>
					<td>{{$cost->created_at}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $equipmentCosts->links('vendor.pagination.bootstrap-4') }}
	</div>
</div>
@stop