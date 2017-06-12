<style type="text/css">
	body {
		font-size: 12px;
		font-family: Helvetica;
	}
	.table{
		width: 100%;
	}
	.text-right{
		text-align: right;
	}
	.logo{
		height: 100px;
	}
</style>
@foreach($project->partities() as $partitie)
<div class="partitie">
	<img class="logo" src="{{asset('images/logos/j1atjjNo.png')}}" alt="">
	<p class="text-right">
		<b>Fecha</b>: {{date('d-m-Y')}}
	</p>
	<p class="text-right">
		<b>Partida N°</b>: {{$partitie->id}}
	</p>
	<p>
		<b>
		Descripción de la Obra:
		</b>
	</p>
	<p>
		{{$project->name}}
	</p>
	<p>
		<b>Propietario:</b> {{$project->client()->name}}
	</p>
	<p>
		<b>Descripción Partida:</b> {{$partitie->partitie()->name}}
	</p>
	<table class="table" border="1">
		<thead>
			<th>Código</th>
			<th>Código Covenin</th>
			<th>Unidad</th>
			<th>Cantidad</th>
			<th>Rendimiento</th>
		</thead>
		<tbody>
			<tr></tr>
			<tr>
				<td>{{$partitie->partitie()->id}}</td>
				<td></td>
				<td>{{$partitie->partitie()->unit()->name}}</td>
				<td>{{$partitie->quantity}}</td>
				<td>{{$partitie->partitie()->yield}}</td>
			</tr>
		</tbody>
	</table>
	<h3>1. MATERIALES</h3>
	<table class="table" border="1">
		<thead>
			<th>CÓDIGO</th>
			<th>DESCRIPCIÓN</th>
			<th>UNIDAD</th>
			<th>CANTIDAD</th>
			<th>%DESP</th>
			<th>COSTO</th>
			<th>TOTAL</th>
		</thead>
		<tbody>
			<tr></tr>
			@foreach($partitie->materials() as $material)
				<tr>
					<td>
						{{$material->materialId}}
					</td>
					<td>
						{{$material->material()->name}}
					</td>
					<td>
						{{$material->material()->unit()->first()->name}}
					</td>
					<td>
						{{$material->material()->quantity}}
					</td>
					<td>
						.
					</td>
					<td>
						{{$material->cost()->cost}}
					</td>
					<td>
						.
					</td>
				</tr>
			@endforeach
			<tr>
				<td colspan="6" class="text-right">
					<b>TOTAL MATERIALES</b>
				</td>
				<td>
					
				</td>
			</tr>
			<tr>
				<td colspan="6" class="text-right">
					<b>UNITARIO DE MATERIALES</b>
				</td>
				<td>
					
				</td>
			</tr>
		</tbody>
	</table>
	<h3>2. EQUIPO</h3>
	<table class="table" border="1">
		<thead>
			<th>CÓDIGO</th>
			<th>DESCRIPCIÓN</th>
			<th>CANTIDAD</th>
			<th>DEP. O ALQ.</th>
			<th>COSTO</th>
			<th>TOTAL</th>
		</thead>
		<tbody>
			<tr></tr>
			@foreach($partitie->equipments() as $equipment)
			<tr>
				<td>
					{{$equipment->equipmentId}}
				</td>
				<td>
					{{$equipment->equipment()->name}}
				</td>
				<td>
					{{$equipment->equipment()->quantity}}
				</td>
				<td>
					{{$equipment->equipment()->depreciation}}
				</td>
				<td>
					{{$equipment->cost()->cost}}
				</td>
				<td>
					
				</td>
			</tr>
			@endforeach
			<tr>
				<td colspan="5" class="text-right">
					<b>TOTAL EQUIPOS</b>
				</td>
				<td>
					
				</td>
			</tr>
			<tr>
				<td colspan="5" class="text-right">
					<b>UNITARIO DE EQUIPOS</b>
				</td>
				<td>
					
				</td>
			</tr>
		</tbody>
	</table>
	<h3>3. MANO DE OBRA</h3>
	<table class="table" border="1">
		<thead>
			<th>CÓDIGO</th>
			<th>DESCRIPCIÓN</th>
			<th>CANTIDAD</th>
			<th>SALARIO</th>
			<th>BONO</th>
			<th>TOTAL</th>
		</thead>
		<tbody>
			<tr></tr>
			@foreach($partitie->workforces() as $workforce)
			<tr>
				<td>
					{{$workforce->workforceId}}
				</td>
				<td>
					{{$workforce->workforce()->name}}
				</td>
				<td>
					{{$workforce->workforce()->quantity}}
				</td>
				<td>
					{{$workforce->cost()->cost}}%
				</td>
				<td>
					
				</td>
				<td>
					
				</td>
			</tr>
			@endforeach
			<tr>
				<td colspan="5" class="text-right">
					<b>TOTAL EQUIPOS</b>
				</td>
				<td>
					
				</td>
			</tr>
			<tr>
				<td colspan="5" class="text-right">
					<b>UNITARIO DE EQUIPOS</b>
				</td>
				<td>
					
				</td>
			</tr>
		</tbody>
	</table>
	
	
</div>
@endforeach