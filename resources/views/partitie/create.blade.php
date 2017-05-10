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
										$('.list-materials').append(`<div style="margin:.5em 0;">
											<a href="javascript:;" class="add-material btn btn-outline-success" data-material="${material.id}">
												<i class="fa fa-plus" aria-hidden="true"></i>
											</a>
											<span class="name">${material.name}</span>
										<div>`);
									});

									$('[name="search-materials"]').val("");
								})
								.fail(function() {
									console.log("error");
								});
							});

							$('.list-materials').on('click', '.add-material',function(e) {
								e.preventDefault();
								$('.materials').append(`<div class="material-item" style="margin:.5em 0;">
									<a class="remove-item" href="javascript:;">
										<i class="fa fa-times" aria-hidden="true"></i>
									</a>
									<input type="text" name="qty-material" class="form-control col-md-1 input-close-btn" data-material-id="${$(this).attr('data-material')}"/>
									${$(this).siblings('.name').html()}
									
									</div>`);
							});


							$('.materials').on('click', '.remove-item',function(e) {
								e.preventDefault();
								$(this).parent().remove();
							});

							//EQUIPMENT

							$('#search-equipment').on('click', function(e) {
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
										$('.list-equipments').append(`<div style="margin:.5em 0;">
											<a href="javascript:;" class="add-equipment btn btn-outline-success" data-equipment="${equipment.id}">
												<i class="fa fa-plus" aria-hidden="true"></i>
											</a>
											<span class="name">${equipment.name}</span>
										<div>`);
									});

									$('[name="search-equipments"]').val("");
								})
								.fail(function() {
									console.log("error");
								});
							});

							$('.list-equipments').on('click', '.add-equipment',function(e) {
								e.preventDefault();
								$('.equipments').append(`<div class="equipment-item" style="margin:.5em 0;">
									<a class="remove-item" href="javascript:;">
										<i class="fa fa-times" aria-hidden="true"></i>
									</a>
									<input type="text" name="qty-equipment" class="form-control col-md-1 input-close-btn" data-equipment-id="${$(this).attr('data-equipment')}"/>
									${$(this).siblings('.name').html()}
									
									</div>`);
							});


							$('.equipments').on('click', '.remove-item',function(e) {
								e.preventDefault();
								$(this).parent().remove();
							});

							//GLOBAL

							$('[type="submit"]').on('click', function(e) {
								e.preventDefault();
								if (!$(this).hasClass('active')) {
									$(this).addClass('active').attr('disabled', true);

									var materials = [],
										equipments = [];

									$('[name="qty-material"]').each(function() {
										materials.push({
											"id": $(this).attr('data-material-id'),
											"qty": $(this).val()
										});
									});

									$('[name="qty-equipment"]').each(function() {
										equipments.push({
											"id": $(this).attr('data-equipment-id'),
											"qty": $(this).val()
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
					<h5>Materiales</h5>
					
					<a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-outline-success">Agregar</a>
					
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
					
					<div class="materials">
						
					</div>
				</div>
					
				<br>

				<div id="equipment">
					<h5>Equipos</h5>
					
					<a href="#" data-toggle="modal" data-target="#equipmentModal" class="btn btn-outline-success">Agregar</a>
					
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
					        <a href="javascript:;" class="btn btn-outline-primary" id="search-equipment">
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

					<div class="equipments">
						
					</div>
				</div>

			<input type="submit" class="btn btn-outline-success float-right" value="Crear" />
		</div>
	</div>
@stop