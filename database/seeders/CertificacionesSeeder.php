<?php

namespace Database\Seeders;

use App\Models\Rancho;
use App\Models\TipoCertificacion;
use App\Models\Certificacion;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CertificacionesSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. Tipo: PrimusGFS ────────────────────────────────────────────────
        $primusGFS = TipoCertificacion::create([
            'nombre'      => 'PrimusGFS',
            'slug'        => 'primusgfs',
            'descripcion' => 'Estándar de inocuidad alimentaria para frutas y vegetales frescos. '
                           . 'Reconocido por el Global Food Safety Initiative (GFSI).',
            'logo_path'   => null,          // Subir manualmente desde el admin
            'color_hex'   => '#00833E',     // Verde oficial PrimusGFS
            'sitio_web'   => 'https://www.primusgfs.com',
            'activo'      => true,
            'orden'       => 1,
        ]);

        // ── Estructura lista para certificaciones futuras ─────────────────────
        // Descomentar cuando aplique; el resto del código no necesita cambios.
        //
        // TipoCertificacion::create([
        //     'nombre'    => 'GlobalG.A.P.',
        //     'slug'      => 'globalgap',
        //     'color_hex' => '#009A44',
        //     'sitio_web' => 'https://www.globalgap.org',
        //     'activo'    => true,
        //     'orden'     => 2,
        // ]);
        //
        // TipoCertificacion::create([
        //     'nombre'    => 'USDA Organic',
        //     'slug'      => 'usda-organic',
        //     'color_hex' => '#2E7D32',
        //     'sitio_web' => 'https://www.ams.usda.gov',
        //     'activo'    => true,
        //     'orden'     => 3,
        // ]);
        //
        // TipoCertificacion::create([
        //     'nombre'    => 'CCOF',
        //     'slug'      => 'ccof',
        //     'color_hex' => '#1565C0',
        //     'sitio_web' => 'https://www.ccof.org',
        //     'activo'    => true,
        //     'orden'     => 4,
        // ]);

        // ── 2. Ranchos de Mr. Lucky ───────────────────────────────────────────
        // ⚠ REEMPLAZAR con los nombres y ubicaciones reales de los ranchos
        //   certificados. Los PDFs se suben desde el panel admin.
        $ranchosDatos = [
            [
                'nombre'    => 'Rancho El Júpiter',
                'ubicacion' => 'Caborca, Sonora',
                'municipio' => 'Caborca',
                'orden'     => 1,
                'escenario' => 'vigente',       // Certificado vigente con margen amplio
            ],
            [
                'nombre'    => 'Rancho Las Palomas',
                'ubicacion' => 'Puerto Peñasco, Sonora',
                'municipio' => 'Puerto Peñasco',
                'orden'     => 2,
                'escenario' => 'vigente',
            ],
            [
                'nombre'    => 'Rancho El Nopal',
                'ubicacion' => 'Altar, Sonora',
                'municipio' => 'Altar',
                'orden'     => 3,
                'escenario' => 'vigente',
            ],
            [
                'nombre'    => 'Rancho San Ignacio',
                'ubicacion' => 'Pitiquito, Sonora',
                'municipio' => 'Pitiquito',
                'orden'     => 4,
                'escenario' => 'vigente',
            ],
            [
                'nombre'    => 'Rancho La Esperanza',
                'ubicacion' => 'Sonoyta, Sonora',
                'municipio' => 'Sonoyta',
                'orden'     => 5,
                'escenario' => 'proximo',       // Vigente pero próximo a vencer (badge naranja)
            ],
            [
                'nombre'    => 'Rancho El Coyote',
                'ubicacion' => 'Trincheras, Sonora',
                'municipio' => 'Trincheras',
                'orden'     => 6,
                'escenario' => 'vencido',       // Vencido (badge rojo, para pruebas visuales)
            ],
        ];

        foreach ($ranchosDatos as $datos) {
            $rancho = Rancho::create([
                'nombre'    => $datos['nombre'],
                'ubicacion' => $datos['ubicacion'],
                'municipio' => $datos['municipio'],
                'estado'    => 'Sonora',
                'pais'      => 'México',
                'activo'    => true,
                'orden'     => $datos['orden'],
            ]);

            // Calcular fechas según escenario de prueba
            switch ($datos['escenario']) {
                case 'vigente':
                    $emision     = Carbon::now()->subMonths(6);
                    $vencimiento = Carbon::now()->addMonths(6);
                    $estadoVal   = 'vigente';
                    break;

                case 'proximo':
                    // Vence en 15 días — dispara badge naranja animado
                    $emision     = Carbon::now()->subYear();
                    $vencimiento = Carbon::now()->addDays(15);
                    $estadoVal   = 'vigente';
                    break;

                case 'vencido':
                default:
                    $emision     = Carbon::now()->subYears(2);
                    $vencimiento = Carbon::now()->subMonths(2);
                    $estadoVal   = 'vencido';
                    break;
            }

            Certificacion::create([
                'rancho_id'             => $rancho->id,
                'tipo_certificacion_id' => $primusGFS->id,
                'numero_certificado'    => 'PGFS-' . strtoupper(substr(md5($rancho->nombre), 0, 8)),
                'fecha_emision'         => $emision,
                'fecha_vencimiento'     => $vencimiento,
                'organismo_auditor'     => 'Primus Labs',
                'estado'                => $estadoVal,
                'visible_publico'       => true,
                'pdf_path'              => null, // Subir PDFs reales desde el admin
            ]);
        }
    }
}
