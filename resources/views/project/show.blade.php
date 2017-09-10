@extends('project.project')
@section('sub-title', '')

@section('sub-content')

@section('titlePrincipal', $project->name)

	
	
<div class="row" style="margin: 0 -15px;">
<div class="col-md-6">
<a href="/projects/{{$project->id}}/edit" class="btn btn-outline-warning">
		<i class="fa fa-pencil" aria-hidden="true"></i> Editar
	</a>
</div>
	<div class="col-md-6">
	
						<?php
					  			
					  	function daysLeft($start, $end) {
					  		$date1 = new DateTime($start);  //current date or any date
							$date2 = new DateTime($end);   //Future date
							$diff = $date2->diff($date1)->format("%a");  //find difference
					  		return intval($diff);   //rounding days
					  	}
					  	$days = daysLeft($project->start, $project->end);
					  	?>
					  	<span style="font-size: 1.3em;" class="pull-right badge badge-danger"><!--esto debe ser por porcentaje-->
									{{$days}} <br> <small>
										@if($days>1)
											Días
										@else
											Día
										@endif
										 Restantes
									</small></span>
					
</div>
</div>


<style type="text/css">
</style>
<div class="box">
	
	<div class="box-head" style="margin-bottom: .5em;">
		<a target="_blank" style="margin-bottom: .5em;" class="btn btn-outline-primary" href="/projects/partities/{{$project->id}}">
			Partidas <i class="fa fa-file-pdf-o" aria-hidden="true"></i> 
		</a>
		<a target="_blank" style="margin-bottom: .5em;" class="btn btn-outline-warning" href="/projects/offer/{{$project->id}}">
			Oferta Económica <i class="fa fa-file-pdf-o" aria-hidden="true"></i> 
		</a>
		<a target="_blank" style="margin-bottom: .5em;" class="btn btn-outline-info" href="/projects/gantt/{{$project->id}}">
			Gantt <i class="fa fa-bar-chart" aria-hidden="true"></i>
		</a>
		<a href="/projects/clone/{{$project->id}}" style="margin-bottom: .5em;"  class="btn btn-outline-success">
		<i class="fa fa-clone" aria-hidden="true"></i> Clonar
	</a>
		
	</div>
	<div class="box-body">
		
		
		<div class="row">
			<div class="col-md-6">
				<div class="headers">
					<p>
						<b>Cliente:</b> <a href="/clients/{{$project->clientId}}">{{Repo\Client::find($project->clientId)->name}}</a>
						<br>
						<b>Responsable:</b> <a href="/users/{{$project->userId}}">{{Repo\User::find($project->userId)->name}}</a>
					</p>
					
					<p>
						<b>Creado:</b> {{$project->created_at}} <br>
						<b>Inicio:</b> {{$project->start}} <br>
						<b>Fin:</b>  {{$project->end}}
					</p>
					<p>
						<b>Estado:</b> <span class="badge badge-default">{{Repo\State::find($project->stateId)->name}}</span>
					</p>
					
				</div>
			</div>
			<div class="col-md-6">
				<div class="modifiers">
			<p style="margin: 0;">
				<small>
					Modificadores
				</small>
			</p>
			@foreach ($projectModifiers as $modifier)
            	<p style="margin: .15em 0;">
            		<b>@lang('app.'.$modifier->name):</b> 
            		{{number_format($modifier->amount, 2)}}@if($modifier->type==1)%@endif
            	</p>
        	@endforeach
		</div>
			</div>
			<div class="col-xs-12">
				<h4 style="text-align: right;">Total: 0.00</h4>
			</div>
		</div>

		<br>
			
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#home" role="tab" href="#">
					Estructura de Costos
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#sheet5" role="tab" href="#">
					Sumatoria Global
				</a>
			</li>
		</ul>
		
		<div class="tab-content">
  			<div class="tab-pane active" id="home" role="tabpanel">
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
							$partitieNum = 1;
						?>
						@foreach ($project->partities() as $projectPartitie)
							<?php
									$calculator->calcPartitie(
										$projectPartitie->id, 
										$projectPartitie->partitie()->yield
									);
							?>
							<tr>
								<td>
									{{$partitieNum++}}
								</td>
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
				
  			</div>
  			<div class="tab-pane" id="sheet5" role="tabpanel">
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

							$partitieNum = 1;
							

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
								<td>{{$partitieNum++}}</td>
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
						<tr style="background: #FFE0B2;">
							<td colspan="4" style="text-align: right;">
								<b>Total de Inversión: </b>
							</td>
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
</div>
<style type="text/css">
	.table thead{
		font-size: .7em;
	}
	.row{
		margin: 0;
	}
</style>
@stop