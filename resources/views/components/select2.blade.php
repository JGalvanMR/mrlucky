<div>

</div>
@section('customCSS')
	@parent
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
	<style>
        .select2-container--default .select2-selection--single, .select2-container--default .select2-selection--single .select2-selection__arrow{
            height: 38px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered{
            line-height: 38px;
        }
    </style>
@stop

@section('customJS')
	@parent
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
	<script>
		$(function(){
			$('.select2').select2({
				width: '100%'
			});
		});
	</script>
@stop