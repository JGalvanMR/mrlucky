<a href="{{ route('proveedores.ver', ["hash_id"=>Hashids::encode($row->id)]) }}" class="btn btn-warning btn-xs" data-toggle="tooltip" title="Ver">
	<i class="fa fa-eye"></i>
</a>

<a href="{{ route('proveedores.editar', ["hash_id"=>Hashids::encode($row->id)]) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Editar">
	<i class="fa fa-pencil-square-o"></i>
</a>

<x-btn-eliminar titulo="Eliminar proveedor" url="{{ route('proveedores.eliminar', ['hash_id'=>Hashids::encode($row->id)]) }}" scripts="1" btn="1" />
