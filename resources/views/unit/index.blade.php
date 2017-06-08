@extends('unit.unit')
@section('sub-title', 'Inicio')

@section('sub-content')

<a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-outline-success">Crear</a>
					
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Crear Unidad</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/units" method="POST">
				{{csrf_field()}}
				<div class="modal-body">
					<p>
						<input type="text" name="name" class="form-control input-close-btn" placeholder="Nombre de la Unidad" />
					</p>
					<p>
						<input type="text" name="abbreviature" class="form-control input-close-btn" placeholder="Abreviatura" />
					</p>
						
						
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<input type="submit" class="btn btn-outline-success" id="create-unit" value="Crear" />
				</div>
			</form>
		</div>
	</div>
</div>




<div class="box">
	<div class="box-body">
		<form action="/units" method="get">
			
			<p>
				<input type="text" name="search" placeholder="Buscar Categoria" class="form-control col-md-3 input-close-btn" />
				<input type="submit" class="btn btn-outline-primary" value="Buscar" />
			</p>
			
		</form>
		@if(count($units))
			<table class="table table-striped table-bordered">
				<thead>
					<th>Nombre</th>
					<th>Abreviatura</th>
				</thead>
				<tbody>
					@foreach($units as $unit)
					<tr>
						<td>
							{{$unit->name}}
						</td>
						<td>
							{{$unit->abbreviature}}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $units->appends(['search' => $search])->links('vendor.pagination.bootstrap-4') }}
		@else
			<h4 class="text-center text-muted my-4">No se encontrarón resultados</h4>
		@endif
	</div>
</div>
@stop