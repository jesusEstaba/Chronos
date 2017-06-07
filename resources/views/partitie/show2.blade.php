@extends('partitie.partitie')
@section('sub-title', 'Crear')

@section('sub-content')
	<div class="box">
		<script type="text/javascript">
			$(() => {
				$('.custom-checkbox').on('click', function(e) {
					e.preventDefault();
				});
			})
		</script>
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
										<input type="checkbox" class="custom-control-input"
										@if($material->uniq)
										checked
										@endif
										>
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
										<input type="checkbox" class="custom-control-input" 
										@if($equipment->uniq)
										checked
										@endif
										>
										<span class="custom-control-indicator"></span>
									</label>
								</td>
								<td>
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" 
										@if($equipment->workers)
										checked
										@endif>
										<span class="custom-control-indicator"></span>
									</label>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			<div id="workforce">
				<h3>Mano de Obra</h3>
				<table class="table table-striped workforces">
					<thead class="thead-inverse">
						<tr>
							<th>Cargo</th>
							<th>Salario</th>
							<th>Cantidad</th>
						</tr>
					</thead>
					<tbody>
						@foreach($workforces as $workforce)
							<tr>
								<td>{{$workforce->workforce->name}}</td>
								<td>{{$workforce->workforce->lastCost()}}</td>
								<td>{{$workforce->quantity}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop