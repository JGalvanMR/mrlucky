<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;

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
use App\Models\Rancho;
use App\Models\TipoCertificacion;
use Illuminate\Support\Facades\Cache;

class SiteController extends Controller
{
    /*---------- Obteniendo el idioma ----------*/
    public function getLang()
    {
        $idioma = Idioma::where('clave', App::currentLocale())->firstOrFail();
        session()->put('idioma', $idioma);

        return $idioma;
    }

    /*---------- Home ----------*/
    public function index()
    {
        $idioma = $this->getLang();

        $recetas = Receta::where('activo', '1')
            ->where('idioma_id', $idioma->id)
            ->orderBy('orden', 'ASC')
            ->take(6)
            ->get();

        $blogs = Post::where('activo', '1')
            ->where('idioma_id', $idioma->id)
            ->orderBy('orden', 'ASC')
            ->take(3)
            ->get();

        $slides = Slide::where('activo', '1')
            ->where('idioma_id', $idioma->id)
            ->orderBy('orden', 'ASC')
            ->get();

        return view('site.pages.inicio', compact('idioma', 'recetas', 'blogs', 'slides'));
    }

    /*---------- Nosotros ----------*/
    public function nosotros()
    {
        $idioma = $this->getLang();
        return view('site.pages.nosotros', compact('idioma'));
    }

    /*---------- GAB ----------*/
    public function ventasnew()
    {
        $this->getLang();
        return redirect()->away('http://gab.mrlucky.com.mx/ventasnew');
    }

    public function ventas()
    {
        $this->getLang();
        return redirect()->away('http://gab.mrlucky.com.mx/ventas');
    }

    public function fletes()
    {
        $this->getLang();
        return redirect()->away('http://gab.mrlucky.com.mx/fletes');
    }

    public function trazabilidad()
    {
        $idioma = $this->getLang();

        $redirect_url = $idioma->clave === 'en'
            ? 'http://gab.mrlucky.com.mx/english/trazabilidad/index.html'
            : 'http://gab.mrlucky.com.mx/trazabilidad';

        return redirect()->away($redirect_url);
    }

    public function tr(Request $request)
    {
        $this->getLang();

        $id_codigo = $request->query('id_codigo');
        $redirect_url = 'http://gab.mrlucky.com.mx/tr/trazabilidad2_dmi.php?id_codigo=' . $id_codigo;

        return redirect()->away($redirect_url);
    }

    public function trazabilidadLote(Request $request)
    {
        $this->getLang();

        $cve_odp = $request->query('cve_odp');
        $redirect_url = 'http://gab.mrlucky.com.mx/trazabilidad/traza_prod_esp.php?cve_odp=' . $cve_odp;

        return redirect()->away($redirect_url);
    }

    public function trazabilidadPTI(Request $request)
    {
        $idioma = $this->getLang();
        $id_codigo = $request->query('id_codigo');

        $redirect_url = $idioma->clave === 'en'
            ? 'http://gab.mrlucky.com.mx/english/trazabilidad/traza_ing_pti.php?id_codigo=' . $id_codigo
            : 'http://gab.mrlucky.com.mx/trazabilidad/traza_esp_pti.php?id_codigo=' . $id_codigo;

        return redirect()->away($redirect_url);
    }

    public function trazabilidadPT(Request $request)
    {
        $this->getLang();

        $cve_odp = $request->query('cve_odp');
        $redirect_url = 'http://gab.mrlucky.com.mx/trazabilidad/traza_pt_esp.php?cve_odp=' . $cve_odp;

        return redirect()->away($redirect_url);
    }

    public function embarques()
    {
        $this->getLang();
        return redirect()->away('http://gab.mrlucky.com.mx/ventas/indexemb.php');
    }

    public function sisgabweb()
    {
        return redirect()->away('ftp://www1166:taQ17Zm@gab.mrlucky.com.mx/sisgabweb');
    }

    public function monitorVentas(Request $request)
    {
        $this->getLang();

        $varx = $request->query('varx', '');
        $redirect_url = 'http://gab.mrlucky.com.mx/ventas/monitor_pc.php?varx=' . $varx;

        return redirect()->away($redirect_url);
    }

    /*---------- Compromiso ----------*/
    public function compromiso()
    {
        $idioma = $this->getLang();
        return view('site.pages.compromiso', compact('idioma'));
    }

    /*-----------------Certificaciones-----------------*/
    public function certificaciones()
    {
        $tipoSlug = 'primusgfs';

        $tipoCertificacion = Cache::remember("tipo_cert.{$tipoSlug}", 3600, function () use ($tipoSlug) {
            return TipoCertificacion::where('slug', $tipoSlug)
                ->where('activo', true)
                ->firstOrFail();
        });

        $cacheKey = "mosaico.{$tipoSlug}.publico";
        $ranchos = Cache::remember($cacheKey, 1800, function () use ($tipoCertificacion) {
            return Rancho::activos()
                ->with([
                    'certificacion' => function ($query) use ($tipoCertificacion) {
                        $query->where('tipo_certificacion_id', $tipoCertificacion->id)
                            ->where('visible_publico', true)
                            ->orderByDesc('fecha_vencimiento');
                    }
                ])
                ->whereHas('certificacion', function ($q) use ($tipoCertificacion) {
                    $q->where('tipo_certificacion_id', $tipoCertificacion->id)
                        ->where('visible_publico', true);
                })
                ->get()
                ->map(function ($rancho) {
                    $rancho->cert = $rancho->certificacion->first();
                    return $rancho;
                });
        });

        return view('site.pages.certificaciones', compact('ranchos', 'tipoCertificacion'));
    }

    /*---------- Productos ----------*/
    public function productos()
    {
        $idioma = $this->getLang();

        $categorias = CategoriaProducto::where('activo', '1')
            ->where('idioma_id', $idioma->id)
            ->orderBy('orden', 'ASC')
            ->get();

        return view('site.pages.productos', compact('idioma', 'categorias'));
    }

    /*---------- Producto ----------*/
    public function producto($slug = null)
    {
        $idioma = $this->getLang();

        $producto = Producto::where('activo', '1')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('site.pages.producto', compact('idioma', 'producto'));
    }

    /*---------- Grupo U ----------*/
    public function grupoU()
    {
        $idioma = $this->getLang();
        return view('site.pages.grupo-u', compact('idioma'));
    }

    /*---------- Contacto ----------*/
    public function contacto()
    {
        $idioma = $this->getLang();

        $blogs = Post::where('activo', '1')
            ->where('idioma_id', $idioma->id)
            ->orderBy('orden', 'ASC')
            ->take(3)
            ->get();

        $preguntas = Pregunta::where('activo', '1')
            ->where('idioma_id', $idioma->id)
            ->orderBy('orden', 'ASC')
            ->get();

        $vacantes = Vacante::where('activo', '1')
            ->where('idioma_id', $idioma->id)
            ->orderBy('orden', 'ASC')
            ->get();

        return view('site.pages.contacto', compact('idioma', 'blogs', 'preguntas', 'vacantes'));
    }

    /*---------- Blog ----------*/
    public function blog()
    {
        $idioma = $this->getLang();

        $destacado = Post::where('activo', '1')
            ->where('destacado', '1')
            ->where('idioma_id', $idioma->id)
            ->first();

        $blogs = Post::where('activo', '1')
            ->where('destacado', '0')
            ->where('idioma_id', $idioma->id)
            ->orderBy('orden', 'ASC')
            ->paginate(6);

        return view('site.pages.blog', compact('idioma', 'blogs', 'destacado'));
    }

    /*---------- Post ----------*/
    public function post($slug)
    {
        $idioma = $this->getLang();

        $post = Post::where('activo', '1')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('site.pages.post', compact('idioma', 'post'));
    }

    /*---------- Recetas ----------*/
    public function recetas()
    {
        $idioma = $this->getLang();

        $categorias = CategoriaReceta::where('idioma_id', $idioma->id)->get();
        $ingredientes = Ingrediente::where('idioma_id', $idioma->id)->get();

        $recetas = Receta::where('activo', '1')
            ->where('idioma_id', $idioma->id);

        if (request('categoria')) {
            $recetas->where('categoria_id', request('categoria'));
        }

        if (request('tiempo')) {
            $recetas->where('tiempo', '<=', request('tiempo'));
        }

        if (request('ingredientes')) {
            $recetas->whereHas('ingredientes', function ($query) {
                $query->where('ingrediente_id', request('ingredientes'));
            });
        }

        $recetas = $recetas->orderBy('orden', 'ASC')->paginate(6);

        return view('site.pages.recetas', compact('idioma', 'recetas', 'categorias', 'ingredientes'));
    }

    /*---------- Receta ----------*/
    public function receta($slug)
    {
        $idioma = $this->getLang();

        $receta = Receta::where('activo', '1')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('site.pages.receta', compact('idioma', 'receta'));
    }

    /*---------- Vacantes ----------*/
    public function vacantes()
    {
        $idioma = $this->getLang();

        $vacantes = Vacante::where('activo', '1')
            ->where('idioma_id', $idioma->id)
            ->orderBy('orden', 'ASC')
            ->get();

        return view('site.pages.vacantes', compact('idioma', 'vacantes'));
    }

    /*---------- Vacante ----------*/
    public function vacante($slug)
    {
        $idioma = $this->getLang();

        $vacante = Vacante::where('activo', '1')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('site.pages.vacante', compact('idioma', 'vacante'));
    }

    /*---------- Boletín Flipbook ----------*/
    public function boletin($slug)
    {
        $idioma = $this->getLang()->clave;

        $boletines = [
            'heb' => [
                'titulo' => [
                    'es' => 'Passport To Produce H-E-B 2026 EXPO',
                    'en' => 'Passport To Produce H-E-B 2026 EXPO'
                ],
                'pdf' => [
                    'es' => 'docs/heb.pdf',
                    'en' => 'docs/heb.pdf'
                ],
                'numero' => '-',
                'ano' => '2026',
            ],
            'catalogo' => [
                'titulo' => [
                    'es' => 'Catalogo Mr. Lucky',
                    'en' => 'Mr. Lucky Catalog'
                ],
                'pdf' => [
                    'es' => 'docs/catalogo-mrlucky.pdf',
                    'en' => 'docs/catalogo-mrlucky-en.pdf'
                ],
                'numero' => '-',
                'ano' => '2026',
            ],
            'sustentabilidad' => [
                'titulo' => [
                    'es' => 'Sustentabilidad',
                    'en' => 'Sustainability'
                ],
                'pdf' => [
                    'es' => 'docs/Sustainability_2025.pdf',
                    'en' => 'docs/Sustainability_2025.pdf'
                ],
                'numero' => '-',
                'ano' => '2025',
            ],
            'boletin-13' => [
                'titulo' => [
                    'es' => 'Boletín Informativo No. 13 · Grupo U',
                    'en' => 'Newsletter No. 13 · Grupo U'
                ],
                'pdf' => [
                    'es' => 'docs/Boletin-13-Grupo-U.pdf',
                    'en' => 'docs/Newsletter-13-Grupo-U.pdf'
                ],
                'numero' => '13',
                'ano' => '2025',
            ],
            'boletin-14' => [
                'titulo' => [
                    'es' => 'Boletín Informativo No. 14 · Grupo U',
                    'en' => 'Newsletter No. 14 · Grupo U'
                ],
                'pdf' => [
                    'es' => 'docs/Boletin-14-Grupo-U.pdf',
                    'en' => 'docs/Newsletter-14-Grupo-U.pdf'
                ],
                'numero' => '14',
                'ano' => '2026',
            ],
            'boletin-15' => [
                'titulo' => [
                    'es' => 'Boletín Informativo No. 15 · Grupo U',
                    'en' => 'Newsletter No. 15 · Grupo U'
                ],
                'pdf' => [
                    'es' => 'docs/Boletin-15-Grupo-U.pdf',
                    'en' => 'docs/Newsletter-15-Grupo-U.pdf'
                ],
                'numero' => '15',
                'ano' => '2026',
            ],
            'recetario' => [
                'titulo' => [
                    'es' => 'Recetario Mr. Lucky · Calabazas',
                    'en' => 'Mr. Lucky Recipe Book · Pumpkins'
                ],
                'pdf' => [
                    'es' => 'docs/RECETARIO CALABAZAS MR. LUCKY.pdf',
                    'en' => 'docs/MR LUCKY PUMPKIN RECIPE BOOK.pdf'
                ],
                'numero' => '—',
                'ano' => '2024',
            ],
        ];

        abort_unless(array_key_exists($slug, $boletines), 404);

        $datosBoletin = $boletines[$slug];
        $langActivo = isset($datosBoletin['titulo'][$idioma]) ? $idioma : 'es';

        $boletin = [
            'titulo' => $datosBoletin['titulo'][$langActivo],
            'pdf' => $datosBoletin['pdf'][$langActivo],
            'numero' => $datosBoletin['numero'],
            'ano' => $datosBoletin['ano'],
        ];

        abort_unless(file_exists(public_path($boletin['pdf'])), 404);

        $pdfUrl = asset($boletin['pdf']);

        return view('pdf.viewer', compact('idioma', 'boletin', 'pdfUrl'));
    }

    /*---------- Enviar Contacto ----------*/
    public function enviarContacto(\App\Http\Requests\ContactoRequest $request)
    {
        if (!empty($request->input('website'))) {
            abort(400, 'Bot detectado (honeypot).');
        }

        $token = $request->input('g-recaptcha-response');
        if (empty($token)) {
            return redirect()->back()->withInput()->withErrors(['captcha' => 'Debes completar el captcha']);
        }

        $verificado = $this->verificarToken($token, '6LezXjArAAAAAFONZGhY728H82z4DzsQ5AEpMHoS');
        // $verificado = $this->verificarToken($token, '6Lenp2MtAAAAACeWrEPWWiW60aQNy5MToT68vjCR');

        if (!$verificado) {
            return redirect()->back()->withInput()->withErrors(['captcha' => 'No se pudo verificar el captcha, inténtalo de nuevo.']);
        }

        $data = $request->validated();
        unset($data['website']);

        // SEGURIDAD: el destinatario NUNCA se toma del valor enviado por el
        // usuario. Se resuelve la clave de área ("sistemas", etc.) contra
        // config/contacto.php, que centraliza todas las direcciones reales.
        $areaKey = $data['area'];
        $areaEmails = config("contacto.areas.$areaKey");
        $areaLabel = trans(config("contacto.area_labels.$areaKey", 'contacto.area_label'));

        if (empty($areaEmails)) {
            // Caso "Mantenimiento" / "Ventas Nacional": no hay correo real
            // configurado todavía (ver config/contacto.php). No fallamos en
            // silencio: se registra y se avisa amigablemente al usuario.
            Log::error('Intento de envío de contacto a un área sin correo configurado.', [
                'area' => $areaKey,
            ]);

            return redirect()->back()->withInput()->with('contacto_error', true);
        }

        $enviarA = array_map('trim', explode(',', $areaEmails));

        try {
            Mail::to($enviarA)->send(new \App\Mail\ContactoMail($data, $areaLabel));
        } catch (\Throwable $e) {
            Log::error('Error al enviar el formulario de contacto.', [
                'area' => $areaKey,
                'error' => $e->getMessage(),
            ]);

            return redirect()->back()->withInput()->with('contacto_error', true);
        }

        return redirect(route(App::currentLocale() . '.inicio') . '?send=1');
    }

    public function verificarToken($token, $claveSecreta)
    {
        $url = "https://www.google.com/recaptcha/api/siteverify";

        $datos = [
            "secret" => $claveSecreta,
            "response" => $token,
        ];

        $opciones = [
            "http" => [
                "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                "method" => "POST",
                "content" => http_build_query($datos),
            ],
        ];

        $contexto = stream_context_create($opciones);
        $resultado = file_get_contents($url, false, $contexto);

        if ($resultado === false) {
            return false;
        }

        $resultado = json_decode($resultado);
        return (bool) ($resultado->success ?? false);
    }
}
