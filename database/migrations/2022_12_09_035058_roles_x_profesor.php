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
        Schema::create('roles_x_profesor',function(Blueprint $table){
        $table->id();
        $table->boolean('baja');
        $table->timestamps(); //created_at updated_at

        $table->unsignedBigInteger('id_rol');
        $table->foreign('id_rol')->references('id')->on('roles')->onDelete('cascade');

        $table->date('fecha_fin')->nullable();
        $table->integer('legajo_prof');

        $table->foreign('legajo_prof')->references('legajo')->on('profesores')->onDelete('cascade');  
        $table->string('sit_revista',100);
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_x_profesor');
    }
};
