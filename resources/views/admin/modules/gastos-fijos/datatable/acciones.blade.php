<a href="{{ route('gastos_fijos.editar', ["hash_id"=>Hashids::encode($row->id)]) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Editar">
	<i class="fa fa-pencil-square-o"></i>
</a>

<x-btn-eliminar titulo="Eliminar gasto fijo" url="{{ route('gastos_fijos.eliminar', ['hash_id'=>Hashids::encode($row->id)]) }}" scripts="1" btn="1" />