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
			<i class="fa fa-file-pdf-o" aria-hidden="true"></i> ver PDF
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
            	<p>
            		<b>@lang('app.'.$modifier->name):</b> 
            		{{$modifier->amount}}@if($modifier->type==1)%@endif
            	</p>
        	@endforeach
		</div>
		<br>
		<h4>Partidas</h4>
		<div class="partities">
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
									number_format(
										$totalInPartities += $projectPartitie->quantity*$calculator->totalPartitie,
										2
									)
								}}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<h3>Total: {{number_format($totalInPartities, 2)}}</h3>
		</div>
	</div>
</div>
@stop