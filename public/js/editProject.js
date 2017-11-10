var Partitie = {
    fcas: 0,
    expenses: 0,
    utility: 0,
    unexpected: 0,
    bonus: 0,
    salary: 0,
    salaryBonus: 0,
    days: 30,
    partities: [],
    removed: [],
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

        return workforces.reduce(
            (a, workforce) => 
                a + 
                (
                    this.bonus + 
                    (
                        this.salaryBonus + agregarProcentaje(this.salary, workforce.cost)
                    ) / 
                    this.days
                ) * 
                workforce.quantity
            , 0
        )
    },
    getBonus() {
        return this.bonus * this.getProjectDurationDays();
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
        
        this.partities.forEach(function(partitie, index) {
            partitie.position = index;
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
    getProjectDurationDays() {
        if (this.partities.length) {
            return this.partities.reduce((days, partitie) => days + Math.ceil( Number(partitie.quantity) / Number(partitie.yield) ), 0)    
        }
        
        return 0;  
    },
    removePartitie(position) {
        let projectPartitieId = this.partities[position].projectPartitie;

        if (projectPartitieId) {
            this.removed.push(projectPartitieId);
        }

        this.partities.splice(position, 1)
        let index = 0

        this.partities.forEach(function(partitie){
            partitie.position = index++
        })
    },
    getPartitie(position) {
        let partitie = this.partities[position]
        return partitie
    },
    updatePartitie(position, resources){
        let partitie = this.partities[position]

        resources.materials.forEach(function(quantity, index){
            partitie.materials[index].quantity = quantity 
        })

        resources.equipments.forEach(function(quantity, index){
            partitie.equipments[index].quantity = quantity 
        })

        resources.workforces.forEach(function(quantity, index){
            partitie.workforces[index].quantity = quantity 
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
    
    return base * (1 + porcentage / 100);
}

function templatePartitie2(partitie) {
    return `<div class="partitie" style="border: 1px solid rgba(0,0,0,.15);padding: .5em;border-radius: .25rem;">

        <div class="modal-header">
            <button class="close edit-partitie" data-position="${partitie.partitie.position}">
                <span class="fa fa-pencil"></span>
            </button>
            <h5 class="modal-title" style="color:#605f52;">${partitie.partitie.name}</h5>
          <button class="close remove-partitie" data-position="${partitie.partitie.position}">
            <span class="fa fa-remove"></span>
          </button>
        </div>

        <div class="row partitie-header">
            ${partitieHeadersTemplate(partitie)}
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="small">Cantidad</label>
                <input name="quantity" data-position="${partitie.partitie.position}" value="${partitie.partitie.quantity}" placeholder="Cantidad" class="form-control partitie-modificator" type="number" pattern="^[0-9]" min="0" step="any">
                
                <label class="small">Rendimiento</label>
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

function templateResourcePartitie(resource, item) {
    return `
            <tr>
                <td></td>
                <td>${item.name}</td>
                <td>${item.cost.formatMoney()}</td>
                <td><input name="${resource}-partitie" type="number" data-resource="${item.id}" value="${item.quantity}" class="form-control" /></td>
            <tr>
    `;
}

function templateTableResourcePartitie(title, body) {
    return `
        <h5>${title}</h5>
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Costo</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                ${body}
            </tbody>
        </table>
    `;
}

Number.prototype.formatMoney = function() {
    let n = this
    return n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')
}

partitieList = []

$(document).on('change keyup', '.partitie-modificator',function(e) {
    let position = $(this).attr('data-position'),
        father = $(this).parents('.partitie'),
        partitie = Partitie.partities[position]

    partitie.quantity = Number(father.find('[name="quantity"]').val())
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

$(document).on('click', '.edit-partitie', function(event) {
    event.preventDefault();
    
    let partitie = Partitie.getPartitie($(this).attr('data-position'))
    
    let materialsHTML = ''
    partitie.materials.forEach(function(material) {
        materialsHTML += templateResourcePartitie('material', material)
    })

    let equipmentsHTML = ''
    partitie.equipments.forEach(function(equipment) {
        equipmentsHTML += templateResourcePartitie('equipment', equipment)
    })

    let workforcesHTML = ''
    partitie.workforces.forEach(function(workforce) {
        workforcesHTML += templateResourcePartitie('workforce', workforce)
    })

    let modalBodyHTML = '';

    if (materialsHTML) {
        modalBodyHTML += templateTableResourcePartitie('Materiales', materialsHTML)
    }

    if (equipmentsHTML) {
        modalBodyHTML += templateTableResourcePartitie('Equipos', equipmentsHTML)
    }

    if (workforcesHTML) {
        modalBodyHTML += templateTableResourcePartitie('Mano de Obra', workforcesHTML)
    }

    $('#update-partitie').attr('partitie-position', $(this).attr('data-position'));
    
    $('#partitie-modal .modal-body').html('').append(modalBodyHTML);
    $('#partitie-modal').modal();

    /*
    $('#partities2').html(Partitie.updateAll())

    $('.total-in-project').html(Partitie.getTotalInProject().formatMoney())
    */
});

$(document).on('click', '#update-partitie', function(event) {
    event.preventDefault();
    let position = $(this).attr('partitie-position');

    let materials = [],
        equipments = [],
        workforces = [];

    $('[name="material-partitie"]').each(function(index, el) {
        materials.push(Number($(el).val()));
    });

    $('[name="equipment-partitie"]').each(function(index, el) {
        equipments.push(Number($(el).val()));
    });

    $('[name="workforce-partitie"]').each(function(index, el) {
        workforces.push(Number($(el).val()));
    });

    Partitie.updatePartitie(position, {
        materials: materials,
        equipments: equipments,
        workforces: workforces
    })

    $('#partities2').html(Partitie.updateAll())

    $('.total-in-project').html(Partitie.getTotalInProject().formatMoney())
});

function getInputsAndUpdate() {
    Partitie.salary = Number($('[name=salary]').val())
    Partitie.salaryBonus = Number($('[name=salaryBonus]').val())
    Partitie.expenses = Number($('[name=expenses]').val())
    Partitie.utility = Number($('[name=utility]').val())
    Partitie.unexpected = Number($('[name=unexpected]').val())
    Partitie.bonus = Number($('[name=bonus]').val())
    Partitie.fcas = Number($('[name=fcas]').val())

    $('#partities2').html(Partitie.updateAll())
    $('.total-in-project').html(Partitie.getTotalInProject().formatMoney())
}


$(() => {
    $('.project-modifier').on('change keyup', function(e) {
        getInputsAndUpdate();
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
                let templatePartitiesHTML = '';

                data.forEach((partitie) => {
                    if (!partitieList.some(id => id == partitie.id)) {
                        templatePartitiesHTML += `
                            <a 
                                style="margin:.5em 0;"
                                class="add-partitie"
                                href="javascript:;"
                                data-partitie="${partitie.id}"
                            >
                                <span class="btn btn-outline-success">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </span>
                                <span class="name">${partitie.name}</span>
                            </a>
                        `;
                    }

                });

                $('.list-partities').append(templatePartitiesHTML);
                $('[name="search-partities"]').val("");
            })
    });

    $('.list-partities').on('click', '.add-partitie', function(e) {
        e.preventDefault();

        var idPartitie = $(this).attr('data-partitie');
            
        $('#modalactivate')
            .append('<i class="fa fa-spinner fa-pulse fa-1x"></i>')
               .addClass('active')
               .attr('disabled', true);
        
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
        .always(function() {
            $('#modalactivate')
                .removeClass('active')
                .removeAttr('disabled')
                .find('.fa').remove();
        });

        //$(this).remove();
    });

    $('#createProject').on('click', function(event) {
        event.preventDefault();

        

        if (!validateFieldsIsNotEmpty()) {
            let buttonCreateProject = $(this);
            
            buttonCreateProject
                .append('<i class="fa fa-spinner fa-pulse fa-1x"></i>')
                .addClass('active')
                .attr('disabled', true);
            
            $('.notifications').html("");

            $.ajax({
                url: '/projects/' + projectId,
                type: 'PUT',
                dataType: 'json',
                data: {
                    "_token": $('[name="_token"]').val(),
                    partities:  Partitie.partities,
                    removed: Partitie.removed,
                    name: $('[name=name]').val(),
                    description: $('textarea[name=description]').val(),
                    client: $('[name=client]').val(),
                    start: $('[name=start]').val(),
                    status: $('[name=status]').val(),
                    salary: Number($('[name=salary]').val()),
                    salaryBonus: Number($('[name=salaryBonus]').val()),

                    fcas: Number($('[name=fcas]').val()),
                    expenses: Number($('[name=expenses]').val()),
                    utility: Number($('[name=utility]').val()),
                    unexpected: Number($('[name=unexpected]').val()),
                    bonus: Number($('[name=bonus]').val())
                }
            })
            .done(data => {
                if (data.status=="redirect") {
                    window.location.href = '/projects/' + projectId
                } else {
                    alert('Algo no salio bien...')
                }
            })
            .fail(function(data) {
                if (data.status == 422) {
                    let errors = data.responseJSON;
                    let errorsHTML = '';

                    $.each(errors, function(index, el) {
                        console.log(el[0]);
                        errorsHTML += `<li>${el[0]}</li>`;
                    });

                    let errorTemplate = `
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <ul style="margin: 0;">
                                ${errorsHTML}
                            </ul>
                        </div>`;

                    $('.notifications').append(errorTemplate);
            }
        }).always(function() {
            $('[type=submit]')
                .removeClass('active')
                .removeAttr('disabled')
                .find('.fa').remove();
        });
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

