<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('slug');
            $table->string('imagen')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('nutricion')->nullable();
            $table->text('usos')->nullable();
            $table->text('conservacion')->nullable();
            $table->integer('orden')->default(99);
            $table->char('activo','1')->default('1');
            $table->integer('categoria_id')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
