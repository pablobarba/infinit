<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Licencias;
use Illuminate\Database\Seeder;
use App\Models\Profesor;
use App\Models\LicenciasXProfesor;
use App\Models\Roles;
use App\Models\RolesXProfesor;

use Carbon\Carbon;
use Termwind\Components\Raw;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       /* Profesor::factory(20)->create();
        
        $profesore = new Profesor();
        $profesore->nombre = "Pablo";
        $profesore->apellido = "Barba";
        $profesore->legajo = 36718500;
        $profesore->baja = 0;
        $profesore->es_profesor = 1;
        $profesore->save();

        $l = new Licencias();
        $l->id = 1;
        $l->baja = 0;
        $l->nombre = "Enfermedad";
        $l->codigo = "ENF";
        $l->save();
        $l2 = new Licencias();
        $l2->id = 2;
        $l2->baja = 0;
        $l2->nombre = "Falta";
        $l2->codigo = "FAL";
        $l2->save();

        $r = new Roles();
        $r->id = 1;
        $r->baja = 0;
        $r->nombre = "Rol 1";
        $r->codigo = "ROL1";
        $r->save();
        $r2 = new Roles();
        $r2->id = 2;
        $r2->baja = 0;
        $r2->nombre = "Rol 2";
        $r2->codigo = "ROL2";
        $r2->save();

        $rxp = new RolesXProfesor();
        $rxp->id_rol = 1;
        $rxp->legajo_prof = 36718500;
        $rxp->baja = 0;
        $rxp->sit_revista = "titular";
        $rxp->save();

        $rxp = new RolesXProfesor();
        $rxp->id_rol = 2;
        $rxp->legajo_prof = 36718500;
        $rxp->baja = 0;
        $rxp->sit_revista = "Provisional";
        $rxp->save();

        $lxp = new LicenciasXProfesor();
        $lxp->id_licencia = 1;
        $lxp->legajo_prof = 36718500;
        $lxp -> id_rol_prof = 1;
        $lxp->fecha = Carbon::createFromDate(2022,07,22)->toDateTimeString();
        $lxp->baja = 0;
        
        $lxp->save();

        $lxp2 = new LicenciasXProfesor();
        $lxp->id_licencia = 2;
        $lxp2->legajo_prof = 36718500;
        $lxp -> id_rol_prof = 2;
        $lxp2->fecha = Carbon::createFromDate(2022,07,23)->toDateTimeString();
        $lxp2->baja = 0;
        $lxp2->save();*/
        $this->call(ProfesoresTableSeeder::class);
        $this->call(LicenciasTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(LicenciasXProfesorTableSeeder::class);
        $this->call(RolesXProfesorTableSeeder::class);
        $this->call(RolXProfesorSemTableSeeder::class);
    }
}
