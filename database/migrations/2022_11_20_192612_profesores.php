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
        Schema::create('profesores',function(Blueprint $table){
            $table->id();
            $table->boolean('baja');
            $table->timestamps(); //created_at updated_at
            $table->string('nombre',50);
            $table->string('apellido',50);
            $table->integer('legajo')->unique();
            $table->boolean('es_profesor');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profesores');
    }
};
