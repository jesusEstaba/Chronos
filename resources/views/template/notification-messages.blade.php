<div class="notifications">
		@if (session()->has('success'))
			@include(
				'template.alert-success', 
				['state' => 'Correcto', 'message'=> session()->get('success')]
			)
		@endif

		@include('template.validation')
</div>