<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


Route::group(['prefix'=>'v1'], function(){
    /*Route::get('tipos/{marca_id?}', [ApiController::class, 'getTipos'])->name('api.tipos');
    Route::get('ciudades/{estado_id?}', [ApiController::class, 'getCiudades'])->name('api.ciudades');*/

    Route::get('categorias/{idioma_id?}', [ApiController::class, 'getCategorias'])->name('api.categorias');
    Route::get('productos/{categoria_id?}', [ApiController::class, 'getProductos'])->name('api.productos');
    Route::get('categorias-recetas/{idioma_id?}', [ApiController::class, 'getCategoriasRecetas'])->name('api.categorias_recetas');
});
