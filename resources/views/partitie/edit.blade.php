@extends('partitie.partitie')
@section('sub-title', 'Crear')

@section('sub-content')
<style type="text/css">
	.add-material, .add-equipment, .add-workforce{
		display: block;
	    margin: .5em 0;
	    border: #ccc 1px solid;
	    padding: .5em;
	    text-decoration: none !important;
	    border-radius: .25rem;
	}
	.add-material:hover, .add-equipment:hover, .add-workforce:hover{
	    background: #eee;
	}
</style>
	<div class="box">
		<div class="box-body">
			<script type="text/javascript" src="{{asset('js/editPartitie.js')}}"></script>
				
			<form id="partitie-data" method="POST" class="space-childs">
				{{csrf_field()}}
				<div class="form-group">
					<label class="small">Nombre</label>
					<input name="name" type="text" class="form-control" placeholder="Nombre" autocomplete="off" value="{{$partitie->name}}" />
				</div>
				<div class="form-group">
					<label class="small">Código</label>
					<input name="reference" type="text" class="form-control" placeholder="Código" autocomplete="off" value="{{$partitie->reference}}" />
				</div>
				<div class="form-group">
					<label class="small">Rendimiento</label>
					<input name="yield" type="text" class="form-control" placeholder="Rendimiento" autocomplete="off" value="{{$partitie->yield}}" />
				</div>
				<div class="form-group">
					<label class="small">Unidad</label>
					<select class="form-control" name="unit">
						@foreach($units as $unit)
							@if($unit->id == $partitie->unit()->id)
								<option selected="selected" value="{{$unit->id}}">{{$unit->name}}</option>
							@else
								<option value="{{$unit->id}}">{{$unit->name}}</option>
							@endif
						@endforeach
					</select>
				</div>
	
			</form>
			
			<br>
			
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#mat" role="tab" href="#">
						Materiales
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#equip" role="tab" href="#">
						Equipos
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#work" role="tab" href="#">
						Mano de Obra
					</a>
				</li>
			</ul>
			
			<div class="tab-content">
	  			<div class="tab-pane active" id="mat" role="tabpanel">
					<br>
					<div id="material">
						<h3>Materiales <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-outline-success">Agregar</a>
						</h3>

						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Materiales</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<input type="text" name="search-materials" class="form-control col-md-7 input-close-btn" placeholder="Nombre del Material" />
										<button style="margin-top: -2px;" class="btn btn-outline-primary" id="search-materials">
										Buscar
										</button>
										<br>
										<div class="list-materials">
											
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
									</div>
								</div>
							</div>
						</div>
						<table class="table table-striped materials">
							<thead>
								<tr>
									<th></th>
									<th>Nombre</th>
									<th>Precio</th>
									<th>Cantidad</th>
									<th>Unidad</th>
								</tr>
							</thead>
							<tbody>
								@if(count($materials))
									@foreach($materials as $materialPartitie)
										<?php
											$materialPartitie->material();
										?>
										<tr>
											<td>
												<a class="remove-item" href="javascript:;">
													<i class="fa fa-times" aria-hidden="true"></i>
												</a>
											</td>
											<td>
												{{$materialPartitie->material->name}}
											</td>
											<td class="price">
												{{number_format($materialPartitie->material->lastCost(), 2)}}
											</td>
											<td class="quantity">
												<input type="text"
													name="qty"
													class="form-control  input-close-btn"
													data-item-id="{{$materialPartitie->material->id}}"
													value="{{$materialPartitie->quantity}}"
												/>
											</td>
											<td>
												{{$materialPartitie->material->unit->abbreviature}}
											</td>
										</tr>
									@endforeach
								@else
									<tr class="delete-if-not-empty">
										<td colspan="5">
											<p class="text-center">
												No se ha agregado ningun recurso de este tipo.
											</p>
										</td>
									</tr>
								@endif
							</tbody>
						</table>
						<h4 style="display: none;">Total: <span class="total-materials">0</span></h4>
					</div>
				</div>	
					
				<div class="tab-pane" id="equip" role="tabpanel">
					<br>
					<div id="equipment">
						<h3>Equipos <a href="#" data-toggle="modal" data-target="#equipmentModal" class="btn btn-outline-success">Agregar</a>
						</h3>
						
						<!-- Modal -->
						<div class="modal fade" id="equipmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLabel">Equipos</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						        <input type="text" name="search-equipments" class="form-control col-md-7 input-close-btn" placeholder="Nombre del Equipo" />
						        <a style="margin-top: -2px;" href="javascript:;" class="btn btn-outline-primary" id="search-equipments">
						        	Buscar
						        </a>
						        <br>
								<div class="list-equipments">
									
								</div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						      </div>
						    </div>
						  </div>
						</div>

						<table class="table table-striped equipments">
							<thead>
								<tr>
									<th></th>
									<th>Nombre</th>
									<th>Precio</th>
									<th>Cantidad</th>
									<th>Por Trabajador</th>
								</tr>
							</thead>
							<tbody>
								@if(count($equipments))
									@foreach($equipments as $partitieEquipment)
										<tr>
											<td>
												<a class="remove-item" href="javascript:;">
													<i class="fa fa-times" aria-hidden="true"></i>
												</a>
											</td>
											<td>
												{{$partitieEquipment->equipment->name}}
											</td>
											<td class="price">
												{{number_format($partitieEquipment->equipment->lastCost(), 2)}}
											</td>
											<td class="quantity">
												<input type="text"
												name="qty"
												class="form-control  input-close-btn"
												data-item-id="{{$partitieEquipment->equipment->id}}"
												value="{{$partitieEquipment->quantity}}"
												/>
											</td>
											<td>
												<label class="custom-control custom-checkbox">
													<input
														type="checkbox"
														class="custom-control-input"
														name="workers"
														@if($partitieEquipment->workers)
															value="on"
															checked 
														@else
															value="off"
														@endif
													>
													<span class="custom-control-indicator"></span>
												</label>
											</td>
										</tr>
									@endforeach
								@else
									<td colspan="6" class="delete-if-not-empty">
										<p class="text-center">
											No se ha agregado ningun recurso de este tipo.
										</p>
									</td>
								@endif
							</tbody>
						</table>
						<h4 style="display: none;">Total: <span class="total-equipments">0</span></h4>
					</div>

				</div>
				<div class="tab-pane" id="work" role="tabpanel">
					<br>
					<div id="workforce">
						<h3>Mano de Obra <a href="#" data-toggle="modal" data-target="#modalworkforce" class="btn btn-outline-success">Agregar</a>
						</h3>

						<!-- Modal -->
						<div class="modal fade" id="modalworkforce" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Mano de Obra</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<input type="text" name="search-workforces" class="form-control col-md-7 input-close-btn" placeholder="Nombre del Cargo" />
										<button  style="margin-top: -2px;" class="btn btn-outline-primary" id="search-workforces">
										Buscar
										</button>
										<br>
										<div class="list-workforces">
											
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
									</div>
								</div>
							</div>
						</div>
						<table class="table table-striped workforces">
							<thead>
								<tr>
									<th></th>
									<th>Cargo</th>
									<th>Salario</th>
									<th>Cantidad</th>
								</tr>
							</thead>
							<tbody>
								@if(count($workforces))
									@foreach($workforces as $partitieWorkforce)
										<tr>
											<td>
												<a class="remove-item" href="javascript:;">
													<i class="fa fa-times" aria-hidden="true"></i>
												</a>
											</td>
											<td>
												{{$partitieWorkforce->workforce->name}}
											</td>
											<td class="price">
												{{$partitieWorkforce->workforce->lastCost()}}%
											</td>
											<td class="quantity">
												<input 
													type="text"
													name="qty"
													class="form-control  input-close-btn"
													data-item-id="{{$partitieWorkforce->workforce->id}}"
													value="{{$partitieWorkforce->quantity}}"
												/>
											</td>
										</tr>
									@endforeach
								@else
									<tr class="delete-if-not-empty">
										<td colspan="6">
											<p class="text-center">
												No se ha agregado ningun recurso de este tipo.
											</p>
										</td>
									</tr>
								@endif
							</tbody>
						</table>
						<h4 style="display: none;">Total: <span class="total-workforces">0</span></h4>
					</div>
				</div>
			</div>

			<a class="btn btn-outline-secondary float-left" href="/partities/{{$partitie->id}}">Atrás</a>
			<button type="submit" class="btn btn-outline-warning float-right">
				Actualizar
			</button>
		</div>
	</div>
@stop