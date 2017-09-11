<div class="box">
	<div class="box-body">
		<a href="/{{$name}}/{{$resource->id}}/edit" class="btn btn-outline-warning">
			<i class="fa fa-pencil" aria-hidden="true"></i> Editar
		</a>

		@if($resource->disabled)
			<a href="/{{$name}}/{{$resource->id}}/enabled" class="btn btn-outline-info pull-right">
				<i class="fa fa-eye" aria-hidden="true"></i> Activar
			</a>
		@else
			<a href="/{{$name}}/{{$resource->id}}/disabled" class="btn btn-outline-secondary pull-right">
				<i class="fa fa-eye-slash" aria-hidden="true"></i> Desactivar
			</a>
		@endif
	</div>
</div>