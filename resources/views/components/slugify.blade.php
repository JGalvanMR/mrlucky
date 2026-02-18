<div>
    <input type="text" name="{{ $name }}" value="{{ $slug }}" class="form-control" data-error="{{ $requeridoText }}" {{ ($requerido) ? 'required':'' }}>
</div>
@section('customJS')
	@parent
	<script src="https://cdnjs.cloudflare.com/ajax/libs/speakingurl/14.0.1/speakingurl.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-slugify@1.2.5/dist/slugify.min.js"></script>
    <script>
    	$(function(){
    		$('input[name={{ $name }}]').slugify('input[name={{ $titulo }}]');
    	});
    </script>
@stop