<a href="{{ route('vigencias.ver', ["hash_id"=>Hashids::encode($row->id)]) }}" class="btn btn-warning btn-xs" data-toggle="tooltip" title="Ver">
	<i class="fa fa-eye"></i>
</a>

{{-- <a href="{{ route('vigencias.editar', ["hash_id"=>Hashids::encode($row->id)]) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Editar">
	<i class="fa fa-pencil-square-o"></i>
</a> --}}

<x-btn-eliminar titulo="Eliminar cliente" url="{{ route('vigencias.eliminar', ['hash_id'=>Hashids::encode($row->id)]) }}" scripts="1" btn="1" />