@extends('partitie.partitie')
@section('sub-title', 'Crear')

@section('sub-content')

@include('template.resources-buttons', ['name' => 'partities','resource'=> $partitie])

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
			<b>Código:</b>
			@if($partitie->reference)
			{{$partitie->reference}}
			@else
			<i>Sin codigo</i>
			@endif
		</p>
		<p style="margin: 0;">
			<b>Unidad:</b> {{Repo\Unit::find($partitie->unitId)->name}}
		</p>
	</div>
</div>


<div class="box">
	<div class="box-body">
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
					<table class="table table-striped materials">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Precio</th>
								<th>Cantidad</th>
								<th>Unidad</th>
							</tr>
						</thead>
						<tbody>
							@if(count($materials))
							@foreach($materials as $material)
							<tr>
								<td>
									<a href="/materials/{{$material->material->id}}">{{$material->material->name}}</a>
								</td>
								<td>{{number_format($material->material->lastCost(), 2)}}</td>
								<td>{{number_format($material->quantity, 2)}}</td>
								<td>{{$material->material->unit->abbreviature}}</td>
							</tr>
							@endforeach
							@else
							<td colspan="6" class="delete-if-not-empty">
								<p class="text-center">
									No se ha agregado ningun recurso de este tipo.
								</p>
							</td>
							@endif
						</tbody>
					</table>
				</div>
				
			</div>
			<div class="tab-pane" id="equip" role="tabpanel">
				<br>
				<div id="equipment">
					<table class="table table-striped equipments">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Precio</th>
								<th>Cantidad</th>
								<th>Por Trabajador</th>
							</tr>
						</thead>
						<tbody>
							@if(count($equipments))
							@foreach($equipments as $equipment)
							<tr>
								<td>
									<a href="/equipments/{{$equipment->equipment->id}}">{{$equipment->equipment->name}}</a>
								</td>
								<td>{{number_format($equipment->equipment->lastCost(), 2)}}</td>
								<td>{{number_format($equipment->quantity, 2)}}</td>
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
							@else
							<td colspan="6" class="delete-if-not-empty">
								<p class="text-center">
									No se ha agregado ningun recurso de este tipo.
								</p>
							</td>
							@endif
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane" id="work" role="tabpanel">
				<br>
				<div id="workforce">
					<table class="table table-striped workforces">
						<thead>
							<tr>
								<th>Cargo</th>
								<th>Salario</th>
								<th>Cantidad</th>
							</tr>
						</thead>
						<tbody>
							@if(count($workforces))
							@foreach($workforces as $workforce)
							<tr>
								<td>
									<a href="/workforces/{{$workforce->workforce->id}}">{{$workforce->workforce->name}}</a>
								</td>
								<td>{{$workforce->workforce->lastCost()}}%</td>
								<td>{{number_format($workforce->quantity, 2)}}</td>
							</tr>
							@endforeach
							@else
							<td colspan="6" class="delete-if-not-empty">
								<p class="text-center">
									No se ha agregado ningun recurso de este tipo.
								</p>
							</td>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@stop