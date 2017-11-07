@extends('config.config')
@section('sub-title', 'Inicio')

@section('sub-content')
<style type="text/css">
	.row{
		margin: 0;
	}
	textarea{
		min-height:120px;
	}
</style>
<div class="box">
	<div class="box-body">
		<div class="row">
			<div class="col-md-4">
				<form action="/configuration" method="POST">
					@foreach($configNumerics as $note)
						<div>
							<label for="{{$note->name}}">{{$note->name}}</label> 
							<input class="form-control" name="{{$note->name}}" value="{{$note->value}}" />
						</div>
						<br>
					@endforeach
					{{csrf_field()}}
					<input type="hidden" name="type" value="numerics" />
					<button class="btn btn-warning" type="submit">Actualizar</button>
				</form>
			</div>
			<div class="col-md-4">
				<form action="/configuration" method="POST">
					@foreach($configStrings as $note)
						<div>
							<label for="{{$note->name}}">{{$note->name}}</label> 
							<input class="form-control" name="{{$note->name}}" value="{{$note->value}}" />
						</div>
						<br>
					@endforeach
					{{csrf_field()}}
					<input type="hidden" name="type" value="strings" />
					<button class="btn btn-warning" type="submit">Actualizar</button>
				</form>
			</div>
			<div class="col-md-4">
				<form action="/configuration" method="POST">
					@foreach($configNotes as $note)
						<div>
							<label for="{{$note->name}}">{{$note->name}}</label> 
							<textarea class="form-control" name="{{$note->name}}">{{$note->value}}</textarea>
						</div>
						<br>
					@endforeach
					{{csrf_field()}}
					<input type="hidden" name="type" value="notes" />
					<button class="btn btn-warning" type="submit">Actualizar</button>
				</form>
			</div>
		</div>
		
	</div>
</div>
@stop