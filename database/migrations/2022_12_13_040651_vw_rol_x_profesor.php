<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('Create view vw_rol_x_profesor AS 
        select rxp.id
        , rxp.baja
        , rxp.legajo_prof
        , pro.nombre as nombre_profesor
        , pro.apellido as apellido_profesor 
        , rol.nombre as nombre_rol
        , rxp.sit_revista
        from roles_x_profesor rxp 
        INNER JOIN profesores pro on pro.legajo = rxp.legajo_prof
        INNER JOIN roles rol on rxp.id_rol = rol.id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vw_rol_x_profesor');
    }
};
