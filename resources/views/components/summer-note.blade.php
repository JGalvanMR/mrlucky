<div>
	<textarea name="{{ $name ?? 'editor' }}" class="editor">{{ $value ?? '' }}</textarea>
</div>

@section('customCSS')
	@parent
	@if($scripts == 1)
		<link rel="stylesheet" href="/admin/assets/plugins/summernote/dist/summernote.css" />
	@endif
@stop

@section('customJS')
	@parent
	@if($scripts == 1)
		<script src="/admin/assets/plugins/summernote/dist/summernote.min.js"></script>
		<script src="/admin/assets/plugins/summernote/dist/lang/summernote-es-ES.min.js"></script>
		<script>
			$(function(){
				/* =========================================
	             * Summernote
	             *  =======================================*/
	            if($('.editor').length){

		            $('.editor').summernote({
		                height: {{ $height ?? '300' }},
		                lang: 'es-ES'
		            });

	            }
			});
		</script>
	@endif

@stop