<div>
	<input type="text" name="{{ $name }}" value="{{ $value ?? date('Y-m-d') }}" class="form-control fecha" data-error="*La fecha es requerida." required>

</div>
@if($scripts)
	@section('customCSS')
		@parent
    	<link rel="stylesheet" href="/admin/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css">
	@stop

	@section('customJS')
		@parent
	    <script src="/admin/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/locales/bootstrap-datepicker.es.min.js"></script>
	    <script>
	    	$(function(){
	    		/*----------  Fecha  ----------*/
	            $('.fecha').datepicker({
	                autoclose: true,
	                todayHighlight: true,
	                format: 'yyyy-mm-dd',
	                language: 'es-ES'
	            });
	    	});
	    </script>
	@stop
@endif