var Partitie = {
	fcas: 0,
	expenses: 0,
	utility: 0,
	unexpected: 0,
	bonus: 0,
	salary: 0,
	salaryBonus: 0,
	days: 30,
	partities : [],
	calcMaterials(materials) {
		return materials.reduce((a, material) => 
			a + agregarProcentaje(material.cost, this.unexpected) * material.quantity, 0
		)
	},
	calcEquipments(equipments) {
		return equipments.reduce((a, equipment) => 
			a + equipment.cost * equipment.depreciation * equipment.quantity, 0
		)
	},
	calcWorkforces(workforces) {
		return workforces.reduce((a, workforce) => 
			a + ((this.salaryBonus + agregarProcentaje(this.salary, workforce.cost)) / this.days) * workforce.quantity, 0
		)
	},
	calcPartitie(partitie) {
		var materialsTotal = this.calcMaterials(partitie.materials),
			equipmentsTotal = this.calcEquipments(partitie.equipments),
			workforcesTotal = this.calcWorkforces(partitie.workforces)

		unitaryEquip = equipmentsTotal/partitie.yield

		totalfcas = workforcesTotal*this.fcas/100

		totalwork= workforcesTotal + totalfcas
		unitarywork = totalwork / partitie.yield
		
		recursos = materialsTotal + unitaryEquip + unitarywork
		totalexpenses = recursos * this.expenses/100
		subtotal = recursos + totalexpenses
		totalUtility = subtotal * this.utility/100
		totalPartitie = subtotal + totalUtility

		return {
			partitie: partitie,
			materials: materialsTotal,
			expenses: totalexpenses,
			workforce: unitarywork,
			depreciation: unitaryEquip,
			utility: totalUtility,
			unitary: totalPartitie,
			totalPartitie: totalPartitie * partitie.quantity,
		}
	},
	addPartitie(data) {
		data.quantity = 1
		data.magnitude = 1
		data.position = this.partities.length
		this.partities.push(data)

		return templatePartitie2(this.calcPartitie(data))
	},
	updateHeaderPartitie(position) {
		let partitie = this.partities[position]
		
		return partitieHeadersTemplate(this.calcPartitie(partitie))
	},
	updateFooterPartitie(position) {
		let partitie = this.partities[position]
		return partitieFooterTemplate(this.calcPartitie(partitie))
	},
	updateAll(){
		let allPartitiesHTML = '';
		
		this.partities.forEach(function(partitie) {
			allPartitiesHTML += `<div class="col-md-6">${templatePartitie2(this.calcPartitie(partitie))}</div>`
		}.bind(this))

		return allPartitiesHTML
	},
	getTotalInProject(){
		let total = 0;
		
		this.partities.forEach(function(partitie){
			total += this.calcPartitie(partitie).totalPartitie
		}.bind(this))

		return total
	},
	removePartitie(position) {
		this.partities.splice(position, 1)
		let index = 0

		this.partities.forEach(function(partitie){
			partitie.position = index++
		})
	}
}

function validateFieldsIsNotEmpty() {
	var isEmpty;

	$('.box-body input[type=text]:not([name=search-partities])').each((i, e) => {
		if (!$(e).val()) {
			isEmpty = true;
		}
	})

	if ($(".box-body [name=client]").val()=="0") {
		isEmpty = true;
	}

	return false;
}

function agregarProcentaje(base, porcentage) {
	
	return base + base * porcentage / 100
}

function templatePartitie2(partitie) {
	return `<div class="partitie" style="border: 1px solid rgba(0,0,0,.15);padding: .5em;border-radius: .25rem;">

		<div class="modal-header">
          <h5 class="modal-title" style="color:#605f52;">${partitie.partitie.name}</h5>
          <button class="close remove-partitie" data-position="${partitie.partitie.position}">
            <span aria-hidden="true">×</span>
          </button>
        </div>

		<div class="row partitie-header">
			${partitieHeadersTemplate(partitie)}
		</div>
		<div class="row">
			<div class="col-md-12">
				<input name="quantity" data-position="${partitie.partitie.position}" value="${partitie.partitie.quantity}" placeholder="Cantidad" class="form-control partitie-modificator" type="number" pattern="^[0-9]" min="0" step="any">
				<input name="magnitude" data-position="${partitie.partitie.position}" value="${partitie.partitie.magnitude}" placeholder="Magnitud" class="form-control partitie-modificator" type="number" min="0" step="any">
				<input name="yield" data-position="${partitie.partitie.position}" value="${partitie.partitie.yield.toFixed(2)}" placeholder="Rendimiento" class="form-control partitie-modificator" type="number" min="0.01" step="any">
			</div>
		</div>

		<h6 style="color: #0275d8;" class="partitie-footer">
			${partitieFooterTemplate(partitie)}
		</h6>
	</div>`
}

function partitieHeadersTemplate(partitie) {
	return `
			<div class="col-md-6">
				<p>
					<b>Materiales:</b> <br /> ${partitie.materials.formatMoney()}
				</p>
				<p>
					<b>Depreciación:</b> <br /> ${partitie.depreciation.formatMoney()}
				</p>
				<p>
					<b>Mano de Obra:</b> <br /> ${partitie.workforce.formatMoney()}
				</p>
			</div>
			<div class="col-md-6">
				<p>
					<b>Gastos Administrativos:</b> <br /> ${partitie.expenses.formatMoney()}
				</p>
				<p>
					<b>Utilidad:</b> <br /> ${partitie.utility.formatMoney()}
				</p>
				<p>
					<b>Total Precio Unitario:</b> <br /> ${partitie.unitary.formatMoney()}
				</p>
			</div>`
}

function partitieFooterTemplate(partitie) {
	return `
	<b>Total Partida:</b> ${partitie.totalPartitie.formatMoney()}
	`
}



partitieList = []

$(document).on('change keyup', '.partitie-modificator',function(e) {
	let position = $(this).attr('data-position'),
		father = $(this).parents('.partitie'),
		partitie = Partitie.partities[position]

	partitie.quantity = Number(father.find('[name="quantity"]').val())
	partitie.magnitude = Number(father.find('[name="magnitude"]').val())
	partitie.yield = Number(father.find('[name="yield"]').val())

	father.find('.partitie-header').html(Partitie.updateHeaderPartitie(position))
	father.find('.partitie-footer').html(Partitie.updateFooterPartitie(position))
	
	$('.total-in-project').html(Partitie.getTotalInProject().formatMoney())
})

$(document).on('click', '.remove-partitie', function(event) {
	event.preventDefault();
	/* Act on the event */
	Partitie.removePartitie($(this).attr('data-position'))
	$('#partities2').html(Partitie.updateAll())

	$('.total-in-project').html(Partitie.getTotalInProject().formatMoney())
});

Number.prototype.formatMoney = function() {
	let n = this
	return n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')
}


$(() => {
	$('.project-modifier').on('change keyup', function(e) {
		
		Partitie.salary = Number($('[name=salary]').val())
		Partitie.salaryBonus = Number($('[name=salaryBonus]').val())
		Partitie.expenses = Number($('[name=expenses]').val())
		Partitie.utility = Number($('[name=utility]').val())
		Partitie.unexpected = Number($('[name=unexpected]').val())
		Partitie.bonus = Number($('[name=bonus]').val())
		Partitie.fcas = Number($('[name=fcas]').val())

		$('#partities2').html(Partitie.updateAll())
		$('.total-in-project').html(Partitie.getTotalInProject().formatMoney())
	})

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
				$('#partities2').append(`<div class="col-md-6">${Partitie.addPartitie(data)}</div>`)
				$('.total-in-project').html(Partitie.getTotalInProject().formatMoney())
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
					status: $('[name=status]').val(),
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

