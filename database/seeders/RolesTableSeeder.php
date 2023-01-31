<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('roles')->delete();
        
        DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:06',
                'updated_at' => NULL,
                'nombre' => 'DIRECTORA',
                'codigo' => 'DIRECTORA',
            ),
            1 => 
            array (
                'id' => 2,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:06',
                'updated_at' => NULL,
                'nombre' => 'VICEDIRECTORA',
                'codigo' => 'VICEDIRECTORA',
            ),
            2 => 
            array (
                'id' => 3,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:06',
                'updated_at' => NULL,
                'nombre' => 'REGENTE',
                'codigo' => 'REGENTE',
            ),
            3 => 
            array (
                'id' => 4,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:06',
                'updated_at' => NULL,
                'nombre' => 'Prof. Hs. Cat.',
                'codigo' => 'PROFHSCAT',
            ),
            4 => 
            array (
                'id' => 5,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:06',
                'updated_at' => NULL,
                'nombre' => 'Preceptora',
                'codigo' => 'PRECEPTORA',
            ),
            5 => 
            array (
                'id' => 6,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:06',
                'updated_at' => NULL,
                'nombre' => 'Prof. Hs. Cat. 3 HS',
                'codigo' => 'PROFHSCAT3HS',
            ),
            6 => 
            array (
                'id' => 7,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:06',
                'updated_at' => NULL,
                'nombre' => 'Preceptor',
                'codigo' => 'PRECEPTOR',
            ),
            7 => 
            array (
                'id' => 8,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:06',
                'updated_at' => NULL,
                'nombre' => 'Prof. Hs. Cat. Voc',
                'codigo' => 'PROFHSCATVOC',
            ),
            8 => 
            array (
                'id' => 9,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:06',
                'updated_at' => NULL,
                'nombre' => 'SECRETARIA',
                'codigo' => 'SECRETARIA',
            ),
            9 => 
            array (
                'id' => 10,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:06',
                'updated_at' => NULL,
                'nombre' => 'SERV 40H S.',
                'codigo' => 'SERV40',
            ),
            10 => 
            array (
                'id' => 11,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:06',
                'updated_at' => NULL,
                'nombre' => 'SERV 48H S',
                'codigo' => 'SERV48',
            ),
            11 => 
            array (
                'id' => 12,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:06',
                'updated_at' => NULL,
                'nombre' => 'SERV. CLAS.II 40 HS.',
                'codigo' => 'SERVC240',
            ),
            12 => 
            array (
                'id' => 13,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:06',
                'updated_at' => NULL,
                'nombre' => 'SERV. CLAS.II 48 HS.',
                'codigo' => 'SERVC248',
            ),
        ));
        
        
    }
}