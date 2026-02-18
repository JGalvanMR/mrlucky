<a href="{{ route('polizas.imprimir', ["hash_id"=>Hashids::encode($row->id)]) }}" class="btn btn-info btn-xs" data-toggle="tooltip" title="Imprimir" target="_blank">
	<i class="fa fa-print"></i>
</a>

<a href="{{ route('polizas.ver', ["hash_id"=>Hashids::encode($row->id)]) }}" class="btn btn-warning btn-xs" data-toggle="tooltip" title="Ver">
	<i class="fa fa-eye"></i>
</a>

<a href="{{ route('polizas.editar', ["hash_id"=>Hashids::encode($row->id)]) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Editar">
	<i class="fa fa-pencil-square-o"></i>
</a>

<x-btn-eliminar titulo="Eliminar Póliza" url="{{ route('polizas.eliminar', ['hash_id'=>Hashids::encode($row->id)]) }}" scripts="1" btn="1" />