<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Pivot enriquecida: cada fila = una certificación de un rancho
     * para un tipo y período determinado. Mantiene historial completo.
     *
     * SEGURIDAD: Los PDFs se almacenan en disco 'private' (storage/app/private/certificados/).
     * Nunca son accesibles por URL directa — solo a través de CertificacionController@descargar.
     */
    public function up(): void
    {
        Schema::create('certificaciones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('rancho_id')
                  ->constrained('ranchos')
                  ->onDelete('cascade');

            $table->foreignId('tipo_certificacion_id')
                  ->constrained('tipos_certificacion')
                  ->onDelete('cascade');

            $table->string('numero_certificado', 100)->nullable();
            $table->date('fecha_emision');
            $table->date('fecha_vencimiento');

            // PDF en disco PRIVADO — nunca en public/
            $table->string('pdf_path', 255)->nullable()->comment('Path en storage/app/private/certificados/');
            $table->string('pdf_nombre_original', 255)->nullable();

            $table->string('organismo_auditor', 200)->nullable()->comment('Ej: Primus Labs, Bureau Veritas');

            $table->enum('estado', ['vigente', 'vencido', 'suspendido', 'en_proceso'])
                  ->default('vigente');

            $table->boolean('visible_publico')->default(true);
            $table->text('notas')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Índices compuestos para las queries más frecuentes del módulo
            $table->index(['tipo_certificacion_id', 'estado', 'visible_publico'], 'cert_tipo_estado_publico');
            $table->index(['rancho_id', 'tipo_certificacion_id'], 'cert_rancho_tipo');
            $table->index('fecha_vencimiento');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificaciones');
    }
};
