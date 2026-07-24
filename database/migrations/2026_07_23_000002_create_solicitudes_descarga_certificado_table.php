<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Registro de solicitudes de descarga de certificados (punto 13 y 27 del
 * requerimiento). Cada intento (exitoso o fallido en el envío del correo)
 * queda registrado para auditoría y seguimiento por el área responsable.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solicitudes_descarga_certificado', function (Blueprint $table) {
            $table->id();

            $table->foreignId('certificacion_id')
                  ->constrained('certificaciones')
                  ->onDelete('cascade');

            $table->string('nombre', 150);
            $table->string('puesto', 150);
            $table->string('empresa', 150);
            $table->string('correo', 150);
            $table->string('telefono', 30);
            $table->string('contacto_gab', 150);
            $table->text('uso');

            $table->string('ip_origen', 45)->nullable()->comment('Solo si la política de privacidad lo permite');

            $table->enum('estado_envio', ['enviado', 'error'])->default('enviado');
            $table->text('error_detalle')->nullable();

            $table->timestamps();

            $table->index(['certificacion_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitudes_descarga_certificado');
    }
};
