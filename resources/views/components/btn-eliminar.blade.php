<div class="d-inline-block">
    <a href="#." data-url="{{ $url }}/{{ $id }}" class="btn btn-danger btn-xs {{ $class }}" data-toggle="tooltip" title="Eliminar">
        <i class="fa fa-trash"></i> {{ $text }}
    </a>
</div>

@section('customJS')
    @parent

    @if($scripts == 1)
        <script>
            $(function(){

                /* =========================================
                 * BTN Eliminar
                 *  =======================================*/
                $('body').on('click','.{{ $class }}',function(){
                    var url = $(this).data('url');


                    swal({
                        title: "{{ $titulo }}",
                        text: "La información no podrá ser recuperada",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminar'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url: url,
                                cache: false,
                                type: 'post',
                                dataType: 'json',
                                success: function(res){
                                    swal({
                                        title: res.titulo,
                                        text: res.msg,
                                        type: res.class,
                                        onClose: function(){
                                            location.reload();
                                        }
                                    });
                                }
                            });
                        }
                    });
                    return false;
                });

            });
        </script>
    @endif
@stop