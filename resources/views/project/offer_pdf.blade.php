<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<head>
	<title>Oferta Económica</title>
	<style type="text/css">
		body {
			font-size:11px;
			font-family: Helvetica;
		}
		table{
			width: 100%;
		}
		.text-right{
			text-align: right;
		}
		.page-break {
		    page-break-after: always;
		}
		.price-separate{
			margin-bottom: .5em;
		}
		p{
			margin: 0.25em 0;
		}
		h3{
			margin: 0;
		}
		.table{
			border-collapse: collapse;
			border-spacing:0 5px;
		}
		.table thead tr th{
			text-align: center;
			border-top: 1px solid #e77817; 
			border-bottom: 1px solid #e77817; 
	  		border-collapse:separate; 
	  		border-spacing:5px 5px;
	  	} 
	  	.border-left{
	  		border-left: 1px solid #e77817; 
	  	}
	  	.border-right{
	  		border-right: 1px solid #e77817; 
	  	}

		.table td{
			border:1px solid #ccc;
			text-align: right;
			padding: .25em;
		}
		.table td.non{
			border: none;
		}
		td.center{
			text-align: center;
		}
		td.left{
			text-align: left;
		}

		.col-1{
			width: 12.5%;
		}
		.col-2{
			width: 25%;
		}
		.col-3{
			width: 37.5%;
		}
		.col-4{
			width: 50%;
		}
		.col-7{
			width: 87.5%;
		}
		.row{
			overflow: auto;
		}

		.col-half{
			display: inline-block;
			width: 45%;
		}
		.table2{
    		border-collapse:collapse !important;
    		border: 1px solid #000;
		}
		.table2, .table2 tr, .table2 td{
		    padding:0 !important;
		    margin:0 !important;

		}
		.table2 td.borderer{
			border:1px solid #000;
			text-align: center;
			background: #ddd;
		}
		
		.border{
			border:1px solid #000;
		}

		.table2.space tr, .table2.space td{
			padding: .5em !important;	
		}

		.table2 tbody td{
			font-size: 1.1em;
		}
		.right{
			text-align: right;
		}
	</style>
</head>
<body>

<table>
	<thead>
		<tr>
			<th style="width: 40%;"></th>
			<th style="width: 60%;"></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<img src="{{asset('images/logos/j1atjjNo.png')}}" style="" width="280" alt="logo">
			</td>
			<td>
				<table>
					<thead>
						<tr>
							<th class="col-1"></th>
							<th class="col-3"></th>
							<th class="col-1"></th>
							<th class="col-3"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<b>Cliente:</b>
							</td>
							<td>{{$project->client()->name}}</td>
							<td>
								<b>Fecha:</b>
							</td>
							<td>{{date('Y-m-d')}}</td>
						</tr>
						<tr>
							<td>
								<b>RIF:</b>
							</td>
							<td>{{$project->client()->rif}}</td>
							<td>
								<b>N°:</b>
							</td>
							<td>{{$project->id}}</td>
						</tr>
						<tr>
							<td>
								<b>Atención:</b>
							</td>
							<td colspan="3">{{$project->client()->address}}</td>
						</tr>
						<tr>
							<td colspan="4"><br></td>
						</tr>
						<tr>
							<td colspan="4">
								<h3>{{$project->name}}</h3>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>

<br>

<div style="background: #ccc;">
	<table class="table2">
		<thead>
			<tr>
				<td style="width: 40%;"></td>
				<td style="width: 60%;"></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<h2 style="text-align: center;">
					DETALLE DEL REQUERIMIENTO
					</h2>
				</td>
				<td>
					<table class="table2">
						<thead>
							<tr>
								<th style="width: 20%;"></th>
								<th style="width: 20%;"></th>
								<th style="width: 20%;"></th>
								<th style="width: 20%;"></th>
								<th style="width: 20%;"></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="5">
									<h3 style="text-align: center;">DETALLE DE LA OFERTA ECONÓMICA</h3>
								</td>
							</tr>
							<tr>
								<td class="borderer"><h2>(A)</h2></td>
								<td class="borderer"><h2>(B)</h2></td>
								<td class="borderer"><h2>(C)</h2></td>
								<td class="borderer"><h2>(D)</h2></td>
								<td class="borderer"><h2>(E)</h2></td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</div>



		<table class="table2 space">

			<thead>
				<tr style="background: #e77817; text-align: center;">
					<th class="border" style="width:5%;">POS</th>
					<th class="border" style="width:35%;">DESCRIPCIÓN DEL MATERIAL</th>
					<th class="border" style="width:6%;">CANT</th>
					<th class="border" style="width:6%;">UND</th>
					<th class="border" style="width:12%;">COMPONENTE IMPORTADO (USD)</th>
					<th class="border" style="width:12%;">COMPONENETE NACIONAL (BsF)</th>
					<th class="border" style="width:12%;">PRECIO UNITARIO Bs</th>
					<th class="border" style="width:12%;">TOTAL RENGLÓN Bs</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$totalInPartities = 0;
					$partitieNum = 1;
				?>
				@foreach ($project->partities() as $projectPartitie)
				<?php
						$calculator->calcPartitie(
							$projectPartitie->id,
							$projectPartitie->yield
						);
				?>
				<tr>
					<td class="border">
						{{$partitieNum++}}
					</td>
					<td class="border">
						<small>
						{{$projectPartitie->partitie()->name}}
						</small>
					</td>
					<td class="border">{{$projectPartitie->quantity}}</td>
					<td class="border">
						{{$projectPartitie->partitie()->unit()->abbreviature}}
					</td>
					<td class="border"></td>
					
					<td class="border">{{number_format($calculator->totalPartitie, 2)}}</td>
					<td class="border">{{number_format($calculator->totalPartitie, 2)}}</td>
					<td class="border">
						{{
						number_format($projectPartitie->quantity*$calculator->totalPartitie, 2)
						}}
					</td>
				</tr>
				<?php
					$totalInPartities += $projectPartitie->quantity*$calculator->totalPartitie;
				?>
				@endforeach
			</tbody>
		</table>

<table>
	<thead>
		<tr>
			<th style="width: 52%"></th>
			<th style="width: 48%"></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<table>
					<tr>
						<td>
							<h2>NOTA:</h2>
							<h3>70% ORDEN DE COMPRA, 30% AL FINALIZAR LA INSTALACION. PRECIOS SUJETOS A CAMBIO.</h3>
						</td>
					</tr>
					<tr>
						<td>
							Arpía Soluciones Tecnológicas, C.A, RIF.: J-31727106-8. Dir. Av. Libertador Edificio El Toscal Piso PB Local 5 y 6, Maturín Monagas Venezuela 6201. Telf. /Fax.: 58 291 
						</td>
					</tr>
				</table>
			</td>
			<td>
				<table>
					<thead>
						<tr>
							<th style="width: 50%"></th>
							<th style="width: 50%"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<b>
									OFERTA N°:
								</b>
							</td>
							<td>{{$project->id}}</td>
						</tr>
						<tr>
							<td>
								<b>
									TOTAL DE RENGLONES OFERTADOS:
								</b>
							</td>
							<td>{{count($project->partities())}}</td>
						</tr>
						<tr>
							<td>
								<b>
									PERIODO DE GARANTIA:
								</b>
							</td>
							<td>1 Año PARA LA ELECTRONICA </td>
						</tr>
						<tr>
							<td>
								<b>
									TIEMPO DE ENTREGA:
								</b>
							</td>
							<td>05 DIAS CONTINUOS DE EJECUCION</td>
						</tr>
						<tr>
							<td>
								<b>
									VALIDEZ DE OFERTA:
								</b>
							</td>
							<td>4 Dias HABILES.</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>

</body>
</html>

