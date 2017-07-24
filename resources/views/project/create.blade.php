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

		.btn-group, .btn-group * {
    		margin-bottom: 0 !important;
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
						<select name="status" id="" class="form-control">
							<option>Estado</option>
							@foreach(Repo\State::get() as $status)
								<option value="{{$status->id}}">{{$status->name}}</option>
							@endforeach
						</select>
						<p>
							<small>Configuración Mano de Obra</small>
						</p>
						
						<input name="salary" type="text" class="form-control" placeholder="Salario Minimo" autocomplete="off" />

						<input name="salaryBonus" type="text" class="form-control" placeholder="Bono de Alimentación" autocomplete="off" />
					</div>

					<div class="col-md-6">
						<p>
							<small>Modificadores</small>
						</p>
						<input name="expenses" type="text" class="form-control" placeholder="% ADMINISTRACION Y GASTOS GENERALES" autocomplete="off" />
						<input name="utility" type="text" class="form-control" placeholder="% UTILIDAD + COMISON VENTAS" autocomplete="off" />
						<input name="unexpected" type="text" class="form-control" placeholder="% IMPREVISTO DE COMPRA" autocomplete="off" />
						<input name="bonus" type="text" class="form-control" placeholder="Bono Alimentacion/Hospedaje diario" autocomplete="off" />
						<input name="fcas" type="text" class="form-control" placeholder="Factor de Costos Asociados al Salario" autocomplete="off" />
					</div>
				</div>


				
				<hr>
				
				<div class="row">
					<div class="col-md-12">
						<h3>Partidas <a href="#" id="modalactivate" data-toggle="modal" data-target="#myModal" class="btn btn-outline-success">Agregar</a>
						<span class="pull-right">
							Total: 0.00
						</span>
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
					</div>
					<div class="col-md-12">
						<div style="display: none;">
							<table id="partities" class="table table-striped table-bordered">
								<thead class="thead-inverse">
									<th>Nombre</th>
									<th>Cantidad</th>
									<th>Materiales</th>
									<th>Gasto</th>
									<th>Mano de Obra</th>
									<th>Depreciación</th>
									<th>Utilidad</th>
									<th>Total Unitario</th>
									<th>Total Partida</th>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<div id="partities2" class="row">
							
						</div>
					</div>
				</div>

				<!--
<tr><td colspan="6" class="delete-if-not-empty">
							<p class="text-center">
								No se ha agregado ningun recurso de este tipo.
							</p>
						</td></tr>
				-->


				




				<input id="createProject" type="submit" class="btn btn-outline-success float-right" value="Crear" />
			</form>
		</div>
	</div>
@stop