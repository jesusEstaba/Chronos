@extends('equipment.equipment')

@section('titlePrincipal', $equipment->name)

@section('sub-content')

@include('template.resources-buttons', ['name' => 'equipments','resource'=> $equipment])


<div class="box">
	<div class="box-body">
		<p style="margin: 0;">
			<b>Category:</b> {{$equipment->category->name}}
		</p>
	</div>
</div>

<div class="box">
	<div class="box-body">
		<h5>Añadir Costo</h5>
		<form action="/equipmentcosts" method="post">
			{{csrf_field()}}
			<input type="hidden" name="equipmentId" value="{{$equipment->id}}">
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
				@foreach($equipmentCosts as $cost)
				<tr>
					<td>{{number_format($cost->cost, 2)}}</td>
					<td>{{$cost->created_at}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $equipmentCosts->links('vendor.pagination.bootstrap-4') }}
	</div>
</div>
@stop