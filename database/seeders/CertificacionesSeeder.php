<?php

namespace Database\Seeders;

use App\Models\Rancho;
use App\Models\TipoCertificacion;
use App\Models\Certificaciones;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CertificacionesSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. Tipo: PrimusGFS (Usamos updateOrCreate para evitar el error de Slug) ──
        $primusGFS = TipoCertificacion::updateOrCreate(
            ['slug' => 'primusgfs'], // Condición de búsqueda
            [
                'nombre'      => 'PrimusGFS',
                'descripcion' => 'Estándar de inocuidad alimentaria para frutas y vegetales frescos. Reconocido por el Global Food Safety Initiative (GFSI).',
                'logo_path'   => null,
                'color_hex'   => '#00833E',
                'sitio_web'   => 'https://www.primusgfs.com',
                'activo'      => true,
                'orden'       => 1,
            ]
        );

        // ── 2. Ranchos de Mr. Lucky ───────────────────────────────────────────
        $ranchosDatos = [
            ['nombre' => 'Rancho El Júpiter', 'ubicacion' => 'Caborca, Sonora', 'municipio' => 'Caborca', 'orden' => 1, 'escenario' => 'vigente'],
            ['nombre' => 'Rancho Las Palomas', 'ubicacion' => 'Puerto Peñasco, Sonora', 'municipio' => 'Puerto Peñasco', 'orden' => 2, 'escenario' => 'vigente'],
            ['nombre' => 'Rancho El Nopal', 'ubicacion' => 'Altar, Sonora', 'municipio' => 'Altar', 'orden' => 3, 'escenario' => 'vigente'],
            ['nombre' => 'Rancho San Ignacio', 'ubicacion' => 'Pitiquito, Sonora', 'municipio' => 'Pitiquito', 'orden' => 4, 'escenario' => 'vigente'],
            ['nombre' => 'Rancho La Esperanza', 'ubicacion' => 'Sonoyta, Sonora', 'municipio' => 'Sonoyta', 'orden' => 5, 'escenario' => 'proximo'],
            ['nombre' => 'Rancho El Coyote', 'ubicacion' => 'Trincheras, Sonora', 'municipio' => 'Trincheras', 'orden' => 6, 'escenario' => 'vencido'],
        ];

        foreach ($ranchosDatos as $datos) {
            // Usamos updateOrCreate para no duplicar ranchos si corres el seeder de nuevo
            $rancho = Rancho::updateOrCreate(
                ['nombre' => $datos['nombre']], // Si el nombre ya existe, lo actualiza
                [
                    'ubicacion' => $datos['ubicacion'],
                    'municipio' => $datos['municipio'],
                    'estado'    => 'Sonora',
                    'pais'      => 'México',
                    'activo'    => true,
                    'orden'     => $datos['orden'],
                ]
            );

            // Calcular fechas según escenario
            switch ($datos['escenario']) {
                case 'vigente':
                    $emision = Carbon::now()->subMonths(6);
                    $vencimiento = Carbon::now()->addMonths(6);
                    $estadoVal = 'vigente';
                    break;
                case 'proximo':
                    $emision = Carbon::now()->subYear();
                    $vencimiento = Carbon::now()->addDays(15);
                    $estadoVal = 'vigente';
                    break;
                case 'vencido':
                default:
                    $emision = Carbon::now()->subYears(2);
                    $vencimiento = Carbon::now()->subMonths(2);
                    $estadoVal = 'vencido';
                    break;
            }

            // Para las certificaciones, buscamos por la combinación de rancho y tipo
            Certificaciones::updateOrCreate(
                [
                    'rancho_id' => $rancho->id,
                    'tipo_certificacion_id' => $primusGFS->id
                ],
                [
                    'numero_certificado' => 'PGFS-' . strtoupper(substr(md5($rancho->nombre), 0, 8)),
                    'fecha_emision'      => $emision,
                    'fecha_vencimiento'  => $vencimiento,
                    'organismo_auditor'  => 'Primus Labs',
                    'estado'             => $estadoVal,
                    'visible_publico'    => true,
                    'pdf_path'           => null,
                ]
            );
        }
    }
}
