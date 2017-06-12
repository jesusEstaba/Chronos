@extends('project.project')
@section('sub-title', '')

@section('sub-content')

@section('titlePrincipal', $project->name)
<!--
	<a href="/projects/{{$project->id}}/edit" class="btn btn-outline-warning">
		<i class="fa fa-pencil" aria-hidden="true"></i> Editar
	</a>
-->

<style type="text/css">
	.box-body .row{
		margin: 0 !important;
	}
	.partitie {
		border: 1px solid #333;
	}
	.border-t{
		border-top: 1px solid #333;	
	}
</style>
<div class="box">
	<div class="box-head">
		<a target="_blank" style="margin-bottom: .5em;" class="btn btn-outline-primary" href="/projects/{{$project->id}}/pdf">
			<i class="fa fa-file-pdf-o" aria-hidden="true"></i> ver PDF
		</a>
		
	</div>
	<div class="box-body">
		@foreach($project->partities() as $partitie)
			<div class="partitie">
				<div class="row">
					<div class="col-md-12">
						<img src="{{asset('images/logos/j1atjjNo.png')}}" alt="">
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
						<table class="table table-bordered">
							<thead>
								<th>Código</th>
								<th>Código Covenin</th>
								<th>Unidad</th>
								<th>Cantidad</th>
								<th>Rendimiento</th>
							</thead>
							<tbody>
								<tr>
									<td>{{$partitie->partitie()->id}}</td>
									<td></td>
									<td>{{$partitie->partitie()->unit()->name}}</td>
									<td>{{$partitie->quantity}}</td>
									<td>{{$partitie->partitie()->yield}}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-12">
						<h3>1. MATERIALES</h3>
						<table class="table table-bordered">
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
											
										</td>
										<td>
											{{$material->cost()->cost}}
										</td>
										<td>
											
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
					</div>
					<div class="col-md-12">
						<h3>2. EQUIPO</h3>
						<table class="table table-bordered">
							<thead>
								<th>CÓDIGO</th>
								<th>DESCRIPCIÓN</th>
								<th>CANTIDAD</th>
								<th>DEP. O ALQ.</th>
								<th>COSTO</th>
								<th>TOTAL</th>
							</thead>
							<tbody>
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
					</div>

					<div class="col-md-12">
						<h3>3. MANO DE OBRA</h3>
						<table class="table table-bordered">
							<thead>
								<th>CÓDIGO</th>
								<th>DESCRIPCIÓN</th>
								<th>CANTIDAD</th>
								<th>SALARIO</th>
								<th>BONO</th>
								<th>TOTAL</th>
							</thead>
							<tbody>
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
				</div>
			</div>
		@endforeach
	</div>
</div>
@stop