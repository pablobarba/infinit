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
        Schema::create('licencias_x_profesor',function(Blueprint $table){
            $table->id();
            $table->boolean('baja');
            $table->timestamps(); //created_at updated_at

            $table->unsignedBigInteger('id_licencia');
            $table->foreign('id_licencia')->references('id')->on('licencias')->onDelete('cascade');

            $table->date('fecha');
            $table->integer('legajo_prof');
            
            $table->foreign('legajo_prof')->references('legajo')->on('profesores')->onDelete('cascade');

            $table->unsignedBigInteger('id_rol_prof');
            $table->foreign('id_rol_prof')->references('id')->on('roles_x_profesor')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licencias_x_profesor');
    }
};
