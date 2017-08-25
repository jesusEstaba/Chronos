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
	</style>
</head>
<body>
<div class="row">
	<div class="col-half">
		<img src="{{asset('images/logos/j1atjjNo.png')}}" style="display: block;float: left;" width="280" height="100" alt="logo">
	</div>
	<div class="col-half" style="background: yellow;">
		<p>
			{{$project->name}}
		</p>
	</div>
</div>


<div class="row">
	<div class="col-full">
		<table class="table">
			<thead>
				<tr>
					<th>POS</th>
					<th>DESCRIPCIÓN DEL MATERIAL</th>
					<th>CANT</th>
					<th>UND</th>
					<th>COMPONENTE IMPORTADO (USD)</th>
					<th>COMPONENETE NACIONAL (BsF)</th>
					<th>PRECIO UNITARIO Bs</th>
					<th>TOTAL RENGLÓN Bs</th>
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
							$projectPartitie->partitie()->yield
						);
				?>
				<tr>
					<td>
						{{$partitieNum++}}
					</td>
					<td>
						<small>
						{{$projectPartitie->partitie()->name}}
						</small>
					</td>
					<td>{{$projectPartitie->quantity}}</td>
					<td>
						{{$projectPartitie->partitie()->unit()->abbreviature}}
					</td>
					<td></td>
					
					<td>{{number_format($calculator->totalPartitie, 2)}}</td>
					<td>{{number_format($calculator->totalPartitie, 2)}}</td>
					<td>
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
	</div>
</div>
	
</body>
</html>

