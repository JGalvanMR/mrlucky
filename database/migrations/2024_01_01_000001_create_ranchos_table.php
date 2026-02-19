<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla maestra de ranchos/unidades productivas de Mr. Lucky.
     * Diseñada para escalar: cualquier certificación futura (GlobalGAP, USDA Organic)
     * referencia esta tabla sin modificarla.
     */
    public function up(): void
    {
        Schema::create('ranchos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150)->comment('Nombre oficial del rancho');
            $table->string('slug', 160)->unique();
            $table->string('ubicacion', 200)->comment('Ej: Caborca, Sonora');
            $table->string('municipio', 100)->nullable();
            $table->string('estado', 100)->default('Sonora');
            $table->string('pais', 100)->default('México');
            $table->string('imagen', 255)->nullable()->comment('Path relativo en storage/public/ranchos/');
            $table->boolean('activo')->default(true);
            $table->unsignedSmallInteger('orden')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['activo', 'orden']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ranchos');
    }
};
