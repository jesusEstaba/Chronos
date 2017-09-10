@extends('partitie.partitie')
@section('sub-title', 'Inicio')

@section('sub-content')
<a href="/partities/create" class="btn btn-outline-success">Crear</a>

<div class="box">
	<div class="box-body">
		<form action="/partities" method="get">
			
			<p>
				<input type="text" name="search" placeholder="Buscar Partida" class="form-control col-md-3 input-close-btn" />
				<input type="submit" class="btn btn-outline-primary" value="Buscar" />
			</p>
			
		</form>
		@if(count($partities))
			<table class="table table-striped table-bordered">
				<thead>
					<th style="width: 20%;">Código</th>
					<th>Nombre</th>
					<th>
						Creador
					</th>
				</thead>
				<tbody>
					@foreach($partities as $partitie)
					<tr>
						<td>
							@if($partitie->reference)
								{{$partitie->reference}}
							@else
								<i>Sin codigo</i>
							@endif
						</td>
						<td>
							<a href="/partities/{{$partitie->id}}">
								{{$partitie->name}}
							</a>
						</td>
						<td>
							<a href="/users/{{$partitie->userId}}">{{Repo\User::find($partitie->userId)->name}}</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $partities->appends(['search' => $search])->links('vendor.pagination.bootstrap-4') }}
		@else
			<h4 class="text-center text-muted my-4">No se encontrarón resultados</h4>
		@endif
	</div>
</div>
@stop