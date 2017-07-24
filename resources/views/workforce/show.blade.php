@extends('workforce.workforce')
@section('sub-title', '')

@section('sub-content')

@section('titlePrincipal', $workforce->name)

<a href="/workforces/{{$workforce->id}}/edit" class="btn btn-outline-warning">
	<i class="fa fa-pencil" aria-hidden="true"></i> Editar
</a>

<div class="box">
	<div class="box-head">
		<h5>Añadir Costo</h5>
	</div>
	<div class="box-body">
		<form action="/workforcecosts" method="post">
			{{csrf_field()}}
			<input type="hidden" name="workforceId" value="{{$workforce->id}}">
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
				<th>% Salario</th>
				<th>Fecha</th>
			</thead>
			<tbody>
				@foreach($workforceCosts as $cost)
				<tr>
					<td>{{number_format($cost->cost, 2)}}</td>
					<td>{{$cost->created_at}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $workforceCosts->links('vendor.pagination.bootstrap-4') }}
	</div>
</div>
@stop