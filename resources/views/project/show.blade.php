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
</style>
<div class="box">
	<div class="box-head">
		<a target="_blank" style="margin-bottom: .5em;" class="btn btn-outline-primary" href="/projects/{{$project->id}}/pdf">
			Partidas <i class="fa fa-file-pdf-o" aria-hidden="true"></i> 
		</a>
		
	</div>
	<div class="box-body">
		<div class="headers">
			<p>
				<b>Creado:</b> {{$project->created_at}}
			</p>
		</div>
		<div class="modifiers">
			@foreach ($projectModifiers as $modifier)
            	<p style="margin: .15em 0;">
            		<b>@lang('app.'.$modifier->name):</b> 
            		{{$modifier->amount}}@if($modifier->type==1)%@endif
            	</p>
        	@endforeach
		</div>
		<br>
		
		<div class="costs">
			<h3>Estructura de Costos</h3>
			<table class="table">
				<thead>
					<tr>
						<th>N°</th>
						<th>COD</th>
						<th>DESCRIPCION</th>
						<th>CANT</th>
						<th>MATERIALES</th>
						<th title="FLETES-TRANSPORTE-COMUNICACIONES-CONSUMIBLES-OPERATIVIDAD">
							GASTOS ADMINISTRATIVOS
						</th>
						<th>MANO DE OBRA</th>
						<th>DEPRECIACION DE EQUIPOS</th>
						<th>UTILIDAD</th>
						<th>TOTAL PRECIO UNITARIO</th>
						<th>TOTAL PARTIDA</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$totalInPartities = 0;
					?>
					@foreach ($project->partities() as $projectPartitie)
						<?php
								$calculator->calcPartitie(
									$projectPartitie->id, 
									$projectPartitie->partitie()->yield
								);
						?>
						<tr>
							<td></td>
							<td>{{$projectPartitie->partitie()->id}}</td>
							<td>
								<small>
									{{$projectPartitie->partitie()->name}}
								</small>	
							</td>
							<td>{{$projectPartitie->quantity}}</td>
							<td>{{number_format($calculator->materialsTotal, 2)}}</td>
							<td>{{number_format($calculator->totalexpenses, 2)}}</td>	
							<td>{{number_format($calculator->equipmentsTotal, 2)}}</td>
							<td>{{number_format($calculator->workforcesTotal, 2)}}</td>
							
							
							<td>{{number_format($calculator->totalUtility, 2)}}</td>
							<td>{{number_format($calculator->totalPartitie, 2)}}</td>
							<td>
								{{
									number_format($projectPartitie->quantity*$calculator->totalPartitie, 2)
								}}
							</td>
						</tr>
						<?php
							$totalInPartities += $projectPartitie->quantity*$calculator->totalPartitie;
						?>
					@endforeach
				</tbody>
			</table>
			<h4>Total: {{number_format($totalInPartities, 2)}}</h4>
		</div>
		<div class="sheet5">
			<br>
			<br>
			<br>
			<h3>"Hoja 5"</h3>
			<table class="table">
				<thead>
					<tr>
						<th>N°</th>
						<th>COD</th>
						<th>DESCRIPCION</th>
						<th>CANT</th>
						<th>MATERIALES</th>
						<th title="FLETES-TRANSPORTE-COMUNICACIONES-CONSUMIBLES-OPERATIVIDAD">
							GASTOS ADMINISTRATIVOS
						</th>
						<th>MANO DE OBRA</th>
						<th>DEPRECIACION DE EQUIPOS</th>
						<th>UTILIDAD</th>
						<th>TOTAL PRECIO UNITARIO</th>
						<th>TOTAL PARTIDA</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$totalInPartities = 0;

						class Sheet5
						{
							public $materialsTotal = 0;
							public $totalexpenses = 0;
							public $equipmentsTotal = 0;
							public $workforcesTotal = 0;
							public $totalUtility = 0;
							public $totalPartitie = 0;

							public function __call($name, $arguments)
							{
								$this->$name += $arguments[0];
								return $arguments[0];
							}
						}

						$sheet5 = new Sheet5();
						

					?>
					@foreach ($project->partities() as $projectPartitie)
						<?php
								$calculator->calcPartitie(
									$projectPartitie->id, 
									$projectPartitie->partitie()->yield
								);

								$qty = $projectPartitie->quantity;
						?>
						<tr>
							<td></td>
							<td>{{$projectPartitie->partitie()->id}}</td>
							<td>
								<small>
									{{$projectPartitie->partitie()->name}}
								</small>	
							</td>
							<td>{{$projectPartitie->quantity}}</td>
							<td>{{number_format($sheet5->materialsTotal($qty * $calculator->materialsTotal), 2)}}</td>
							<td>{{number_format($sheet5->totalexpenses($qty * $calculator->totalexpenses), 2)}}</td>	
							<td>{{number_format($sheet5->equipmentsTotal($qty * $calculator->equipmentsTotal), 2)}}</td>
							<td>{{number_format($sheet5->workforcesTotal($qty * $calculator->workforcesTotal), 2)}}</td>
							
							
							<td>{{number_format($sheet5->totalUtility($qty * $calculator->totalUtility), 2)}}</td>
							<td>{{number_format($sheet5->totalPartitie($qty * $calculator->totalPartitie), 2)}}</td>
							<td>
								{{
									number_format($qty * $calculator->totalPartitie, 2)
								}}
							</td>
						</tr>
						<?php
							$totalInPartities += $qty * $calculator->totalPartitie;
						?>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>{{number_format($sheet5->materialsTotal, 2)}}</td>
						<td>{{number_format($sheet5->totalexpenses, 2)}}</td>
						<td>{{number_format($sheet5->equipmentsTotal, 2)}}</td>
						<td>{{number_format($sheet5->workforcesTotal, 2)}}</td>
						<td>{{number_format($sheet5->totalUtility, 2)}}</td>
						<td>{{number_format($sheet5->totalPartitie, 2)}}</td>
						<td>{{number_format($totalInPartities, 2)}}</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
@stop