<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SiteController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\IdiomaController;
use App\Http\Controllers\CategoriaProductoController;
use App\Http\Controllers\CategoriaRecetaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\VacanteController;
use App\Http\Controllers\TraduccionController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\PaginaController;


// Rutas Web
Route::get('/', [SiteController::class, 'index'])->name('es.inicio');
Route::get('/en', [SiteController::class, 'index'])->name('en.inicio');

//Rutas GAB - ESPAÑOL
Route::get('/ventasnew', [SiteController::class, 'ventasnew'])->name('es.ventasnew');
Route::get('/ventas', [SiteController::class, 'ventas'])->name('es.ventas');
Route::get('/fletes', [SiteController::class, 'fletes'])->name('es.fletes');
Route::get('/trazabilidad', [SiteController::class, 'trazabilidad'])->name('es.trazabilidad');
Route::get('/tr/trazabilidad2_dmi.php', [SiteController::class, 'tr'])->name('es.tr');
Route::get('/trazabilidad/traza_prod_esp.php', [SiteController::class, 'trazabilidadLote'])->name('es.trazabilidadLote');
Route::get('/trazabilidad/traza_esp_pti.php', [SiteController::class, 'trazabilidadPTI'])->name('es.trazabilidadPTI');
Route::get('/trazabilidad/traza_pt_esp.php', [SiteController::class, 'trazabilidadPT'])->name('es.trazabilidadPT');
Route::get('/ventas/embarques.php', [SiteController::class, 'embarques'])->name('es.embarques');
Route::get('/sisgabweb', [SiteController::class, 'sisgabweb'])->name('es.sisgabweb');
Route::get('/ventas/monitor_pc.php', [SiteController::class, 'monitorVentas'])->name('es.monitorVentas');

//Rutas GAB - INGLES
Route::get('/en/ventasnew', [SiteController::class, 'ventasnew'])->name('en.ventasnew');
Route::get('/en/ventas', [SiteController::class, 'ventas'])->name('en.ventas');
Route::get('/en/fletes', [SiteController::class, 'fletes'])->name('en.fletes');
Route::get('/en/trazabilidad', [SiteController::class, 'trazabilidad'])->name('en.trazabilidad');
Route::get('/en/tr/trazabilidad2_dmi.php', [SiteController::class, 'tr'])->name('en.tr');
Route::get('/en/trazabilidad/traza_prod_ing.php', [SiteController::class, 'trazabilidadLote'])->name('en.trazabilidadLote');
Route::get('/en/trazabilidad/traza_ing_pti.php', [SiteController::class, 'trazabilidadPTI'])->name('en.trazabilidadPTI');
Route::get('/en/trazabilidad/traza_pt_ing.php', [SiteController::class, 'trazabilidadPT'])->name('en.trazabilidadPT');
Route::get('/en/ventas/embarques.php', [SiteController::class, 'embarques'])->name('en.embarques');
Route::get('/en/sisgabweb', [SiteController::class, 'sisgabweb'])->name('en.sisgabweb');
Route::get('en/ventas/monitor_pc.php', [SiteController::class, 'monitorVentas'])->name('en.monitorVentas');


//http://mrlucky.com.mx/english/trazabilidad/traza_ing_pti.php?id_codigo=3619918TOVM2DAS001006

// Nosotros
Route::get('/nosotros', [SiteController::class, 'nosotros'])->name('es.nosotros');
Route::get('/en/about-us', [SiteController::class, 'nosotros'])->name('en.nosotros');

// Compromiso
Route::get('/compromiso', [SiteController::class, 'compromiso'])->name('es.compromiso');
Route::get('/en/commitment', [SiteController::class, 'compromiso'])->name('en.compromiso');

// Productos
Route::get('/productos', [SiteController::class, 'productos'])->name('es.productos');
Route::get('/en/products', [SiteController::class, 'productos'])->name('en.productos');

// Producto
Route::get('/producto/{slug?}', [SiteController::class, 'producto'])->name('es.producto');
Route::get('/en/product/{slug?}', [SiteController::class, 'producto'])->name('en.producto');

// Blog
Route::get('/blog', [SiteController::class, 'blog'])->name('es.blog');
Route::get('/en/blog', [SiteController::class, 'blog'])->name('en.blog');

// Post
Route::get('/blog/{slug}', [SiteController::class, 'post'])->name('es.post');
Route::get('/en/blog/{slug}', [SiteController::class, 'post'])->name('en.post');

// Recetas
Route::get('/recetas', [SiteController::class, 'recetas'])->name('es.recetas');
Route::get('/en/recipes', [SiteController::class, 'recetas'])->name('en.recetas');

// Receta
Route::get('/recetas/{slug}', [SiteController::class, 'receta'])->name('es.receta');
Route::get('/en/recipes/{slug}', [SiteController::class, 'receta'])->name('en.receta');

// Grupo U
Route::get('/grupo-u', [SiteController::class, 'grupoU'])->name('es.grupo_u');
Route::get('/en/group-u', [SiteController::class, 'grupoU'])->name('en.grupo_u');

// Contacto
Route::get('/contacto', [SiteController::class, 'contacto'])->name('es.contacto');
Route::get('/en/contact-us', [SiteController::class, 'contacto'])->name('en.contacto');

Route::post('/contacto', [SiteController::class, 'enviarContacto'])->name('es.contacto_enviar');
Route::post('/en/contact-us', [SiteController::class, 'enviarContacto'])->name('en.contacto_enviar');

Route::get('/vacantes', [SiteController::class, 'vacantes'])->name('es.vacantes');
Route::get('/en/vacancies', [SiteController::class, 'vacantes'])->name('en.vacantes');

Route::get('/vacantes/{slug}', [SiteController::class, 'vacante'])->name('es.vacante');
Route::get('/en/vacancies/{slug}', [SiteController::class, 'vacante'])->name('en.vacante');

Route::get('ingresar', [UserController::class, 'loginForm'])->name('login_form');
Route::post('ingresar', [UserController::class, 'login'])->name('login');
Route::get('salir', [UserController::class, 'logout'])->name('salir');
//Route::get('set-locale/{new}', [SiteController::class, 'setLocale'])->name('set_locale');

Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function(){
//Route::group(['prefix' => 'admin'], function(){

	/*----------  Paginas  ----------*/
	Route::group(['prefix'=>'paginas'], function(){
		Route::get('/', [PaginaController::class, 'index'])->name('paginas');
		Route::get('editar/{archivo}', [PaginaController::class, 'editarForm'])->name('paginas.editar_form');
		Route::post('editar/{archivo}', [PaginaController::class, 'editar'])->name('paginas.editar');
	});

	/*----------  Slides  ----------*/
	Route::group(['prefix'=>'slides'], function(){
		Route::get('/', [SlideController::class, 'index'])->name('slides');
		Route::get('agregar', [SlideController::class, 'agregarForm'])->name('slides.agregar_form');
		Route::post('agregar', [SlideController::class, 'agregar'])->name('slides.agregar');
		Route::get('editar/{hash_id}', [SlideController::class, 'editarForm'])->name('slides.editar_form');
		Route::post('editar/{hash_id}', [SlideController::class, 'editar'])->name('slides.editar');
		Route::get('ordenar', [SlideController::class, 'ordenarForm'])->name('slides.ordenar_form');
		Route::post('ordenar', [SlideController::class, 'ordenar'])->name('slides.ordenar');
		Route::get('eliminar/{hash_id?}', [SlideController::class, 'eliminar'])->name('slides.eliminar');
		// Imagen
		Route::post('subir-imagen', [SlideController::class, 'subirImagen'])->name('slides.subir_imagen');
		Route::post('eliminar-imagen', [SlideController::class, 'eliminarImagen'])->name('slides.eliminar_imagen');
		// Imagen Móvil
		Route::post('subir-imagen-movil', [SlideController::class, 'subirImagenMovil'])->name('slides.subir_imagen_movil');
		Route::post('eliminar-imagen-movil', [SlideController::class, 'eliminarImagenMovil'])->name('slides.eliminar_imagen_movil');
	});

	/*----------  Preguntas Frecuentes  ----------*/
	Route::group(['prefix'=>'preguntas'], function(){
		Route::get('/', [PreguntaController::class, 'index'])->name('preguntas');
		Route::get('agregar', [PreguntaController::class, 'agregarForm'])->name('preguntas.agregar_form');
		Route::post('agregar', [PreguntaController::class, 'agregar'])->name('preguntas.agregar');
		Route::get('editar/{hash_id}', [PreguntaController::class, 'editarForm'])->name('preguntas.editar_form');
		Route::post('editar/{hash_id}', [PreguntaController::class, 'editar'])->name('preguntas.editar');
		Route::get('ordenar', [PreguntaController::class, 'ordenarForm'])->name('preguntas.ordenar_form');
		Route::post('ordenar', [PreguntaController::class, 'ordenar'])->name('preguntas.ordenar');
		Route::get('eliminar/{hash_id?}', [PreguntaController::class, 'eliminar'])->name('preguntas.eliminar');
	});

	/*----------  Idiomas  ----------*/
	Route::group(['prefix'=>'idiomas'], function(){
		Route::get('/', [IdiomaController::class, 'index'])->name('idiomas');
		Route::get('agregar', [IdiomaController::class, 'agregarForm'])->name('idiomas.agregar_form');
		Route::post('agregar', [IdiomaController::class, 'agregar'])->name('idiomas.agregar');
		Route::get('editar/{hash_id}', [IdiomaController::class, 'editarForm'])->name('idiomas.editar_form');
		Route::post('editar/{hash_id}', [IdiomaController::class, 'editar'])->name('idiomas.editar');
		Route::get('ordenar', [IdiomaController::class, 'ordenarForm'])->name('idiomas.ordenar_form');
		Route::post('ordenar', [IdiomaController::class, 'ordenar'])->name('idiomas.ordenar');
		Route::get('eliminar/{hash_id?}', [IdiomaController::class, 'eliminar'])->name('idiomas.eliminar');
	});

	/*----------  Ingredientes  ----------*/
	Route::group(['prefix'=>'ingredientes'], function(){
		Route::get('/', [IngredienteController::class, 'index'])->name('ingredientes');
		Route::get('agregar', [IngredienteController::class, 'agregarForm'])->name('ingredientes.agregar_form');
		Route::post('agregar', [IngredienteController::class, 'agregar'])->name('ingredientes.agregar');
		Route::get('editar/{hash_id}', [IngredienteController::class, 'editarForm'])->name('ingredientes.editar_form');
		Route::post('editar/{hash_id}', [IngredienteController::class, 'editar'])->name('ingredientes.editar');
		Route::get('ordenar', [IngredienteController::class, 'ordenarForm'])->name('ingredientes.ordenar_form');
		Route::post('ordenar', [IngredienteController::class, 'ordenar'])->name('ingredientes.ordenar');
		Route::get('eliminar/{hash_id?}', [IngredienteController::class, 'eliminar'])->name('ingredientes.eliminar');
	});

	/*----------  Categorías Productos  ----------*/
	Route::group(['prefix'=>'categorias-productos'], function(){
		Route::get('/', [CategoriaProductoController::class, 'index'])->name('categorias_productos');
		Route::get('agregar', [CategoriaProductoController::class, 'agregarForm'])->name('categorias_productos.agregar_form');
		Route::post('agregar', [CategoriaProductoController::class, 'agregar'])->name('categorias_productos.agregar');
		Route::get('editar/{hash_id}', [CategoriaProductoController::class, 'editarForm'])->name('categorias_productos.editar_form');
		Route::post('editar/{hash_id}', [CategoriaProductoController::class, 'editar'])->name('categorias_productos.editar');
		Route::get('ordenar/{idioma_id?}', [CategoriaProductoController::class, 'ordenarForm'])->name('categorias_productos.ordenar_form');
		Route::post('ordenar', [CategoriaProductoController::class, 'ordenar'])->name('categorias_productos.ordenar');
		Route::get('eliminar/{hash_id?}', [CategoriaProductoController::class, 'eliminar'])->name('categorias_productos.eliminar');
		Route::post('subir-banner', [CategoriaProductoController::class, 'subirBanner'])->name('categorias_productos.subir_banner');
		Route::post('eliminar-banner', [CategoriaProductoController::class, 'eliminarBanner'])->name('categorias_productos.eliminar_banner');
	});

	/*----------  Categorías Recetas  ----------*/
	Route::group(['prefix'=>'categorias-recetas'], function(){
		Route::get('/', [CategoriaRecetaController::class, 'index'])->name('categorias_recetas');
		Route::get('agregar', [CategoriaRecetaController::class, 'agregarForm'])->name('categorias_recetas.agregar_form');
		Route::post('agregar', [CategoriaRecetaController::class, 'agregar'])->name('categorias_recetas.agregar');
		Route::get('editar/{hash_id}', [CategoriaRecetaController::class, 'editarForm'])->name('categorias_recetas.editar_form');
		Route::post('editar/{hash_id}', [CategoriaRecetaController::class, 'editar'])->name('categorias_recetas.editar');
		Route::get('ordenar/{idioma_id?}', [CategoriaRecetaController::class, 'ordenarForm'])->name('categorias_recetas.ordenar_form');
		Route::post('ordenar', [CategoriaRecetaController::class, 'ordenar'])->name('categorias_recetas.ordenar');
		Route::get('eliminar/{hash_id?}', [CategoriaRecetaController::class, 'eliminar'])->name('categorias_recetas.eliminar');
	});

	/*----------  Productos  ----------*/
	Route::group(['prefix'=>'productos'], function(){
		Route::get('/', [ProductoController::class, 'index'])->name('productos');
		Route::get('agregar', [ProductoController::class, 'agregarForm'])->name('productos.agregar_form');
		Route::post('agregar', [ProductoController::class, 'agregar'])->name('productos.agregar');
		Route::get('ver/{hash_id}', [ProductoController::class, 'ver'])->name('productos.ver');
		Route::get('editar/{hash_id}', [ProductoController::class, 'editarForm'])->name('productos.editar_form');
		Route::post('editar/{hash_id}', [ProductoController::class, 'editar'])->name('productos.editar');
		Route::get('ordenar/{categoria_id?}', [ProductoController::class, 'ordenarForm'])->name('productos.ordenar_form');
		Route::post('ordenar', [ProductoController::class, 'ordenar'])->name('productos.ordenar');
		Route::get('eliminar/{hash_id?}', [ProductoController::class, 'eliminar'])->name('productos.eliminar');
		Route::post('subir-imagen', [ProductoController::class, 'subirImagen'])->name('productos.subir_imagen');
		Route::post('eliminar-imagen', [ProductoController::class, 'eliminarImagen'])->name('productos.eliminar_imagen');
		// Ficha
		Route::post('subir-ficha', [ProductoController::class, 'subirFicha'])->name('productos.subir_ficha');
		Route::post('eliminar-ficha', [ProductoController::class, 'eliminarFicha'])->name('productos.eliminar_ficha');
		// Tabla Nutrimental
		Route::post('subir-tabla-nutrimental', [ProductoController::class, 'subirTablaNutrimental'])->name('productos.subir_tabla_nutrimental');
		Route::post('eliminar-tabla-nutrimental', [ProductoController::class, 'eliminarTablaNutrimental'])->name('productos.eliminar_tabla_nutrimental');
	});

	/*----------  Imagenes  ----------*/
	Route::group(['prefix'=>'imagenes'], function(){
		Route::post('agregar', [ImagenController::class, 'agregar'])->name('imagenes.agregar');
		Route::post('ordenar', [ImagenController::class, 'ordenar'])->name('imagenes.ordenar');
		Route::any('eliminar/{hash_id?}', [ImagenController::class, 'eliminar'])->name('imagenes.eliminar');
		Route::post('subir-imagen', [ImagenController::class, 'subirImagen'])->name('imagenes.subir_imagen');
		Route::post('eliminar-imagen', [ImagenController::class, 'eliminarImagen'])->name('imagenes.eliminar_imagen');
	});

	/*----------  Recetas  ----------*/
	Route::group(['prefix'=>'recetas'], function(){
		Route::get('/', [RecetaController::class, 'index'])->name('recetas');
		Route::get('agregar', [RecetaController::class, 'agregarForm'])->name('recetas.agregar_form');
		Route::post('agregar', [RecetaController::class, 'agregar'])->name('recetas.agregar');
		Route::get('ver/{hash_id}', [RecetaController::class, 'ver'])->name('recetas.ver');
		Route::get('editar/{hash_id}', [RecetaController::class, 'editarForm'])->name('recetas.editar_form');
		Route::post('editar/{hash_id}', [RecetaController::class, 'editar'])->name('recetas.editar');
		Route::get('ordenar', [RecetaController::class, 'ordenarForm'])->name('recetas.ordenar_form');
		Route::post('ordenar', [RecetaController::class, 'ordenar'])->name('recetas.ordenar');
		Route::post('eliminar/{hash_id?}', [RecetaController::class, 'eliminar'])->name('recetas.eliminar');
		Route::post('subir-imagen', [RecetaController::class, 'subirImagen'])->name('recetas.subir_imagen');
		Route::post('eliminar-imagen', [RecetaController::class, 'eliminarImagen'])->name('recetas.eliminar_imagen');

		// Ingredientes
		Route::post('agregar-ingredientes', [RecetaController::class, 'agregarIngredientes'])->name('recetas.agregar_ingredientes');
	});

	/*----------  Blog  ----------*/
	Route::group(['prefix'=>'posts'], function(){
		Route::get('/', [PostController::class, 'index'])->name('posts');
		Route::get('agregar', [PostController::class, 'agregarForm'])->name('posts.agregar_form');
		Route::post('agregar', [PostController::class, 'agregar'])->name('posts.agregar');
		Route::get('ver/{hash_id}', [PostController::class, 'ver'])->name('posts.ver');
		Route::get('editar/{hash_id}', [PostController::class, 'editarForm'])->name('posts.editar_form');
		Route::post('editar/{hash_id}', [PostController::class, 'editar'])->name('posts.editar');
		Route::get('ordenar', [PostController::class, 'ordenarForm'])->name('posts.ordenar_form');
		Route::post('ordenar', [PostController::class, 'ordenar'])->name('posts.ordenar');
		Route::post('eliminar/{hash_id?}', [PostController::class, 'eliminar'])->name('posts.eliminar');
		Route::post('subir-imagen', [PostController::class, 'subirImagen'])->name('posts.subir_imagen');
		Route::post('eliminar-imagen', [PostController::class, 'eliminarImagen'])->name('posts.eliminar_imagen');
	});

	/*----------  Vacantes  ----------*/
	Route::group(['prefix'=>'vacantes'], function(){
		Route::get('/', [VacanteController::class, 'index'])->name('vacantes');
		Route::get('agregar', [VacanteController::class, 'agregarForm'])->name('vacantes.agregar_form');
		Route::post('agregar', [VacanteController::class, 'agregar'])->name('vacantes.agregar');
		Route::get('ver/{hash_id}', [VacanteController::class, 'ver'])->name('vacantes.ver');
		Route::get('editar/{hash_id}', [VacanteController::class, 'editarForm'])->name('vacantes.editar_form');
		Route::post('editar/{hash_id}', [VacanteController::class, 'editar'])->name('vacantes.editar');
		Route::get('ordenar', [VacanteController::class, 'ordenarForm'])->name('vacantes.ordenar_form');
		Route::post('ordenar', [VacanteController::class, 'ordenar'])->name('vacantes.ordenar');
		Route::any('eliminar/{hash_id?}', [VacanteController::class, 'eliminar'])->name('vacantes.eliminar');
		Route::post('subir-imagen', [VacanteController::class, 'subirImagen'])->name('vacantes.subir_imagen');
		Route::post('eliminar-imagen', [VacanteController::class, 'eliminarImagen'])->name('vacantes.eliminar_imagen');
	});

	/*----------  Traducciones  ----------*/
	Route::group(['prefix'=>'traducciones'], function(){
		Route::get('/', [TraduccionController::class, 'index'])->name('traducciones');
		Route::get('agregar', [TraduccionController::class, 'agregarForm'])->name('traducciones.agregar_form');
		Route::post('agregar', [TraduccionController::class, 'agregar'])->name('traducciones.agregar');
		Route::get('editar/{hash_id}', [TraduccionController::class, 'editarForm'])->name('traducciones.editar_form');
		Route::post('editar/{hash_id}', [TraduccionController::class, 'editar'])->name('traducciones.editar');
		Route::post('eliminar/{hash_id}', [TraduccionController::class, 'eliminar'])->name('traducciones.eliminar');

		Route::post('editar-detalle', [TraduccionController::class, 'editarDetalle'])->name('traducciones.editar_detalle');
		Route::post('eliminar-detalle', [TraduccionController::class, 'eliminarDetalle'])->name('traducciones.eliminar_detalle');
	});


	/*----------  Usuarios  ----------*/
	Route::group(['prefix'=>'usuarios'], function(){
		Route::get('/', [UserController::class, 'index'])->name('usuarios');
		Route::get('agregar', [UserController::class, 'agregarForm'])->name('usuarios.agregar_form');
		Route::post('agregar', [UserController::class, 'agregar'])->name('usuarios.agregar');
		Route::get('ver/{hash_id}', [UserController::class, 'ver'])->name('usuarios.ver');
		Route::get('editar/{hash_id}', [UserController::class, 'editarForm'])->name('usuarios.editar_form');
		Route::post('editar/{hash_id}', [UserController::class, 'editar'])->name('usuarios.editar');
		Route::get('eliminar/{hash_id?}', [UserController::class, 'eliminar'])->name('usuarios.eliminar');
	});


	/*----------  Configuraciones  ----------*/
	Route::group(["prefix"=>"configuraciones"], function(){
        Route::get('/', [ConfiguracionController::class, 'editarForm'])->name('configuraciones.editar_form');
        Route::post('/', [ConfiguracionController::class, 'editar'])->name('configuraciones.editar');
        Route::get('respaldos', [ConfiguracionController::class, 'respaldos'])->name('configuraciones.respaldos');
        // Logo
        Route::post('subir-logo', [ConfiguracionController::class, 'subirLogo'])->name('configuraciones.subir_logo');
        Route::post('eliminar-logo', [ConfiguracionController::class, 'eliminarLogo'])->name('configuraciones.eliminar_logo');
        // Logo Header
        Route::post('subir-logo-header', [ConfiguracionController::class, 'subirLogoHeader'])->name('configuraciones.subir_logo_header');
        Route::post('eliminar-logo-header', [ConfiguracionController::class, 'eliminarLogoHeader'])->name('configuraciones.eliminar_logo_header');
        // Portada
        Route::post('subir-portada', [ConfiguracionController::class, 'subirPortada'])->name('configuraciones.subir_portada');
        Route::post('eliminar-portada', [ConfiguracionController::class, 'eliminarPortada'])->name('configuraciones.eliminar_portada');
        // Favicon
        Route::post('subir-favicon', [ConfiguracionController::class, 'subirFavicon'])->name('configuraciones.subir_favicon');
        Route::post('eliminar-favicon', [ConfiguracionController::class, 'eliminarFavicon'])->name('configuraciones.eliminar_favicon');
    });


	// Subir archivos
	Route::group(['prefix'=>'uploads'], function(){
		Route::post('subir', [UploadController::class, 'subir'])->name('uploads_subir');
	});

	Route::get('/cache', function() {
	    Artisan::call('view:clear');
	    Artisan::call('route:clear');
	    Artisan::call('config:clear');
	    Artisan::call('cache:clear');

	    return redirect()->back();
	})->name('clear_cache');

	// Components
	Route::group(['prefix'=>'components'], function(){

		// Date
		Route::get('date', function(){
			return view('admin.modules.components.date');
		})->name('components_date');

		// Summernote
		Route::get('summernote', function(){
			return view('admin.modules.components.summernote');
		})->name('components_summernote');

		// Bootstrap Toggle
		Route::get('bootstrap-toggle', function(){
			return view('admin.modules.components.bootstrap-toggle');
		})->name('components_toggle');

		// Data Tables
		Route::get('data-tables', function(){
			return view('admin.modules.components.data-tables');
		})->name('components_datatables');

		// Btn Eliminar
		Route::get('btn-eliminar', function(){
			return view('admin.modules.components.btn-eliminar');
		})->name('components_eliminar');

		// Btn Eliminar
		Route::get('select2', function(){
			return view('admin.modules.components.select2');
		})->name('components_select2');

		// Money
		Route::get('money', function(){
			return view('admin.modules.components.money');
		})->name('components_money');

		// Color Picker
		Route::get('color-picker', function(){
			return view('admin.modules.components.color-picker');
		})->name('components_colorpicker');

		// Tags Input
		Route::get('tags-input', function(){
			return view('admin.modules.components.tags-input');
		})->name('components_tagsinput');

		// File Input
		Route::get('file-input', function(){
			return view('admin.modules.components.file-input');
		})->name('components_fileinput');

		// Slugify
		Route::get('slugify', function(){
			return view('admin.modules.components.slugify');
		})->name('components_slugify');

		// Maxlenght
		Route::get('maxlength', function(){
			return view('admin.modules.components.maxlength');
		})->name('components_maxlength');

		// Font Picker
		Route::get('fontpicker', function(){
			return view('admin.modules.components.fontpicker');
		})->name('components_fontpicker');

		// Icon Picker
		Route::get('iconpicker', function(){
			return view('admin.modules.components.iconpicker');
		})->name('components_iconpicker');

	});
});

