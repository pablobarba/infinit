<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class LicenciasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('licencias')->delete();
        
        DB::table('licencias')->insert(array (
            0 => 
            array (
                'id' => 1,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'art. 139',
                'codigo' => 'ART139',
            ),
            1 => 
            array (
                'id' => 2,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'ausente por ART',
                'codigo' => 'AUSART',
            ),
            2 => 
            array (
                'id' => 3,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'LAO',
                'codigo' => 'LAO',
            ),
            3 => 
            array (
                'id' => 4,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'ASUETO',
                'codigo' => 'ASUETO',
            ),
            4 => 
            array (
                'id' => 5,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => '125 ausente sin aviso',
                'codigo' => '125ASA',
            ),
            5 => 
            array (
                'id' => 6,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => '114  A 1- COVID 19',
                'codigo' => 'ACOVID19',
            ),
            6 => 
            array (
                'id' => 7,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'Vacunacion covid',
                'codigo' => 'VACCOVID',
            ),
            7 => 
            array (
                'id' => 8,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'SA ausente sin aviso',
                'codigo' => 'SAASA',
            ),
            8 => 
            array (
                'id' => 9,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => '114 G 1 donacion de sangre',
                'codigo' => 'DONSANGRE',
            ),
            9 => 
            array (
                'id' => 10,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'Art-114a-Enfermedad',
                'codigo' => 'ENF',
            ),
            10 => 
            array (
                'id' => 11,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'Art.1142.8-Enfermedad cronica',
                'codigo' => 'ENFCRO',
            ),
            11 => 
            array (
                'id' => 12,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'Art.114a2-Enfermedad extraord',
                'codigo' => 'ENFEXT',
            ),
            12 => 
            array (
                'id' => 13,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'Art.114c-Matrimonio',
                'codigo' => 'MATRIMONIO',
            ),
            13 => 
            array (
                'id' => 14,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'Art.114d- Maternidad',
                'codigo' => 'MATERNIDAD',
            ),
            14 => 
            array (
                'id' => 15,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => '114 G 1 donacion de sangre',
                'codigo' => '114GDONSANGRE',
            ),
            15 => 
            array (
                'id' => 16,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'Art.114f-Familiar enfermo',
                'codigo' => 'ENFFAM',
            ),
            16 => 
            array (
                'id' => 17,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'Art.114LL-Pre-Examen',
                'codigo' => 'PREEXAM',
            ),
            17 => 
            array (
                'id' => 18,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'Art.114LL-Pre-Examen',
                'codigo' => 'EXAMPRE',
            ),
            18 => 
            array (
                'id' => 19,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'Art.114 LL -examen',
                'codigo' => 'EXAM',
            ),
            19 => 
            array (
                'id' => 20,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => '114 LL  ll.1.4  por concurso mayor jerarquia',
                'codigo' => 'CONJER',
            ),
            20 => 
            array (
                'id' => 21,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => '114 J Duelo familiar',
                'codigo' => 'DUELOFAM',
            ),
            21 => 
            array (
                'id' => 22,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'Art.114 FER.',
                'codigo' => 'ART114FER',
            ),
            22 => 
            array (
                'id' => 23,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => '114 M cit. Autoridad competente',
                'codigo' => 'AUTCOM',
            ),
            23 => 
            array (
                'id' => 24,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => '114 D 1.10',
                'codigo' => '114110',
            ),
            24 => 
            array (
                'id' => 25,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => '115  INC A',
                'codigo' => '115INCA',
            ),
            25 => 
            array (
                'id' => 26,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => '114 Ñ, DONACION SANGRE',
                'codigo' => '114DONSANGRE',
            ),
            26 => 
            array (
                'id' => 27,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'C 38 duelo familiar',
                'codigo' => 'CDUELOFAM38',
            ),
            27 => 
            array (
                'id' => 28,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'Art. 115 B 3 gremial',
                'codigo' => 'ART115GREM',
            ),
            28 => 
            array (
                'id' => 29,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'Mayor Jerarquia',
                'codigo' => 'MAYJERAR',
            ),
            29 => 
            array (
                'id' => 30,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'Representante en junta',
                'codigo' => 'REPJUNTA',
            ),
            30 => 
            array (
                'id' => 31,
                'baja' => 0,
                'created_at' => '2023-01-28 00:00:00',
                'updated_at' => NULL,
                'nombre' => 'Paro',
                'codigo' => 'PARO',
            ),
        ));
        
        
    }
}