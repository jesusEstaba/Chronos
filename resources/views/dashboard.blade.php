@extends('template.dashboard')
@section('activeId', 'dashboard')

@section('content')
	<h2>Panel de Control</h2>
	<div class="box">
		<div class="box-body">
			<div class="rowx">
				<div class="col-xs-3x">
					<div class="big-badge-num">
						<span class="badge-number">
							{{$numOfPartities}}
						</span>
						<span class="badge-title">Partidas</span>
					</div>
				</div>
				<div class="col-xs-3">
					<div class="big-badge-num">
						<span class="badge-number">
							{{$numOfMaterials}}
						</span>
						<span class="badge-title">Materiales</span>
					</div>
				</div>
				<div class="col-xs-3">
					<div class="big-badge-num">
						<span class="badge-number">
							{{$numOfEquipments}}
						</span>
						<span class="badge-title">Equipos</span>
					</div>
				</div>
				<div class="col-xs-3">
					<div class="big-badge-num">
						<span class="badge-number">
							{{$numOfWorkforces}}
						</span>
						<span class="badge-title">Mano de Obra</span>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop