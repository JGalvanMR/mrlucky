<div>
</div>
@section('customCSS')
    @parent
    @if($scripts)
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.dataTables.min.css">
        {{-- <style>
            th, td { white-space: nowrap; }
            .table td{ padding: .3rem; }
            .table th{ padding: .45rem; }
        </style> --}}
    @endif

@stop

@section('customJS')
	@parent
    @if($scripts)
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        @if($exportable)
            <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
            <script src="https://cdn.datatables.net/colreorder/1.5.1/js/dataTables.colReorder.min.js"></script>
            <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
        @endif
        <script>
        	$(function(){

        		/* =========================================
                 * Listado
                 *  =======================================*/
                if($('.listado, .datatable').length){
                    let listado = $('.listado, .datatable').dataTable({
                        fixedHeader: true,
                        colReorder: true,
                        @if($exportable)
    	                    dom: 'Bfrtip',
    	                    buttons: [
    	                        {
    	                            extend: 'colvis',
    	                            text: '<i class="fa fa-columns"></i> <span class="hidden-xs-down">Columnas</span>',
    	                            className: 'btn btn-primary btn-sm'
    	                        },
    	                        {
    	                            extend: 'copyHtml5',
    	                            text: '<i class="fa fa-clipboard"></i> <span class="hidden-xs-down">Copiar</span>',
    	                            className: 'btn btn-primary btn-sm',
    	                            exportOptions:{
    	                                columns: ':visible'
    	                            }
    	                        },
    	                        {
    	                            extend: 'excel',
    	                            text: '<i class="fa fa-file-excel-o"></i> <span class="hidden-xs-down">Excel</span>',
    	                            className: 'btn btn-primary btn-sm',
    	                            exportOptions:{
    	                                columns: ':visible'
    	                        }
    	                        // },
    	                        // {
    	                        //     extend: 'pdf',
    	                        //     text: '<i class="fa fa-file-pdf-o"></i> <span class="hidden-xs-down">PDF</span>',
    	                        //     exportOptions:{
    	                        //         columns: ':visible'
    	                        //     }
    	                        // },
    	                        // {
    	                        //     extend: 'print',
    	                        //     text: '<i class="fa fa-print"></i> <span class="hidden-xs-down">Imprimir</span>',
    	                        //     exportOptions:{
    	                        //         columns: ':visible'
    	                        //     }
    	                        }
    	                    ],
    	                @endif
                        "language": {
                            "decimal":        "",
                            "emptyTable":     "No se encontraron registros",
                            "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                            "infoEmpty":      "Sin registros",
                            "infoFiltered":   "(Filtrado de _MAX_ registros)",
                            "infoPostFix":    "",
                            "thousands":      ",",
                            "lengthMenu":     "Mostrar _MENU_ registros",
                            "loadingRecords": "Cargando...",
                            "processing":     "Procesando...",
                            "search":         "Buscar:",
                            "zeroRecords":    "No se encontraron registros para su búsqueda.",
                            "paginate": {
                                "first":      "Primera",
                                "last":       "Ultima",
                                "next":       "Siguiente",
                                "previous":   "Anterior"
                            },
                            "aria": {
                                "sortAscending":  ": Ordenar ascendente",
                                "sortDescending": ": Ordenar descendente"
                            }
                        }
                    });

                    if($('.magnific').length){
                    	listado.on("draw", function(){
                    		initMagnificPopup();
                    	});
                    }

                }

                $(".btn").removeClass("dt-button");

        	});
        </script>
    @endif

@stop