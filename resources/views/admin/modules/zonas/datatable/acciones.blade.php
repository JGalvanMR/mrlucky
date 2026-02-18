<a href="{{ route('zonas.editar', ["hash_id"=>Hashids::encode($row->id)]) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Editar">
	<i class="fa fa-pencil-square-o"></i>
</a>

<x-btn-eliminar titulo="Eliminar zona" url="{{ route('zonas.eliminar', ['hash_id'=>Hashids::encode($row->id)]) }}" scripts="1" btn="1" />
