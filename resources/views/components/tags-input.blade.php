<div>
    <!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
</div>
@section('customCSS')
	@parent
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
	<style>
		.bootstrap-tagsinput { width: 100% !important; }
	</style>
@stop

@section('customJS')
	@parent
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
@stop
