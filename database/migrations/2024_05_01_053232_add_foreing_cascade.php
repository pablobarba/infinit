<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles_x_profesor', function (Blueprint $table) {
            // Modificar la restricción de clave externa para establecer eliminación y actualización en cascada
            $table->dropForeign(['legajo_prof']); // Eliminar la restricción existente si la hay
            $table->foreign('legajo_prof')
                  ->references('legajo')->on('profesores')
                  ->onDelete('cascade') // Agregar eliminación en cascada
                  ->onUpdate('cascade'); // Agregar actualización en cascada
        });
    }

};