function fnMoney() {
    return (+this).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
}

Number.prototype.money = fnMoney;
String.prototype.money = fnMoney;



$(function() {
    //MATERIAl
    var materialList = [];
    $('#search-materials').on('click', function(e) {
        e.preventDefault();
        $.ajax({
                url: '/search/materials',
                type: 'POST',
                dataType: 'json',
                data: {
                    search: $('[name="search-materials"]').val(),
                    "_token": $('[name="_token"]').val(),
                }
            })
            .done(function(data) {
                $('.list-materials').html("");
                let templateMaterialsHTML = '';

                data.forEach((material) => {
                    if (!materialList.some(id => id == material.id)) {
                        templateMaterialsHTML += `
                        	<a 
                        		href="javascript:;" 
                        		style="display:block;margin:.5em 0;"
                        		data-material="${material.id}"
								data-material-unit="${material.unit.abbreviature}"
								data-material-price="${material.price}"
								class="add-material"
                        	>
								<span class="btn btn-outline-success">
									<i class="fa fa-plus" aria-hidden="true"></i>
								</span>
								<span class="name">${material.name}</span>
							</a>
						`;
                    }

                });

                $('.list-materials').append(templateMaterialsHTML);
                $('[name="search-materials"]').val("");
            })
            .fail(function() {
                console.log("error");
            });
    });
    
    $('.list-materials').on('click', '.add-material', function(e) {
        e.preventDefault();

        if ($('#material .delete-if-not-empty')[0]) {
            $('#material .delete-if-not-empty').remove();
        }

        materialList.push($(this).attr('data-material'));
        $(this).remove();

        $('.materials tbody').append(`
        	<tr>
				<td>
						<a class="remove-item" href="javascript:;">
								<i class="fa fa-times" aria-hidden="true"></i>
						</a>
				</td>
				<td>
						${$(this).find('.name').html()}
				</td>
				<td class="price">
						${$(this).attr('data-material-price').money()}
				</td>
				<td class="quantity">
						<input type="text"
							name="qty"
							class="form-control  input-close-btn"
							data-item-id="${$(this).attr('data-material')}"
							value="1"
						/>
				</td>
				<td>
						${$(this).attr('data-material-unit')}
				</td>
				<td>
						<label class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input"
								name="uniq" value="off">
							<span class="custom-control-indicator"></span>
						</label>
				</td>
			</tr>
		`);

        totalInMaterials();
    });
    
    $('.materials').on('click', '.remove-item', function(e) {
        e.preventDefault();
        $(this).parent().parent().remove();
        totalInMaterials();

        if (!$('.materials tbody tr')[0]) {
            $('.materials tbody').append(`
            	<tr class="delete-if-not-empty">
					<td colspan="6">
						<p class="text-center">
							No se ha agregado ningun recurso de este tipo.
						</p>
					</td>
				</tr>
			`);
        }
    });
    
    $('.materials').on('keyup', '[name="qty"]', function(e) {
        if (!isNaN($(this).val())) {
            totalInMaterials();
        }
    });

    function totalInMaterials() {
        var total = 0;
        $('.materials tbody tr').each(function(index, el) {
            var price = Number($(el).children('.price').html()),
                qty = Number($(el).children('.quantity').children('input').val());

            if (!isNaN(qty)) {
                total += price * qty;
            }

        });
        $('.total-materials').html(total.toFixed(2));
    }



    //EQUIPMENT
    var equipmentList = [];
    $('#search-equipments').on('click', function(e) {
        e.preventDefault();
        $.ajax({
                url: '/search/equipments',
                type: 'POST',
                dataType: 'json',
                data: {
                    search: $('[name="search-equipments"]').val(),
                    "_token": $('[name="_token"]').val(),
                }
            })
            .done(function(data) {
                $('.list-equipments').html("");
                let templateEquipmentsHTML = '';

                data.forEach((equipment) => {
                    if (!equipmentList.some(id => id == equipment.id)) {
                    	templateEquipmentsHTML += `
                        	<a 
                        		href="javascript:;" 
                        		style="display:block;margin:.5em 0;"
								data-equipment="${equipment.id}"
								data-equipment-price="${equipment.price}"
								class="add-equipment"
                        	>
								<span class="btn btn-outline-success">
									<i class="fa fa-plus" aria-hidden="true"></i>
								</span>
								<span class="name">${equipment.name}</span>
							</a>
						`;
                    }

                });

            	$('.list-equipments').append(templateEquipmentsHTML);
                $('[name="search-equipments"]').val("");
            })
            .fail(function() {
                console.log("error");
            });
    });
    $('.list-equipments').on('click', '.add-equipment', function(e) {
        e.preventDefault();
        if ($('#equipment .delete-if-not-empty')[0]) {
            $('#equipment .delete-if-not-empty').remove();
        }
        equipmentList.push($(this).attr('data-equipment'));
        $(this).remove();
        $('.equipments tbody').append(`<tr>
														<td>
																<a class="remove-item" href="javascript:;">
																		<i class="fa fa-times" aria-hidden="true"></i>
																</a>
														</td>
														<td>
																${$(this).find('.name').html()}
														</td>
														<td class="price">
																${$(this).attr('data-equipment-price').money()}
														</td>
														<td class="quantity">
																<input type="text"
																	name="qty"
																	class="form-control  input-close-btn"
																	data-item-id="${$(this).attr('data-equipment')}"
																	value="1"
																/>
														</td>
														<td>
																<label class="custom-control custom-checkbox">
																	<input value="off" type="checkbox" class="custom-control-input"
																		name="workers">
																	<span class="custom-control-indicator"></span>
																</label>
														</td>
												</tr>`);
        totalInEquipments();
    });
    $('.equipments').on('click', '.remove-item', function(e) {
        e.preventDefault();
        $(this).parent().parent().remove();
        totalInEquipments();

        if (!$('.equipments tbody tr')[0]) {
            $('.equipments tbody').append(`
            	<tr class="delete-if-not-empty">
					<td colspan="6">
						<p class="text-center">
							No se ha agregado ningun recurso de este tipo.
						</p>
					</td>
				</tr>
			`);
        }
    });
    $('.equipments').on('keyup', '[name="qty"]', function(e) {
        if (!isNaN($(this).val())) {
            totalInEquipments();
        }

    });

    function totalInEquipments() {
        var total = 0;
        $('.equipments tbody tr').each(function(index, el) {
            var price = Number($(el).children('.price').html()),
                qty = Number($(el).children('.quantity').children('input').val());

            if (!isNaN(qty)) {
                total += price * qty;
            }

        });
        $('.total-equipments').html(total.toFixed(2));
    }

    //WORKFORCE
    var workforceList = [];
    $('#search-workforces').on('click', function(e) {
        e.preventDefault();
        $.ajax({
                url: '/search/workforces',
                type: 'POST',
                dataType: 'json',
                data: {
                    search: $('[name="search-workforces"]').val(),
                    "_token": $('[name="_token"]').val(),
                }
            })
            .done(function(data) {
                $('.list-workforces').html("");
                let templateWorkforcesHTML = '';

                data.forEach((workforce) => {
                    if (!workforceList.some(id => id == workforce.id)) {
                    	templateWorkforcesHTML += `
                        	<a 
                        		href="javascript:;" 
                        		style="display:block;margin:.5em 0;"
								data-workforce="${workforce.id}"
								data-workforce-price="${workforce.price}"
								class="add-workforce"
                        	>
								<span class="btn btn-outline-success">
									<i class="fa fa-plus" aria-hidden="true"></i>
								</span>
								<span class="name">${workforce.name}</span>
							</a>
						`;
                    }

                });

            	$('.list-workforces').append(templateWorkforcesHTML);
                $('[name="search-workforces"]').val("");
            })
            .fail(function() {
                console.log("error");
            });
    });
    $('.list-workforces').on('click', '.add-workforce', function(e) {
        e.preventDefault();

        if ($('#workforce .delete-if-not-empty')[0]) {
            $('#workforce .delete-if-not-empty').remove();
        }

        workforceList.push($(this).attr('data-workforce'));
        $(this).remove();

        $('.workforces tbody').append(`<tr>
												<td>
														<a class="remove-item" href="javascript:;">
																<i class="fa fa-times" aria-hidden="true"></i>
														</a>
												</td>
												<td>
														${$(this).find('.name').html()}
												</td>
												<td class="price">
													${$(this).attr('data-workforce-price')}%
												</td>
												<td class="quantity">
														<input type="text"
															name="qty"
															class="form-control  input-close-btn"
															data-item-id="${$(this).attr('data-workforce')}"
															value="1"
														/>
												</td>
										</tr>`);
        totalInworkforces();
    });
    $('.workforces').on('click', '.remove-item', function(e) {
        e.preventDefault();
        $(this).parent().parent().remove();
        totalInworkforces();

        if (!$('.workforces tbody tr')[0]) {
            $('.workforces tbody').append(`
            	<tr class="delete-if-not-empty">
					<td colspan="6">
						<p class="text-center">
							No se ha agregado ningun recurso de este tipo.
						</p>
					</td>
				</tr>
			`);
        }
    });
    $('.workforces').on('keyup', '[name="qty"]', function(e) {
        if (!isNaN($(this).val())) {
            totalInworkforces();
        }
    });

    function totalInworkforces() {
        var total = 0;
        $('.workforces tbody tr').each(function(index, el) {
            var price = Number($(el).children('.price').html()),
                qty = Number($(el).children('.quantity').children('input').val());

            if (!isNaN(qty)) {
                total += price * qty;
            }

        });
        $('.total-workforces').html(total.toFixed(2));
    }


    //GLOBAL
    $('[type="submit"]').on('click', function(e) {
        e.preventDefault();
        if (!$(this).hasClass('active')) {
            $(this)
            	.append('<i class="fa fa-spinner fa-pulse fa-1x"></i>')
            	.addClass('active')
            	.attr('disabled', true);
            	
            var materials = [],
                equipments = [],
                workforces = [];

            $('.materials tbody tr').each(function() {
                materials.push({
                    'id': $(this).find('[name="qty"]').attr('data-item-id'),
                    'qty': $(this).find('[name="qty"]').val(),
                    'uniq': $(this).find('[name="uniq"]').val()
                });
            });
            $('.equipments tbody tr').each(function() {
                equipments.push({
                    'id': $(this).find('[name="qty"]').attr('data-item-id'),
                    'qty': $(this).find('[name="qty"]').val(),
                    'workers': $(this).find('[name="workers"]').val()
                });
            });
            $('.workforces tbody tr').each(function() {
                workforces.push({
                    'id': $(this).find('[name="qty"]').attr('data-item-id'),
                    'qty': $(this).find('[name="qty"]').val(),
                });
            });

            $('.notifications').html("");
            
            let partitieId = /partities\/(\d+)/.exec(document.location.href)[1];
            
            $.ajax({
                    url: '/partities/'+ partitieId,
                    type: 'PUT',
                    dataType: 'json',
                    data: {
                        "name": $('[name="name"]').val(),
                        "yield": $('[name="yield"]').val(),
                        "unit": $('[name="unit"]').val(),
                        "category": $('[name="category"]').val(),
                        "reference": $('[name="reference"]').val(),
                        "parent": $('[name="parent"]').val(),
                        "materials": materials,
                        "equipments": equipments,
                        "workforces": workforces,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('[name="_token"]').val()
                    }
                })
                .done(function(data) {
                    if (data.redirect) {
                        window.location.href = '/partities/'+ partitieId;
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

                        let errorTemplate = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
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

        } //end if
    });
    $('.box-body').on('click', '.custom-checkbox', function(e) {
        e.preventDefault();
        var $input = $(this).children("input");
        $input.val(($input.val() == "on") ? "off" : "on");
        $input.prop("checked", () => !$input.prop("checked"));
    });

})