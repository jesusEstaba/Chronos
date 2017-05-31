@extends('partitie.partitie')
@section('sub-title', 'Crear')

@section('sub-content')
	<div class="box">
		<div class="box-body">
			@section('titlePrincipal', $partitie->name)
			<p>
				<b>Rendimiento:</b> {{$partitie->yield}}
			</p>
			<p>
				<b>Unidad:</b> {{$partitie->unitId}}
			</p>
			
			
			<br>

			<div id="material">
				<h3>Materiales</h3>
				<table class="table table-striped materials">
					<thead class="thead-inverse">
						<tr>
							<th>Nombre</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th>Unidad</th>
							<th>Unico</th>
						</tr>
					</thead>
					<tbody>
						@foreach($materials as $material)
							<tr>
								<td>{{$material->material->name}}</td>
								<td>{{$material->material->lastCost()}}</td>
								<td>{{$material->quantity}}</td>
								<td>{{$material->material->unit->abbreviature}}</td>
								<td>
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" disabled>
										<span class="custom-control-indicator"></span>
									</label>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
					
			<br>

			<div id="equipment">
				<h3>Equipos</h3>
				<table class="table table-striped equipments">
					<thead class="thead-inverse">
						<tr>
							<th>Nombre</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th>Unico</th>
							<th>Por Trabajador</th>
						</tr>
					</thead>
					<tbody>
						@foreach($equipments as $equipment)
							<tr>
								<td>{{$equipment->equipment->name}}</td>
								<td>{{$equipment->equipment->lastCost()}}</td>
								<td>{{$equipment->quantity}}</td>
								<td>
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" disabled>
										<span class="custom-control-indicator"></span>
									</label>
								</td>
								<td>
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" disabled>
										<span class="custom-control-indicator"></span>
									</label>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop