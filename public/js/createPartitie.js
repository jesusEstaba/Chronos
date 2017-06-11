var Partitie = {
	partities : [],
	calcMaterialsTotal(materials) {
		return materials.reduce((a, m) => a + m.cost * m.quantity, 0)
	},
	calcEquipmentsTotal(equipments) {
		return equipments.reduce((a, e) => a + e.cost * e.depreciation * e.quantity, 0)
	}
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

