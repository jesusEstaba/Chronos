@extends('project.project')
@section('sub-title', '')

@section('sub-content')

@section('titlePrincipal', $project->name)

	<a href="/projects/{{$project->id}}/edit" class="btn btn-outline-warning">
		<i class="fa fa-pencil" aria-hidden="true"></i> Editar
	</a>
	<a href="/projects/{{$project->id}}/clone" style="float: right;" class="btn btn-outline-success">
		<i class="fa fa-clone" aria-hidden="true"></i> Clonar
	</a>



<style type="text/css">
</style>
<div class="box">
	<div class="box-head" style="margin-bottom: .5em;">
		<a target="_blank" style="margin-bottom: .5em;" class="btn btn-outline-primary" href="/projects/{{$project->id}}/pdf">
			Partidas <i class="fa fa-file-pdf-o" aria-hidden="true"></i> 
		</a>
		<a target="_blank" style="margin-bottom: .5em; float: right;" class="btn btn-outline-info" href="/gantt/{{$project->id}}/pdf">
			Gantt <i class="fa fa-bar-chart" aria-hidden="true"></i>
		</a>
		
	</div>
	<div class="box-body">
		
		
		<div class="row">
			<div class="col-md-6">
				<div class="headers">
					<p>
						<b>Cliente:</b> <a href="/clients/{{$project->clientId}}">{{Repo\Client::find($project->clientId)->name}}</a>
					</p>
					<p>
						<b>Creado:</b> {{$project->created_at}}
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
            		{{$modifier->amount}}@if($modifier->type==1)%@endif
            	</p>
        	@endforeach
		</div>
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
					Sumatoria Total
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
				<h4 style="text-align: right;">Total: {{number_format($totalInPartities, 2)}}</h4>
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
</div>
@stop