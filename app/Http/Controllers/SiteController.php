<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Idioma;
use App\Models\Post;
use App\Models\Receta;
use App\Models\Pregunta;
use App\Models\Vacante;
use App\Models\CategoriaProducto;
use App\Models\CategoriaReceta;
use App\Models\Producto;
use App\Models\Ingrediente;
use App\Models\Slide;
use App;
use Mail;

class SiteController extends Controller
{
    /*----------  Obteniendo el idioma  ----------*/
    public function getLang()
    {
        //$idioma = Idioma::select('id')->where('clave', App::currentLocale())->first()['id'];
        $idioma = Idioma::select('*')->where('clave', App::currentLocale())->first();
        session()->put('idioma', $idioma);
        return $idioma;
    }

    /*----------  Home  ----------*/
    public function index()
    {
        $idioma = $this->getLang();
        $recetas = Receta::where('activo', '1')->where('idioma_id', $idioma->id)->orderBy('orden', 'ASC')->take(6)->get();
        $blogs = Post::where('activo', '1')->where('idioma_id', $idioma->id)->orderBy('orden', 'ASC')->take(3)->get();
        $slides = Slide::where('activo', '1')->where('idioma_id', $idioma->id)->orderBy('orden', 'ASC')->get();

        $requested_url = $_SERVER['REQUEST_URI'];
        $redirect_url = 'http://gab.mrlucky.com.mx/ventasnew';

        // Redirigir solo si la URL solicitada coincide con '/ventasnew'
        if ($requested_url == 'http://www.mrlucky.com.mx/ventasnew') {
            header('Location: ' . $redirect_url);
            exit(); // Asegurarse de que el script se detenga después de la redirección
        }
        return view('site.pages.inicio', compact('idioma', 'recetas', 'blogs', 'slides'));
    }

    /*----------  Nosotros  ----------*/
    public function nosotros()
    {
        $idioma = $this->getLang();
        return view('site.pages.nosotros', compact('idioma'));
    }

    /*----------  GAB  ----------*//*----------  GAB  ----------*//*----------  GAB  ----------*//*----------  GAB  ----------*/
    public function ventasnew()
    {
        $idioma = $this->getLang();
        $redirect_url = 'http://gab.mrlucky.com.mx/ventasnew';
        return Redirect($redirect_url);
    }
    public function ventas()
    {
        $idioma = $this->getLang();
        $redirect_url = 'http://gab.mrlucky.com.mx/ventas';
        return Redirect($redirect_url);
    }
    public function fletes()
    {
        $idioma = $this->getLang();
        $redirect_url = 'http://gab.mrlucky.com.mx/fletes';
        return Redirect($redirect_url);
    }
    public function trazabilidad()
    {
        $idioma = $this->getLang();
        $redirect_url = '';

        // Verificar el idioma y establecer la URL de redirección apropiada
        if ($idioma == 'en') {
            $redirect_url = 'http://gab.mrlucky.com.mx/english/trazabilidad/index.html';
        } else {
            $redirect_url = 'http://gab.mrlucky.com.mx/trazabilidad';
        }

        // Redirigir al usuario a la URL determinada
        // return redirect()->away($redirect_url);
        return Redirect::to($redirect_url);
    }
    public function tr(Request $request)
    {
        $idioma = $this->getLang();
        $id_codigo = $request->query('id_codigo');
        $redirect_url = 'http://gab.mrlucky.com.mx/tr/trazabilidad2_dmi.php?id_codigo=' . $id_codigo;
        return Redirect::to($redirect_url);
    }
    public function trazabilidadLote(Request $request)
    {
        $idioma = $this->getLang();
        $cve_odp = $request->query('cve_odp');
        $redirect_url = 'http://gab.mrlucky.com.mx/trazabilidad/traza_prod_esp.php?cve_odp=' . $cve_odp;
        return Redirect::to($redirect_url);
    }
    public function trazabilidadPTI(Request $request)
    {
        $idioma = $this->getLang();
        $id_codigo = $request->query('id_codigo');
        $redirect_url = '';

        // Verificar el idioma y establecer la URL de redirección apropiada
        if ($idioma == 'en') {
            $redirect_url = 'http://gab.mrlucky.com.mx/trazabilidad/traza_esp_pti.php?id_codigo=' . $id_codigo;
        } else {

            $redirect_url = 'http://gab.mrlucky.com.mx/english/trazabilidad/traza_ing_pti.php?id_codigo=' . $id_codigo;
        }

        // $redirect_url = 'http://gab.mrlucky.com.mx/trazabilidad/traza_esp_pti.php?id_codigo=' . $id_codigo;
        return Redirect::to($redirect_url);
    }
    public function trazabilidadPT(Request $request)
    {
        $idioma = $this->getLang();
        $cve_odp = $request->query('cve_odp');
        $redirect_url = 'http://gab.mrlucky.com.mx/trazabilidad/traza_pt_esp.php?cve_odp=' . $cve_odp;
        return Redirect::to($redirect_url);
    }
    public function embarques()
    {
        $idioma = $this->getLang();
        $redirect_url = 'http://gab.mrlucky.com.mx/ventas/indexemb.php';
        return Redirect($redirect_url);
    }
    public function sisgabweb()
    {
        //www1166
        //taQ17Zm
        $redirect_url = 'ftp://www1166:taQ17Zm@gab.mrlucky.com.mx/sisgabweb';
        return Redirect($redirect_url);
    }
    public function monitorVentas(Request $request){
        $idioma = $this->getLang();
        $varx = $request->query('varx');

        $redirect_url = 'http://gab.mrlucky.com.mx/ventas/monitor_pc.php?varx=1366' . $varx;
        return Redirect($redirect_url);
    }
/*----------  GAB  ----------*//*----------  GAB  ----------*//*----------  GAB  ----------*//*----------  GAB  ----------*/

    /*----------  Compromiso  ----------*/
    public function compromiso()
    {
        $idioma = $this->getLang();
        return view('site.pages.compromiso', compact('idioma'));
    }

    /*----------  Productos  ----------*/
    public function productos()
    {
        $idioma = $this->getLang();
        $categorias = CategoriaProducto::where('activo', '1')->where('idioma_id', $idioma->id)->orderBy('orden', 'ASC')->get();
        return view('site.pages.productos', compact('idioma', 'categorias'));
    }

    /*----------  Producto  ----------*/
    public function producto($slug)
    {
        $idioma = $this->getLang();
        $producto = Producto::where('activo', '1')->where('slug', $slug)->first();
        return view('site.pages.producto', compact('idioma', 'producto'));
    }

    /*----------  Grupo U  ----------*/
    public function grupoU()
    {
        $idioma = $this->getLang();
        return view('site.pages.grupo-u', compact('idioma'));
    }

    /*----------  Contacto  ----------*/
    public function contacto()
    {
        $idioma = $this->getLang();
        $blogs = Post::where('activo', '1')->where('idioma_id', $idioma->id)->orderBy('orden', 'ASC')->take(3)->get();
        $preguntas = Pregunta::where('activo', '1')->where('idioma_id', $idioma->id)->orderBy('orden', 'ASC')->get();
        $vacantes = Vacante::where('activo', '1')->where('idioma_id', $idioma->id)->orderBy('orden', 'ASC')->get();

        return view('site.pages.contacto', compact('idioma', 'blogs', 'preguntas', 'vacantes'));
    }

    /*----------  Blog  ----------*/
    public function blog()
    {
        $idioma = $this->getLang();
        $destacado = Post::where('activo', '1')->where('destacado', '1')->where('idioma_id', $idioma->id)->first();
        $blogs = Post::where('activo', '1')->where('destacado', '0')->where('idioma_id', $idioma->id)->orderBy('orden', 'ASC')->paginate(6);

        return view('site.pages.blog', compact('idioma', 'blogs', 'destacado'));
    }

    /*----------  Post  ----------*/
    public function post($slug)
    {
        $idioma = $this->getLang();
        $post = Post::where('activo', '1')->where('slug', $slug)->first();

        return view('site.pages.post', compact('idioma', 'post'));
    }

    /*----------  Recetas  ----------*/
    public function recetas()
    {
        $idioma = $this->getLang();
        $categorias = CategoriaReceta::where('idioma_id', $idioma->id)->get();
        $ingredientes = Ingrediente::where('idioma_id', $idioma->id)->get();

        $recetas = Receta::where('activo', '1')->where('idioma_id', $idioma->id);

        if (request('categoria') && request('categoria') != '')
            $recetas = $recetas->where('categoria_id', request('categoria'));

        if (request('tiempo') && request('tiempo') != '')
            $recetas = $recetas->where('tiempo', '<=', request('tiempo'));

        if (request('ingredientes') && request('ingredientes') != '') {
            //dd(request()->all());
            $recetas = $recetas->whereHas('ingredientes', function ($query) {
                $query->where('ingrediente_id', request('ingredientes'));
            });
        }

        $recetas = $recetas->orderBy('orden', 'ASC')->paginate(6);

        return view('site.pages.recetas', compact('idioma', 'recetas', 'categorias', 'ingredientes'));
    }

    /*----------  Receta  ----------*/
    public function receta($slug)
    {
        $idioma = $this->getLang();
        $receta = Receta::where('activo', '1')->where('slug', $slug)->first();

        return view('site.pages.receta', compact('idioma', 'receta'));
    }

    /*----------  Vacantes  ----------*/
    public function vacantes()
    {
        $idioma = $this->getLang();
        $vacantes = Vacante::where('activo', '1')->where('idioma_id', $idioma->id)->orderBy('orden', 'ASC')->get();

        return view('site.pages.vacantes', compact('idioma', 'vacantes'));
    }

    /*----------  Vacante  ----------*/
    public function vacante($slug)
    {
        $idioma = $this->getLang();
        $vacante = Vacante::where('activo', '1')->where('slug', $slug)->first();

        return view('site.pages.vacante', compact('idioma', 'vacante'));
    }

    /*----------  Enviar Contacto  ----------*/
    public function enviarContacto(Request $request)
    {
    	if (!empty($_POST['website'])) {
    		exit("Bot detectado (honeypot).\n");
		}

    	# Comprobamos si enviaron el dato
		if (!isset($_POST["g-recaptcha-response"]) || empty($_POST["g-recaptcha-response"])) {
    		exit("Debes completar el captcha");
		}

    	# Antes de comprobar usuario y contraseña, vemos si resolvieron el captcha
		$token = $_POST["g-recaptcha-response"];
		$verificado = $this->verificarToken($token, '6LezXjArAAAAAFONZGhY728H82z4DzsQ5AEpMHoS');

    	if($verificado){
        	//dd($request->all());
        	$data = $request->all();
        	$enviarA = explode(',', $data['area']);

        	//$enviarA = 'lescobar@brandhouse.com.mx';

        	//dd($enviarA);

        	Mail::send('mails.contacto', $data, function ($m) use ($data, $enviarA) {
            	$m->from($data['email'], 'Web Mr Lucky');
            	$m->to($enviarA);
            	$m->subject('Contacto web');
        	});

        	return redirect(route(App::currentLocale() . '.inicio') . '?send=1');
        }

    	return redirect(route(App::currentLocale() . '.inicio'));

    }

	function verificarToken($token, $claveSecreta)
{
    # La API en donde verificamos el token
    $url = "https://www.google.com/recaptcha/api/siteverify";
    # Los datos que enviamos a Google
    $datos = [
        "secret" => $claveSecreta,
        "response" => $token,
    ];
    // Crear opciones de la petición HTTP
    $opciones = array(
        "http" => array(
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => "POST",
            "content" => http_build_query($datos), # Agregar el contenido definido antes
        ),
    );
    # Preparar petición
    $contexto = stream_context_create($opciones);
    # Hacerla
    $resultado = file_get_contents($url, false, $contexto);
    # Si hay problemas con la petición (por ejemplo, que no hay internet o algo así)
    # entonces se regresa false. Este NO es un problema con el captcha, sino con la conexión
    # al servidor de Google
    if ($resultado === false) {
        # Error haciendo petición
        return false;
    }

    # En caso de que no haya regresado false, decodificamos con JSON
    # https://parzibyte.me/blog/2018/12/26/codificar-decodificar-json-php/

    $resultado = json_decode($resultado);
    # La variable que nos interesa para saber si el usuario pasó o no la prueba
    # está en success
    $pruebaPasada = $resultado->success;
    # Regresamos ese valor, y listo (sí, ya sé que se podría regresar $resultado->success)
    return $pruebaPasada;
}
}
