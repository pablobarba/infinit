<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProfesoresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('profesores')->delete();
        
        \DB::table('profesores')->insert(array (
            0 => 
            array (
                'id' => 1,
                'baja' => 0,
                'nombre' => 'Leandro',
                'apellido' => 'Acevedo',
                'legajo' => 340239182,
                'es_profesor' => 1,
                'created_at' => '2023-01-14 04:51:29',
                'updated_at' => '2023-01-14 04:51:29',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'baja' => 0,
                'nombre' => 'Pablo',
                'apellido' => 'Barba',
                'legajo' => 23924294,
                'es_profesor' => 1,
                'created_at' => '2023-01-14 04:53:12',
                'updated_at' => '2023-01-14 04:53:12',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}