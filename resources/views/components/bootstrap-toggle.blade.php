<div>
    <input type="checkbox" name="{{ $name }}" value="1" data-toggle="toggle" data-on="{{ $onText ?? 'Activo' }}" data-off="{{ $offText ?? 'Inactivo' }}" data-size="{{ $size }}" data-width="{{ $width }}" data-offstyle="warning" data-onstyle="success" {{ ($checked == 1) ? 'checked':'' }}>

</div>

@if($scripts)
	@section('customCSS')
		@parent
		<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	@stop

	@section('customJS')
		@parent
		<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	@stop
@endif