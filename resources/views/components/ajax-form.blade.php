<div>
    <script>

	$(function(){

		$('#{{ $id }}').validator().on('submit', function (e) {

            if (e.isDefaultPrevented()) {
                swal({
                    title: '{{ $titulo }}',
                    text: 'Valide que los datos sean correctos.',
                    type: 'error',
                    confirmButtonText: 'Listo',
                    //toast: true
                });
            }else{
                $.ajax({
                    url: $('#{{ $id }}').attr('action'),
                    cache: false,
                    type: 'post',
                    data: $('#{{ $id }}').serialize(),
                    dataType: 'json',
                    success: function(res){
                        swal({
                            title: res.titulo,
                            text: res.msg,
                            type: res.class,
                            onClose: function(){
                            	@if($reload)
                                	location.reload();
                                @endif
                                @if($redirect)
                                    location.href = res.redirect;
                                @endif
                            }
                        });
                    }
                });
            }

            return false;
        });
	});
</script>
</div>