<div>
	<input type="text" name="{{ $name }}" class="form-control {{ $class }}" value="{{ $value }}" maxlength="{{ $max }}">
</div>
@section('customCSS')
	@parent
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-maxlength/1.10.0/bootstrap-maxlength.js"></script>
@stop

@section('customJS')
	@parent
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-maxlength/1.10.0/bootstrap-maxlength.min.js"></script>
	<script>
		$(function(){

			$('input.{{ $class }}').maxlength({
	          	alwaysShow: false,
	          	threshold: {{ $max - 10 }},
	          	warningClass: "label label-warning",
	          	limitReachedClass: "label label-danger",
	          	separator: ' de ',
	          	preText: '',
	          	postText: '',
	          	validate: false
	        });
		});
	</script>
@stop