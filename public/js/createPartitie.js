var Partitie = {
	partities : [],
	calcMaterials(materials) {
		var imprevisto = Number($('[name=unexpected]').val())
		return materials.reduce((a, m) => a + agregarProcentaje(m.cost, imprevisto) * m.quantity, 0)
	},
	calcEquipments(equipments) {
		return equipments.reduce((a, e) => a + e.cost * e.depreciation * e.quantity, 0)
	},
	calcWorkforces(workforces) {
		var salario = Number($('[name=salary]').val()) ,
			bono = Number($('[name=salaryBonus]').val())

		return workforces.reduce((a, w) => a + ((bono + agregarProcentaje(salario, w.cost)) / 30) * w.quantity, 0)
	},
	calcPartitie(partitie) {
		var materialsTotal = this.calcMaterials(partitie.materials),
			equipmentsTotal = this.calcEquipments(partitie.equipments),
			workforcesTotal = this.calcWorkforces(partitie.workforces)

		var fcas = Number($('[name=fcas]').val())
			expenses = Number($('[name=expenses]').val()),
			utility = Number($('[name=utility]').val()),
			unexpected = Number($('[name=unexpected]').val()),
			bonus = Number($('[name=bonus]').val())

		console.log('TOTAL MATERIALES: ' + materialsTotal);
		
		
		console.log('TOTAL EQUIPOS: ' + equipmentsTotal);
		console.log('UNITARIO DE EQUIPOS: ' + (unitaryEquip = equipmentsTotal/partitie.yield));


		console.log('TOTAL MANO DE OBRA: ' + workforcesTotal);
		console.log('Factor de Costos Asociados al Salario: ' + (totalfcas = workforcesTotal*fcas/100))

		console.log('TOTAL MANO DE OBRA: ' + (totalwork= workforcesTotal + totalfcas))
		console.log('UNITARIO DE MANO DE OBRA: ' + (unitarywork = totalwork / partitie.yield))
		
		console.log('COSTO DIRECTO POR UNIDAD: ' + (recursos = materialsTotal + unitaryEquip + unitarywork))
		console.log('% ADMINISTRACION Y GASTOS GENERALES: ' + (totalexpenses = recursos * expenses/100))
		console.log('SUBTOTAL: ' + (subtotal = recursos + totalexpenses))
		console.log('30% UTILIDAD: ' + (totalUtility = subtotal * utility/100))
		console.log('SUBTOTAL: ' + (totalPartitie = subtotal + totalUtility))

		$('#partities2').append(templatePartitie2({
			name: partitie.name,
			materials: materialsTotal,
			expenses: totalexpenses,
			workforce: unitarywork,
			depreciation: unitaryEquip,
			utility: totalUtility,
			unitary: totalPartitie,
			partitie: totalPartitie
		}))
	}
}

function validateFieldsIsNotEmpty() {
	var isEmpty;

	$('.box-body input[type=text]:not([name=search-partities])').each((i, e) => {
		if (!$(e).val()) {
			isEmpty = true;
		}
	})

	return isEmpty;
}

function agregarProcentaje(base, porcentage) {
	return base + base * porcentage / 100
}

partitieList = []


function templatePartitie2(partitie) {
	return `
	<div class="col-md-6">
	<div class="partitie" style="border: 1px solid rgba(0,0,0,.15);padding: .5em;border-radius: .25rem;">
		<header>
			<h5 style="color:#605f52;">
				${partitie.name}
			</h5>
		</header>
		
		<div class="row">
			<div class="col-md-6">
				<p>
					<b>Materiales:</b> <br /> ${partitie.materials.toFixed(2)}
				</p>
				<p>
					<b>Depreciación:</b> <br /> ${partitie.depreciation.toFixed(2)}
				</p>
				<p>
					<b>Mano de Obra:</b> <br /> ${partitie.workforce.toFixed(2)}
				</p>
			</div>
			<div class="col-md-6">
				<p>
					<b>Gastos Administrativos:</b> <br /> ${partitie.expenses.toFixed(2)}
				</p>
				<p>
					<b>utilidad:</b> <br /> ${partitie.utility.toFixed(2)}
				</p>
				<p>
					<b>Total Precio Unitario:</b> <br /> ${partitie.unitary.toFixed(2)}
				</p>
			</div>
		</div>

		<h6 style="color: #0275d8;">
			<b>Total Partida:</b> ${partitie.partitie.toFixed(2)}
		</h6>
	</div>
</div>`
}


function templatePartitie(partitie) {
	return `
	<tr>
		<td>${partitie.name}</td>
		<td><input type="text" value="1"/></td>
		<td>${partitie.materials}</td>
		<td>${partitie.expenses}</td>
		<td>${partitie.workforce}</td>
		<td>${partitie.depreciation}</td>
		<td>${partitie.utility}</td>
		<td>${partitie.unitary}</td>
		<td>${partitie.partitie}</td>
	</tr>`
}


$(() => {
    $('#search-partities').on('click', (e) => {
        e.preventDefault();
        $.ajax({
                url: '/search/partities',
                type: 'POST',
                dataType: 'json',
                data: {
                    search: $('[name="search-partities"]').val(),
                    "_token": $('[name="_token"]').val(),
                }
            })
            .done(data => {
                $('.list-partities').html("");

                data.forEach((partitie) => {
                    if (!partitieList.some(id => id == partitie.id)) {
                        $('.list-partities').append(`
                        	<div style="margin:.5em 0;">
								<a href="javascript:;"
									class="add-partitie btn btn-outline-success"
									data-partitie="${partitie.id}"
								>
									<i class="fa fa-plus" aria-hidden="true"></i>
								</a>
								<span class="name">${partitie.name}</span>
							<div>`
						);
                    }

                });

                $('[name="search-partities"]').val("");

            })
    });

    $('.list-partities').on('click', '.add-partitie', function(e) {
    	e.preventDefault();

    	var idPartitie = $(this).attr('data-partitie');
    	
    	$(this).parent().remove();
    	
    	$.ajax({
                url: '/search/partitie',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: idPartitie,
                    "_token": $('[name="_token"]').val(),
                }
            })
            .done(data => {
				//materialList.push(idPartitie);
				data.quantity = 1
				Partitie.partities.push(data)

				Partitie.calcPartitie(Partitie.partities[Partitie.partities.length - 1])
            })
    });

    $('#createProject').on('click', function(event) {
    	event.preventDefault();
    	console.log("sds");

    	if (!validateFieldsIsNotEmpty()) {
    		$.ajax({
                url: '/projects',
                type: 'POST',
                dataType: 'json',
                data: {
                	"_token": $('[name="_token"]').val(),
                	partities:  Partitie.partities,

                	name: $('[name=name]').val(),
					description: $('[name=description]').val(),
					client: $('[name=client]').val(),
					salary: $('[name=salary]').val(),
					salaryBonus: $('[name=salaryBonus]').val(),

                    fcas: Number($('[name=fcas]').val()),
					expenses: Number($('[name=expenses]').val()),
					utility: Number($('[name=utility]').val()),
					unexpected: Number($('[name=unexpected]').val()),
					bonus: Number($('[name=bonus]').val())
                }
            })
            .done(data => {
				if (data.status=="redirect") {
					window.location.href="/projects"
				} else {
					alert('Algo no salio bien...')
				}
            })
    	} else {
    		alert("campos vacios")
    	}
    });

    $('#modalactivate').on('click', function(event) {
    	if (validateFieldsIsNotEmpty()) {
    		event.preventDefault();
    		event.stopPropagation()
    		alert("campos vacios")
    	}
    	
    });
})

