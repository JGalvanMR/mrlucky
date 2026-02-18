<div>
</div>
@section('customCSS')
	@parent
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.1/spectrum.min.css" />
@stop

@section('customJS')
	@parent
	<script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.1/spectrum.min.js"></script>
	<script>
		$(function(){

			$('.colorPicker').spectrum({
                preferredFormat: "hex",
                showInput: true,
                cancelText: "Cancelar",
                chooseText: "Seleccionar",
                allowEmpty:true

            });

		});
	</script>
@endsection