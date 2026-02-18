<div>
    <input id="{{ $name }}" name="{{ $name }}Input" type="file" class="file-loading" multiple>
    <input type="hidden" id="{{ $name }}Img" name="{{ $name }}" value="{{ $value }}">
</div>
@section('customCSS')
	@parent
	@if($scripts == 1)
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/css/fileinput.min.css" />
		<style>
			.file-drop-zone{ display: flex; justify-content: center }
		</style>
	@endif
@stop

@section('customJS')
	@parent
	@if($scripts == 1)
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/js/fileinput.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/themes/fa/theme.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/js/locales/es.min.js"></script>
    @endif
    <script>
    	@php
    		// Formateando extensiones permitidas.
    		$ext = explode(',', $ext);
    		$extension = '';
    		foreach ($ext as $e) {
    			$extension .= '"'.$e.'",';
    		}
    	@endphp

    	$(function(){
    		 /*----------  {{ $name }} ----------*/
            $("#{{ $name }}").fileinput({
                uploadUrl: "{{ $route }}",
                uploadAsync: true,
                maxFileCount: {{ $fileCount }},
                language: 'es',
                showUpload: false,
                theme: 'fa',
                height: '70',
                allowedFileExtensions: [{!! $extension !!}],
                uploadExtraData: {
                	folder: "{{ $folder }}",
                	name: "{{ $name }}"
                },
                {{--
                @if($files)
	                @foreach($files as $file)
	                    initialPreview: [
	                        '<img src="/uploads/{{ $file }}" class="file-preview-image img-responsive">'
	                    ],
	                    initialPreviewConfig: [
	                        {
	                            caption: '{{ $file }}',
	                            width: '120px',
	                            url: "{{ $deleteUrl }}", // server delete action
	                            extra: {
	                                slide_id: $file->id
	                            }
	                        }
	                    ]
	                @endforeach
	            @endif
	            --}}
            });
            $('#{{ $name }}').on("filebatchselected", function(event, files) {
                // trigger upload method immediately after files are selected
                $('.kv-file-upload').click();
            });
            $('#{{ $name }}').on('filedeleted', function(event, key, jqXHR, data) {
                $("#{{ $name }}Img").val("");
            });
            $('#{{ $name }}').on('fileuploaded', function(event, data, previewId, index) {
                var form = data.form,
                    files = data.files,
                    extra = data.extra,
                    response = data.response,
                    reader = data.reader;
                $("#{{ $name }}Img").val( $("#{{ $name }}Img").val() + ',' + data.response.{{ $name }} );
            });
    	});
    </script>
@stop