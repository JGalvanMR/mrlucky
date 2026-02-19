<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Catálogo de organismos certificadores.
     *
     * ESCALABILIDAD CLAVE: Agregar GlobalGAP, USDA Organic, Kosher, SMETA
     * solo requiere insertar una fila aquí. Cero cambios en código.
     */
    public function up(): void
    {
        Schema::create('tipos_certificacion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);            // "PrimusGFS"
            $table->string('slug', 120)->unique();    // "primusgfs"
            $table->string('descripcion', 500)->nullable();
            $table->string('logo_path', 255)->nullable()->comment('Path en storage/public/certificaciones/logos/');
            $table->string('color_hex', 7)->default('#00833E')->comment('Color de marca del certificador');
            $table->string('sitio_web', 255)->nullable();
            $table->boolean('activo')->default(true);
            $table->unsignedSmallInteger('orden')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipos_certificacion');
    }
};
