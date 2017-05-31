@extends('partitie.partitie')
@section('sub-title', 'Crear')

@section('sub-content')
	<div class="box">
		<div class="box-body">
			<form id="partitie-data" method="POST" class="space-childs">
				{{csrf_field()}}
				<input name="name" type="text" class="form-control" placeholder="Nombre" autocomplete="off" />
				<input name="yield" type="text" class="form-control" placeholder="Rendimiento" autocomplete="off" />
				<select class="form-control" name="unit">
					@foreach($units as $unit)
					<option value="{{$unit->id}}">{{$unit->name}}</option>
					@endforeach
				</select>			
			</form>
			
			<br>

			<div id="material">
					<script type="text/javascript">
						$(function() {
							//MATERIAl
							var materialList = [];

							$('#search-materials').on('click', function(e) {
								e.preventDefault();

								$.ajax({	
									url: '/search/materials',
									type: 'POST',
									dataType: 'json',
									data: {
										search: $('[name="search-materials"]').val(),
										"_token": $('[name="_token"]').val(),
									}
								})
								.done(function(data) {
									$('.list-materials').html("");

									data.forEach((material) => {
										if (!materialList.some(id => id == material.id)) {
											$('.list-materials').append(`<div style="margin:.5em 0;">
												<a href="javascript:;" 
													class="add-material btn btn-outline-success"
													data-material="${material.id}"
													data-material-unit="${material.unitId}"
													data-material-price="${material.price}"
												>
													<i class="fa fa-plus" aria-hidden="true"></i>
												</a>
												<span class="name">${material.name}</span>
											<div>`);
										}
										
									});

									$('[name="search-materials"]').val("");
								})
								.fail(function() {
									console.log("error");
								});
							});

							$('.list-materials').on('click', '.add-material',function(e) {
								e.preventDefault();
								
								materialList.push($(this).attr('data-material'));

								$(this).parent().remove();
								$('.materials tbody').append(`<tr>
									<td>
										<a class="remove-item" href="javascript:;">
											<i class="fa fa-times" aria-hidden="true"></i>
										</a>
									</td>
									<td>
										${$(this).siblings('.name').html()}
									</td>
									<td class="price">
										${$(this).attr('data-material-price')}
									</td>
									<td class="quantity">
										<input type="text" 
											name="qty" 
											class="form-control  input-close-btn" 
											data-item-id="${$(this).attr('data-material')}"
											value="1"
										/>
									</td>
									<td>
										${$(this).attr('data-material-unit')}
									</td>
									<td>
										<label class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input"
										  	name="uniq">
										  <span class="custom-control-indicator"></span>
										</label>
									</td>
								</tr>`);
								totalInMaterials();
							});


							$('.materials').on('click', '.remove-item',function(e) {
								e.preventDefault();
								$(this).parent().parent().remove();
								totalInMaterials();
							});

							$('.materials').on('keyup', '[name="qty"]',function(e) {
								if (!isNaN($(this).val())) {
									totalInMaterials();
								}
							});

							function totalInMaterials() {
								var total = 0;

								$('.materials tbody tr').each(function(index, el) {
									var price = Number($(el).children('.price').html()),
										qty = Number($(el).children('.quantity').children('input').val());
									
									if (!isNaN(qty)) {
										total += price * qty;	
									}
									
								});

								$('.total-materials').html(total.toFixed(2));
							}

							//EQUIPMENT

							var equipmentList = [];

							$('#search-equipments').on('click', function(e) {
								e.preventDefault();

								$.ajax({	
									url: '/search/equipments',
									type: 'POST',
									dataType: 'json',
									data: {
										search: $('[name="search-equipments"]').val(),
										"_token": $('[name="_token"]').val(),
									}
								})
								.done(function(data) {
									$('.list-equipments').html("");

									data.forEach((equipment) => {
										if (!equipmentList.some(id => id == equipment.id)) {
											$('.list-equipments').append(`<div style="margin:.5em 0;">
												<a href="javascript:;" 
													class="add-equipment btn btn-outline-success"
													data-equipment="${equipment.id}"
													data-equipment-price="${equipment.price}"
												>
													<i class="fa fa-plus" aria-hidden="true"></i>
												</a>
												<span class="name">${equipment.name}</span>
											<div>`);
										}
										
									});

									$('[name="search-equipments"]').val("");
								})
								.fail(function() {
									console.log("error");
								});
							});

							$('.list-equipments').on('click', '.add-equipment',function(e) {
								e.preventDefault();
								
								equipmentList.push($(this).attr('data-equipment'));

								$(this).parent().remove();
								$('.equipments tbody').append(`<tr>
									<td>
										<a class="remove-item" href="javascript:;">
											<i class="fa fa-times" aria-hidden="true"></i>
										</a>
									</td>
									<td>
										${$(this).siblings('.name').html()}
									</td>
									<td class="price">
										${$(this).attr('data-equipment-price')}
									</td>
									<td class="quantity">
										<input type="text" 
											name="qty" 
											class="form-control  input-close-btn" 
											data-item-id="${$(this).attr('data-equipment')}"
											value="1"
										/>
									</td>
									<td>
										<label class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="uniq">
										  <span class="custom-control-indicator"></span>
										</label>
									</td>
									<td>
										<label class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input"
										  	name="workers">
										  <span class="custom-control-indicator"></span>
										</label>
									</td>
								</tr>`);
								totalInEquipments();
							});


							$('.equipments').on('click', '.remove-item',function(e) {
								e.preventDefault();
								$(this).parent().parent().remove();
								totalInEquipments();
							});

							$('.equipments').on('keyup', '[name="qty"]',function(e) {
								if (!isNaN($(this).val())) {
									totalInEquipments();
								}
								
							});

							function totalInEquipments() {
								var total = 0;

								$('.equipments tbody tr').each(function(index, el) {
									var price = Number($(el).children('.price').html()),
										qty = Number($(el).children('.quantity').children('input').val());
									
									if (!isNaN(qty)) {
										total += price * qty;	
									}
									
								});

								$('.total-equipments').html(total.toFixed(2));
							}

							//GLOBAL

							$('[type="submit"]').on('click', function(e) {
								e.preventDefault();
								if (!$(this).hasClass('active')) {
									$(this).addClass('active').attr('disabled', true);

									var materials = [],
										equipments = [];

									$('.materials tbody tr').each(function() {
										materials.push({
											'id': $(this).find('[name="qty"]').attr('data-item-id'),
											'qty': $(this).find('[name="qty"]').val(),
											'uniq': $(this).find('[name="uniq"]').val(),
											'workers': $(this).find('[name="workers"]').val()
										});
									});

									$('.equipments tbody tr').each(function() {
										equipments.push({
											'id': $(this).find('[name="qty"]').attr('data-item-id'),
											'qty': $(this).find('[name="qty"]').val(),
											'uniq': $(this).find('[name="uniq"]').val(),
											'workers': $(this).find('[name="workers"]').val()
										});
									});

									$.ajax({
										url: '/partities',
										type: 'POST',
										dataType: 'json',
										data: {
											"name": $('[name="name"]').val(),
											"yield": $('[name="yield"]').val(),
											"unit": $('[name="unit"]').val(),
											"category": $('[name="category"]').val(),
											"materials": materials,
											"equipments": equipments,
										},
										headers: {
        									'X-CSRF-TOKEN': $('[name="_token"]').val()
    									}
									})
									.done(function() {
										window.location.href = "/partities";
									})
									.fail(function() {
										console.log("error");
									});
									
								}//end if
							});

							
						})
					</script>
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
					        <button class="btn btn-outline-primary" id="search-materials">
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
						<thead class="thead-inverse">
							<tr>
								<th></th>
								<th>Nombre</th>
								<th>Precio</th>
								<th>Cantidad</th>
								<th>Unidad</th>
								<th>Unico</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
					<h4>Total: <span class="total-materials">0</span></h4>
				</div>
					
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
					        <a href="javascript:;" class="btn btn-outline-primary" id="search-equipments">
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
						<thead class="thead-inverse">
							<tr>
								<th></th>
								<th>Nombre</th>
								<th>Precio</th>
								<th>Cantidad</th>
								<th>Unico</th>
								<th>Por Trabajador</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
					<h4>Total: <span class="total-equipments">0</span></h4>
				</div>

			<input type="submit" class="btn btn-outline-success float-right" value="Crear" />
		</div>
	</div>
@stop