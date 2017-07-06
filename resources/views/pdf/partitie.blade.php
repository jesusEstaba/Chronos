<head>
	<title>Partidas</title>
</head>
<style type="text/css">
	body {
		font-size:12px;
		font-family: Helvetica;
	}
	table{
		width: 100%;
	}
	.text-right{
		text-align: right;
	}
	.logo{
		height: 100px;
	}
	.page-break {
	    page-break-after: always;
	}
	.price-separate{
		margin-bottom: .5em;
	}
	p{
		margin: 0.25em 0;
	}
	h3{
		margin: 0;
	}
	.table{
		border-collapse: collapse;
		border-spacing:0 5px;
	}
	.table thead tr th{
		text-align: center;
		border-top: 1px solid #e77817; 
		border-bottom: 1px solid #e77817; 
  		border-collapse:separate; 
  		border-spacing:5px 5px;
  	} 
  	.border-left{
  		border-left: 1px solid #e77817; 
  	}
  	.border-right{
  		border-right: 1px solid #e77817; 
  	}

	.table td{
		border:1px solid #ccc;
		text-align: right;
		padding: .25em;
	}
	.table td.non{
		border: none;
	}
	td.center{
		text-align: center;
	}
	td.left{
		text-align: left;
	}

	.col-1{
		width: 12.5%;
	}
	.col-2{
		width: 25%;
	}
	.col-3{
		width: 37.5%;
	}
	.col-7{
		width: 87.5%;
	}
</style>
<?php
	$pageBreak = false;
?>

@foreach($project->partities() as $partitie)
	@if($pageBreak)
		<div class="page-break"></div>
	@else
		<?php $pageBreak = true;?>
	@endif
<div class="partitie">
	<div class="row">
		<div class="col-md-12">
			<img src="{{asset('images/logos/j1atjjNo.png')}}" width="280" alt="">
		</div>
		<div class="col-md-12">
			<p class="text-right">
				<b>Fecha</b>: {{date('d-m-Y')}}
			</p>
			<p class="text-right">
				<b>Partida N°</b>: {{$partitie->id}}
			</p>
		</div>
		<div class="col-md-12">
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
		</div>
		<div class="col-md-12">
			<p>
				<b>Descripción Partida:</b> {{$partitie->partitie()->name}}
			</p>
			<table class="table" style="margin-bottom: 1em;">
				<thead>
					<tr>
						<th class="border-left col-1">Código</th>
						<th class="col-2">Código Covenin</th>
						<th class="col-1">Unidad</th>
						<th class="col-2">Cantidad</th>
						<th class="border-right col-2" colspan="2">Rendimiento</th>
					</tr>
				</thead>
				<tbody>

					<tr>
						<td class="center">{{$partitie->partitie()->id}}</td>
						<td class="center"></td>
						<td class="center">{{$partitie->partitie()->unit()->name}}</td>
						<td class="center">{{$partitie->quantity}}</td>
						<td class="center">UND</td>
						<td class="center">{{$partitie->partitie()->yield}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-12">
			<h3>1. MATERIALES</h3>
			<table class="table">
				<thead>
					<tr>
						<th class="border-left col-1">CÓDIGO</th>
						<th class="col-2">DESCRIPCIÓN</th>
						<th class="col-1">UNIDAD</th>
						<th class="col-1">CANTIDAD</th>
						<th class="col-1">%DESP</th>
						<th class="col-1">COSTO</th>
						<th class="border-right col-1">TOTAL</th>
					</tr>
					
				</thead>
				<tbody>
					@foreach($partitie->materials() as $material)
					<tr>
						<td class="center">
							{{$material->materialId}}
						</td>
						<td class="left">
							{{$material->material()->name}}
						</td>
						<td class="center">
							{{$material->material()->unit()->first()->name}}
						</td>
						<td>
							{{$material->qty()}}
						</td>
						<td>
							
						</td>
						<td>
							{{$calculator->material($material->cost())}}
						</td>
						<td>
							{{
							$calculator->totalInMaterial(
							$material->cost(),
							$material->qty()
							)
							}}
						</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td class="non" colspan="3">
							
						</td>
						<td colspan="3" class="text-right">
							<b>TOTAL MATERIALES</b>
						</td>
						<td>
							{{$calculator->getTotalInMaterials()}}
						</td>
					</tr>
					<tr>
						<td class="non" colspan="3">
							
						</td>
						<td colspan="3" class="text-right">
							<b>UNITARIO DE MATERIALES</b>
						</td>
						<td>
							{{$calculator->getTotalInMaterials()}}
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<div class="col-md-12">
			<h3>2. EQUIPO</h3>
			<table class="table">
				<thead>
					<tr>
						<th class="border-left col-1">CÓDIGO</th>
						<th class="col-3">DESCRIPCIÓN</th>
						<th class="col-1">CANTIDAD</th>
						<th class="col-1">DEP. O ALQ.</th>
						<th class="col-1">COSTO</th>
						<th class="border-right col-1">TOTAL</th>
					</tr>
					
				</thead>
				<tbody>
					@foreach($partitie->equipments() as $equipment)
					<tr>
						<td class="center">
							{{$equipment->equipmentId}}
						</td>
						<td class="left">
							{{$equipment->equipment()->name}}
						</td>
						<td>
							{{$equipment->qty()}}
						</td>
						<td>
							{{$equipment->equipment()->depreciation}}
						</td>
						<td>
							{{$equipment->cost()}}
						</td>
						<td>
							{{
							$calculator->totalInEquipment(
							$equipment->cost(),
							$equipment->equipment()->depreciation,
							$equipment->qty()
							)
							}}
						</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td class="non" colspan="2"></td>
						<td colspan="3" class="text-right">
							<b>TOTAL EQUIPOS</b>
						</td>
						<td>
							{{$calculator->getTotalInEquipments()}}
						</td>
					</tr>
					<tr>
						<td class="non" colspan="2"></td>
						<td colspan="3" class="text-right">
							<b>UNITARIO DE EQUIPOS</b>
						</td>
						<td>
							{{$calculator->getTotalInEquipments() / $partitie->yield}}
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<div class="col-md-12">
			<h3>3. MANO DE OBRA</h3>
			<table class="table">
				<thead>
					<tr>
						<th class="border-left col-1">CÓDIGO</th>
						<th class="col-3">DESCRIPCIÓN</th>
						<th class="col-1">CANTIDAD</th>
						<th class="col-1">SALARIO</th>
						<th class="col-1">BONO</th>
						<th class="border-right col-1">TOTAL</th>
					</tr>
					
				</thead>
				<tbody>
					@foreach($partitie->workforces() as $workforce)
						<tr>
							<td class="center">
								{{$workforce->workforceId}}
							</td>
							<td class="left">
								{{$workforce->workforce()->name}}
							</td>
							<td>
								{{$workforce->qty()}}
							</td>
							<td>
								{{$calculator->workforce($workforce->cost())}}
							</td>
							<td>
								
							</td>
							<td>
								{{$calculator->totalInWorkforce(
								$workforce->cost(),
								$workforce->qty()
								)}}
							</td>
						</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td class="non" colspan="2"></td>
						<td colspan="3" class="text-right">
							<b>TOTAL EQUIPOS</b>
						</td>
						<td>
							{{$calculator->getTotalInWorkforces()}}
						</td>
					</tr>
					<tr>
						<td class="non" colspan="2"></td>
						<td colspan="3" class="text-right">
							<b>UNITARIO DE EQUIPOS</b>
						</td>
						<td>
							{{$calculator->getTotalInWorkforces() / $partitie->yield}}
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<div class="col-xs-12">
		<?php
								$calculator->calcPartitie(
									$partitie->id, 
									$partitie->yield
								);
		?>

		<table style="width: 100%">
			<thead>
				<tr>
					<th class="col-7">
						
					</th>
					<th class="col-1">
						
					</th>
				</tr>
			</thead>
			<tbody style="text-align: right;">
				<tr>
					<td>
						<u>TOTAL MANO DE OBRA</u>
					</td>
					<td>
						{{number_format($calculator->workforcesTotal, 2)}}
					</td>
				</tr>
				<tr>
					<td>
						<u>Factor de Costos Asociados al Salario</u>
					</td>
					<td>
						{{number_format($calculator->totalfcas, 2)}}
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td></td>
				</tr>
				<tr>
					<td>
						TOTAL MANO DE OBRA
					</td>
					<td>
						{{number_format($calculator->totalwork, 2)}}
					</td>
				</tr>
				<tr>
					<td>
						<b>UNITARIO DE MANO DE OBRA</b>
					</td>
					<td>
						{{number_format($calculator->unitarywork, 2)}}
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td></td>
				</tr>
				<tr>
					<td>
						<b>COSTO DIRECTO POR UNIDAD</b>
					</td>
					<td>
						{{number_format($calculator->resources, 2)}}
					</td>
				</tr>
				<tr>
					<td><small>&nbsp;</small></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<u>% ADMINISTRACION Y GASTOS GENERALES</u>
					</td>
					<td>
						{{number_format($calculator->totalexpenses, 2)}}
					</td>
				</tr>
				<tr>
					<td>
						<b>SUBTOTAL</b>
					</td>
					<td>
						{{number_format($calculator->subtotal, 2)}}
					</td>
				</tr>
				<tr>
					<td>
						<u>30% UTILIDAD</u>
					</td>
					<td>
						{{number_format($calculator->totalUtility, 2)}}
					</td>
				</tr>
				<tr>
					<td>
						<u>SUBTOTAL</u>
					</td>
					<td>
						{{number_format($calculator->totalPartitie, 2)}}
					</td>
				</tr>
			</tbody>
		</table>


		</div>
	</div>
</div>
@endforeach