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
		console.log('UNITARIO DE EQUIPOS: ' + (w1 = equipmentsTotal/partitie.yield));


		console.log('TOTAL MANO DE OBRA: ' + workforcesTotal);
		console.log('Factor de Costos Asociados al Salario: ' + (v1 = workforcesTotal*fcas/100))

		console.log('TOTAL MANO DE OBRA: ' + (v2= workforcesTotal + v1))
		console.log('UNITARIO DE MANO DE OBRA: ' + (v3 = v2 / partitie.yield))
		
		console.log('COSTO DIRECTO POR UNIDAD: ' + (recursos = materialsTotal + w1 + v3))
		console.log('% ADMINISTRACION Y GASTOS GENERALES: ' + (v4 = recursos * expenses/100))
		console.log('SUBTOTAL: ' + (v5 = recursos + v4))
		console.log('30% UTILIDAD: ' + (v6 = v5 * utility/100))
		console.log('SUBTOTAL: ' + (v5+v6))
	}
}

function agregarProcentaje(base, porcentage) {
	return base + base * porcentage / 100
}

partitieList = []

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
				Partitie.partities.push(data)
            })
    });
})

