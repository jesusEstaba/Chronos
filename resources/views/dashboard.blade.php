@extends('template.dashboard')
@section('activeId', 'dashboard')

@section('content')
	<h2>Panel de Control</h2>
	<div class="box">
		<div class="box-body">
			<div class="row" style="margin: 0;">
				<div class="col-md-4">
					<div class="card card-inverse card-warning p-3 text-center">
					    <blockquote class="card-blockquote">
					      	<h3>
					      		<i class="fa fa-folder-open"></i>
					      		 {{$numOfPartities}}
					      	</h3>
					    	<footer>
					    		<small>Partidas</small>
					    	</footer>
					    </blockquote>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card card-inverse card-primary p-3 text-center">
					    <blockquote class="card-blockquote">
					      	<h3>
					      		<i class="fa fa-object-group"></i>
					      		 {{$numOfProjects}}
					      	</h3>
					    	<footer>
					    		<small>Proyectos</small>
					    	</footer>
					    </blockquote>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card card-inverse card-danger p-3 text-center">
					    <blockquote class="card-blockquote">
					      	<h3>
					      		<i class="fa fa-address-card-o"></i>
					      		 {{$numOfClients}}
					      	</h3>
					    	<footer>
					    		<small>Clientes</small>
					    	</footer>
					    </blockquote>
					</div>
				</div>
			</div>
			<style type="text/css">
				.project-dashboard{
					border-bottom: 1px solid rgba(0,0,0,.125);
					padding: .5em;
				}
				.card-block .project-dashboard:last-child{
					border-bottom: none;
				}
				.project-dashboard a{
					display: block;
				}
				.card-header{
					text-align: center !important;
				}
				.card-block{
					padding: 0 !important;
				}
				.days{
					float: left;
				}
				.item-time{
					text-align: center;
					margin-top: .5em;
				}
				.card-blockquote .fa{
					    text-shadow: 0 2px 5px rgba(0,0,0,.26);
				}

			</style>
			<div class="row" style="margin: 1em 0;">
				<div class="col-md-6">
					<div class="card">
					  <div class="card-header">
					    Proyectos Recientes
					  </div>
					  <div class="card-block">
					  	@foreach($projectsRecents as $project)
					  		<div class="project-dashboard">
					  			<a href="/projects/{{$project->id}}">
					  				{{$project->name}}
					  			</a>
					  			<em class="text-muted">{{$project->updated_at}}</em>
					  		</div>
					  	@endforeach
					  </div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
					  <div class="card-header">
					    Proyectos Por Culminar
					  </div>
					  <div class="card-block">
						<?php
					  			
					  	

					  	Class DayBadge {
					  		public $color;
					  		public $number;
					  		public $name;
					  		private $totalDays;

					  		function __construct($project) {
					  			$this->totalDays = $this->daysLeft($project->start, $project->end);
					  			
					  			$this->number = $this->daysLeft($project->end, date('Y-m-d'));

					  			$porcentage = $this->totalDays / 3;

					  			if ($porcentage > $this->number) {
					  				$this->color = 'danger';
					  			} elseif ($porcentage*2 > $this->number) {
					  				$this->color = 'warning';
					  			} else {
					  				$this->color = 'success';
					  			}

					  			$this->name = $this->number > 1 ? 'Días' : 'Día';			
					  		}

					  		private function daysLeft($start, $end) {
						  		$date1 = new DateTime($start);  //current date or any date
								$date2 = new DateTime($end);   //Future date
								$diff = $date2->diff($date1)->format("%a");  //find difference
						  		return intval($diff);   //rounding days
					  		}
					  	}

					  	?>
					  	@if(count($projectsFinish))
					  		@foreach($projectsFinish as $project)
						  		<div class="project-dashboard">
						  			<p class="item-time">
						  				<?php $days = new DayBadge($project);?>
										
										<span class="days badge badge-{{$days->color}}"><!--esto debe ser por porcentaje-->
												{{$days->number}}<br>
											<small>
												{{$days->name}}
											</small>
											
										</small>
										</span>
						  				 <a href="/projects/{{$project->id}}">
						  				{{$project->name}}
						  				</a>
						  			</p>
						  		</div>
						  	@endforeach
					  	@else
					  		<div class="project-dashboard">
						  		<p class="item-time">
						  			<em>Sin proyectos por culminar</em>
						  		</p>
						  	</div>
					  	@endif
						
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop