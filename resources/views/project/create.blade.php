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
			<div class="space-childs">
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
						
						<input name="salary" type="number" class="form-control project-modifier" placeholder="Salario Minimo" autocomplete="off" />

						<input name="salaryBonus" type="number" class="form-control project-modifier" project-modifier placeholder="Bono de Alimentación" autocomplete="off" />
					</div>

					<div class="col-md-6">
						<p>
							<small>Modificadores</small>
						</p>
						
							<div class="input-group">
								<input name="expenses" id="expenses" type="number" class="form-control project-modifier" placeholder="Administración y gastos generales" autocomplete="off" />
								<div class="input-group-addon">%</div>
							</div>
						
							<div class="input-group">
								<input name="utility" id="utility" type="number" class="form-control project-modifier" placeholder="Utilidad + Comisión de ventas" autocomplete="off" />
								<div class="input-group-addon">%</div>
							</div>
						
							<div class="input-group">
								<input name="unexpected" id="unexpected" type="number" class="form-control project-modifier" placeholder="Imprevisto de compra" autocomplete="off" />
								<div class="input-group-addon">%</div>
							</div>
						
							<div class="input-group">
								<input name="fcas" id="fcas" type="number" class="form-control project-modifier" placeholder="Factor de Costos Asociados al Salario" autocomplete="off" />
								<div class="input-group-addon">%</div>
							</div>
							
							<div class="input-group">
								<input name="bonus" id="bonus" type="number" class="form-control project-modifier" placeholder="Bono Alimentacion/Hospedaje diario" autocomplete="off" />
							</div>
						
					</div>
				</div>


				
				<hr>
				
				<div class="row">
					<div class="col-md-12">
						<h3>Partidas <a href="#" id="modalactivate" data-toggle="modal" data-target="#myModal" class="btn btn-outline-success">Agregar</a>
						<span class="pull-right">
							Total: <span class="total-in-project">0.00</span>
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