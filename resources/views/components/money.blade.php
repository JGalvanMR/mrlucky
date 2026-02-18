<div>
	<input type="text" name="{{ $name }}" class="form-control money" value="{{ $value }}" data-error="{{ $requeridoText }}" {{ ($requerido) ? 'required':'' }}>
</div>
@section('customJS')
	@parent
	@if($scripts == 1)
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
		<script>
			$(function(){
				$('.money').maskMoney({
					prefix: '{{ $prefix }}',
					suffix: '{{ $suffix }}',
					thousands: ',',
					decimal: '.',
					precision: {{ $precision }},
					allowZero: {{ $allowZero }}
				});
			});
		</script>
	@endif
@stop