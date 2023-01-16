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
        DB::statement('Create or replace view vw_licencia_x_profesor AS 
        select lxp.id
        , lxp.baja
        , lxp.id_licencia
        , lxp.fecha
        , lxp.legajo_prof
        , lxp.id_rol_prof
        , lic.nombre as nombre_licencia
        , pro.nombre as nombre_profesor
        , pro.apellido as apellido_profesor 
        , pro.baja as baja_pro
        , pro.es_profesor as es_profesor
        , rol.nombre as nombre_rol
        , rxp.sit_revista
        from licencias_x_profesor lxp 
        INNER JOIN licencias lic on lic.id = lxp.id_licencia 
        INNER JOIN profesores pro on pro.legajo = lxp.legajo_prof
        INNER JOIN roles_x_profesor rxp on rxp.id = lxp.id_rol_prof
        INNER JOIN roles rol on rxp.id_rol = rol.id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vw_licencia_x_profesor');
    }
};
