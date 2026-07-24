<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Requerimiento de Gerencia: renombrar el menú "COMPROMISO" / "COMMITMENT"
 * a "CALIDAD" / "QUALITY".
 *
 * Las etiquetas del menú NO viven en resources/lang/*.php: el proyecto usa
 * spatie/laravel-translation-loader (config/translation-loader.php), que
 * lee las traducciones desde la tabla `language_lines`. Por eso el cambio
 * de texto se hace aquí, con datos, y no editando un archivo de idioma.
 *
 * Se reutiliza la misma key ('web' / 'menu_compromiso_text') que ya usa
 * resources/views/site/partials/header.blade.php tanto para el título del
 * dropdown como para el primer ítem del submenú. Así no hace falta tocar
 * las vistas ni las rutas: el submenú CALIDAD > Calidad / Certificaciones
 * ya existe estructuralmente en el header, solo cambia el texto.
 */
return new class extends Migration
{
    private string $group = 'web';
    private string $key = 'menu_compromiso_text';

    private array $nuevoTexto = [
        'es' => 'Calidad',
        'en' => 'Quality',
    ];

    private array $textoAnterior = [
        'es' => 'Compromiso',
        'en' => 'Commitment',
    ];

    public function up(): void
    {
        $existe = DB::table('language_lines')
            ->where('group', $this->group)
            ->where('key', $this->key)
            ->first();

        if ($existe) {
            DB::table('language_lines')
                ->where('group', $this->group)
                ->where('key', $this->key)
                ->update([
                    'text' => json_encode($this->nuevoTexto, JSON_UNESCAPED_UNICODE),
                    'updated_at' => now(),
                ]);
        } else {
            // Si la línea aún no existe en la tabla (p. ej. entorno nuevo),
            // se crea directamente con el texto ya corregido.
            DB::table('language_lines')->insert([
                'group' => $this->group,
                'key' => $this->key,
                'text' => json_encode($this->nuevoTexto, JSON_UNESCAPED_UNICODE),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('language_lines')
            ->where('group', $this->group)
            ->where('key', $this->key)
            ->update([
                'text' => json_encode($this->textoAnterior, JSON_UNESCAPED_UNICODE),
                'updated_at' => now(),
            ]);
    }
};
