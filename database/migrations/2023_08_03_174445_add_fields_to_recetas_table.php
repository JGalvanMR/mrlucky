<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToRecetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recetas', function (Blueprint $table) {
            $table->integer('tiempo')->unsigned()->nullable()->change();
            $table->dropColumn('fecha');
            $table->text('ingredientes')->nullable()->before('contenido');
            $table->integer('coccion')->after('tiempo')->nullable()->unsigned();
            $table->string('porciones')->after('coccion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recetas', function (Blueprint $table) {
            $table->string('tiempo')->nullable()->change();
            $table->date('fecha')->nullable();
            $table->dropColumn('ingredientes');
            $table->dropColumn('coccion');
            $table->dropColumn('porciones');
        });
    }
}
