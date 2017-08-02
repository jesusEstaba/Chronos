@extends('partitie.partitie')
@section('sub-title', 'Crear')

@section('sub-content')
<a href="/partities/{{$partitie->id}}/edit" class="btn btn-outline-warning">
		<i class="fa fa-pencil" aria-hidden="true"></i> Editar
	</a>
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
			<small class="pull-right"><b>Creador:</b> <a href="/users/{{$partitie->userId}}">{{Repo\User::find($partitie->userId)->name}}</a></small>
			<p>
				<b>Rendimiento:</b> {{number_format($partitie->yield, 2)}}
			</p>
			<p>
				<b>Codigo Covenin:</b> 
				@if($partitie->reference)
					{{$partitie->reference}}
				@else
					<i>Sin codigo</i>
				@endif
			</p>
			<p>
				<b>Unidad:</b> {{Repo\Unit::find($partitie->unitId)->name}}
			</p>
		
			
			
			
			<br>

			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#mat" role="tab" href="#">
						Materiales
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#equip" role="tab" href="#">
						Equipos
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#work" role="tab" href="#">
						Mano de Obra
					</a>
				</li>
			</ul>

<div class="tab-content">
	<div class="tab-pane active" id="mat" role="tabpanel">
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
								<td>{{number_format($material->material->lastCost(), 2)}}</td>
								<td>{{number_format($material->quantity, 2)}}</td>
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
				
	</div>
	<div class="tab-pane" id="equip" role="tabpanel">	
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
								<td>{{number_format($equipment->equipment->lastCost(), 2)}}</td>
								<td>{{number_format($equipment->quantity, 2)}}</td>
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
	</div>

	<div class="tab-pane" id="work" role="tabpanel">		
			<br>

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
								<td>{{number_format($workforce->workforce->lastCost(), 2)}}</td>
								<td>{{number_format($workforce->quantity, 2)}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			</div>
			</div>
		</div>
	</div>
@stop