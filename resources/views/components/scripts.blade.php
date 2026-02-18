<div>
    @section('customCSS')
		@parent

		{{-- Magnific Popup --}}
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />
	@stop

	@section('customJS')
		@parent

		{{-- SweetAlert2 --}}
		<script src="https://unpkg.com/sweetalert2@7.22.0/dist/sweetalert2.all.js"></script>

	    {{-- Magnific Popup --}}
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>


	@stop
</div>