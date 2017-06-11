@extends('project.project')
@section('sub-title', 'Crear')

@section('sub-content')
	<style type="text/css">
		.box-body .row{
			margin: 0 !important;
		}
		.box-body .row>div *{
			margin-bottom: .5em;
		}
	</style>
	<div class="box">
		<div class="box-body">
			<form class="space-childs" method="POST" action="/projects">
				<script type="text/javascript" src="{{asset('js/createPartitie.js')}}"></script>
				{{csrf_field()}}
				
				<div class="row">
					<div class="col-md-6">
						<p>
							<small>Configuración General</small>
						</p>
						<input name="name" type="text" class="form-control" placeholder="Nombre del Proyecto" autocomplete="off" />
						<textarea name="description" placeholder="Descripción de la Obra" class="form-control"></textarea>
						<select class="form-control" name="client">
							<option value="0" style="color:gray">Clientes</option>
							@foreach($clients as $client)
								<option value="{{$client->id}}">{{$client->name}}</option>
							@endforeach
						</select>
						<p>
							<small>Configuración Mano de Obra</small>
						</p>
						
						<input name="salario" type="text" class="form-control" placeholder="Salario Minimo" autocomplete="off" />

						<input name="bono" type="text" class="form-control" placeholder="Bono de Alimentación" autocomplete="off" />
					</div>

					<div class="col-md-6">
						<p>
							<small>Modificadores</small>
						</p>
						<input name="" type="text" class="form-control" placeholder="% ADMINISTRACION Y GASTOS GENERALES5" autocomplete="off" />
						<input name="" type="text" class="form-control" placeholder="% UTILIDAD + COMIISON VENTAS" autocomplete="off" />
						<input name="" type="text" class="form-control" placeholder="% IMPREVISTO DE COMPRA" autocomplete="off" />
						<input name="" type="text" class="form-control" placeholder="Bono Alimentacion/Hospedaje diario" autocomplete="off" />
						<input name="" type="text" class="form-control" placeholder="Factor de Costos Asociados al Salario" autocomplete="off" />
					</div>
				</div>


				
				<hr>
				
				<div class="row">
					
				</div>


				<h3>Partidas <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-outline-success">Agregar</a>
				</h3>

				<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Partidas</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<input type="text" name="search-partities" class="form-control col-md-7 input-close-btn" placeholder="Nombre de la Partida" />
								<button class="btn btn-outline-primary" id="search-partities">
								Buscar
								</button>
								<br>
								<div class="list-partities">
									
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>




				<input type="submit" class="btn btn-outline-success float-right" value="Crear" />
			</form>
		</div>
	</div>
@stop