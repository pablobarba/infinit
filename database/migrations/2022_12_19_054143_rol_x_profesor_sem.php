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
        Schema::create('rol_x_profesor_sem',function(Blueprint $table){
            $table->id();
            $table->boolean('baja');
            $table->timestamps(); //created_at updated_at
    
            $table->unsignedBigInteger('id_rol_prof');
            $table->foreign('id_rol_prof')->references('id')->on('roles_x_profesor')->onDelete('cascade');
    
            $table->boolean('lunes');
            $table->boolean('martes');
            $table->boolean('miercoles');
            $table->boolean('jueves');
            $table->boolean('viernes');
            $table->boolean('sabado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rol_x_profesor_sem');
    }
};
