<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProfesoresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('profesores')->delete();
        
        DB::table('profesores')->insert(array (
            0 => 
            array (
                'id' => 1,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:32',
                'updated_at' => NULL,
                'nombre' => 'DEBORA NOEMI',
                'apellido' => 'ZASINOVICH',
                'legajo' => 8394918,
                'es_profesor' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:32',
                'updated_at' => NULL,
                'nombre' => 'SANDRA ROXANA',
                'apellido' => 'LANGLEBEN',
                'legajo' => 14955900,
                'es_profesor' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:32',
                'updated_at' => NULL,
                'nombre' => 'MÓNICA',
                'apellido' => 'VARRICA',
                'legajo' => 145938,
                'es_profesor' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:32',
                'updated_at' => NULL,
                'nombre' => 'MONICA BEATRIZ',
                'apellido' => 'GOMEZ',
                'legajo' => 14542518,
                'es_profesor' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:32',
                'updated_at' => NULL,
                'nombre' => 'GABRIELA CARLOTA',
                'apellido' => 'ARUFE',
                'legajo' => 17354500,
                'es_profesor' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:32',
                'updated_at' => NULL,
                'nombre' => 'NELSON',
                'apellido' => 'ASTORGA',
                'legajo' => 23143400,
                'es_profesor' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:32',
                'updated_at' => NULL,
                'nombre' => 'LORENA NATALIA',
                'apellido' => 'BATISTA',
                'legajo' => 19377800,
                'es_profesor' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:32',
                'updated_at' => NULL,
                'nombre' => 'JOHANNA ELIZABETH',
                'apellido' => 'BAEZ',
                'legajo' => 25838900,
                'es_profesor' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:32',
                'updated_at' => NULL,
                'nombre' => 'ALDANA',
                'apellido' => 'BELLO',
                'legajo' => 23972300,
                'es_profesor' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:32',
                'updated_at' => NULL,
                'nombre' => 'SABRINA',
                'apellido' => 'BLEBEL',
                'legajo' => 18661200,
                'es_profesor' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'ADRIANA ISABEL',
                'apellido' => 'BOTTOSO',
                'legajo' => 17868918,
                'es_profesor' => 1,
            ),
            11 => 
            array (
                'id' => 12,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'VERONICA ANDREA',
                'apellido' => 'CADICAMO',
                'legajo' => 19887800,
                'es_profesor' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'CARLA PAOLA',
                'apellido' => 'CAPROTTA',
                'legajo' => 182534,
                'es_profesor' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MARCELA INDIANA',
                'apellido' => 'CARRERO',
                'legajo' => 186401,
                'es_profesor' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MARCELO FABIO',
                'apellido' => 'CARTE',
                'legajo' => 18165600,
                'es_profesor' => 1,
            ),
            15 => 
            array (
                'id' => 16,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'VALERIA',
                'apellido' => 'COLLADO LAZO',
                'legajo' => 10807600,
                'es_profesor' => 1,
            ),
            16 => 
            array (
                'id' => 17,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'PABLO HERNAN',
                'apellido' => 'D´AQUINO',
                'legajo' => 20808900,
                'es_profesor' => 1,
            ),
            17 => 
            array (
                'id' => 18,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MARIANA',
                'apellido' => 'ECHEVERRÍA',
                'legajo' => 20212300,
                'es_profesor' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'GISELLA',
                'apellido' => 'FAVAROLO',
                'legajo' => 247623,
                'es_profesor' => 1,
            ),
            19 => 
            array (
                'id' => 20,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'LAURA',
                'apellido' => 'FERREYRA',
                'legajo' => 17066700,
                'es_profesor' => 1,
            ),
            20 => 
            array (
                'id' => 21,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'LAURA',
                'apellido' => 'FEIJOO',
                'legajo' => 186412,
                'es_profesor' => 1,
            ),
            21 => 
            array (
                'id' => 22,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'LAURA INES',
                'apellido' => 'FONT',
                'legajo' => 8338619,
                'es_profesor' => 1,
            ),
            22 => 
            array (
                'id' => 23,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MARINA ANDREA',
                'apellido' => 'FRANCISCO',
                'legajo' => 20868900,
                'es_profesor' => 1,
            ),
            23 => 
            array (
                'id' => 24,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'HORACIO',
                'apellido' => 'GALVAN',
                'legajo' => 187934,
                'es_profesor' => 1,
            ),
            24 => 
            array (
                'id' => 25,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'ELIAS',
                'apellido' => 'GOLDZYCHER',
                'legajo' => 68833,
                'es_profesor' => 1,
            ),
            25 => 
            array (
                'id' => 26,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'ROXANA',
                'apellido' => 'HRUBY',
                'legajo' => 22060100,
                'es_profesor' => 1,
            ),
            26 => 
            array (
                'id' => 27,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'YOLANDA NANCY',
                'apellido' => 'JIMENEZ',
                'legajo' => 113178700,
                'es_profesor' => 1,
            ),
            27 => 
            array (
                'id' => 28,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'DORA LORENA',
                'apellido' => 'KASE RAMIREZ',
                'legajo' => 17740100,
                'es_profesor' => 1,
            ),
            28 => 
            array (
                'id' => 29,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MARINA',
                'apellido' => 'LAREU',
                'legajo' => 178267,
                'es_profesor' => 1,
            ),
            29 => 
            array (
                'id' => 30,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MARIA FERNANDA',
                'apellido' => 'LENCINA',
                'legajo' => 18897818,
                'es_profesor' => 1,
            ),
            30 => 
            array (
                'id' => 31,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MARIA SOLEDAD',
                'apellido' => 'MADREGAL',
                'legajo' => 26682300,
                'es_profesor' => 1,
            ),
            31 => 
            array (
                'id' => 32,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MARIELA NOEMI',
                'apellido' => 'MAGENTA',
                'legajo' => 20769000,
                'es_profesor' => 1,
            ),
            32 => 
            array (
                'id' => 33,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'LUIS GONZALO',
                'apellido' => 'MELICCHIO',
                'legajo' => 203567,
                'es_profesor' => 1,
            ),
            33 => 
            array (
                'id' => 34,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'ROBERTO L.',
                'apellido' => 'MITTELMEIR',
                'legajo' => 3542800,
                'es_profesor' => 1,
            ),
            34 => 
            array (
                'id' => 35,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MARCELA',
                'apellido' => 'MONACO',
                'legajo' => 24195619,
                'es_profesor' => 1,
            ),
            35 => 
            array (
                'id' => 36,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MARIA GUADALUPE',
                'apellido' => 'NEYRA',
                'legajo' => 8397200,
                'es_profesor' => 1,
            ),
            36 => 
            array (
                'id' => 37,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'SARA CONCE',
                'apellido' => 'OVELAR LOPEZ',
                'legajo' => 145037,
                'es_profesor' => 1,
            ),
            37 => 
            array (
                'id' => 38,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'ANDREA',
                'apellido' => 'RODRIGUEZ',
                'legajo' => 145920,
                'es_profesor' => 1,
            ),
            38 => 
            array (
                'id' => 39,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'ADRIANA INES',
                'apellido' => 'RUIZ',
                'legajo' => 174345,
                'es_profesor' => 1,
            ),
            39 => 
            array (
                'id' => 40,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'DIANA',
                'apellido' => 'SÁ',
                'legajo' => 235434,
                'es_profesor' => 1,
            ),
            40 => 
            array (
                'id' => 41,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'ELIZABET',
                'apellido' => 'SIEGHART',
                'legajo' => 18667818,
                'es_profesor' => 1,
            ),
            41 => 
            array (
                'id' => 42,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MARIANA',
                'apellido' => 'SIGNORELLI',
                'legajo' => 24577800,
                'es_profesor' => 1,
            ),
            42 => 
            array (
                'id' => 43,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MA. Fernanda',
                'apellido' => 'VILLAVERDE MARTIN',
                'legajo' => 16487818,
                'es_profesor' => 1,
            ),
            43 => 
            array (
                'id' => 44,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'ASTRID',
                'apellido' => 'COCO',
                'legajo' => 25934500,
                'es_profesor' => 1,
            ),
            44 => 
            array (
                'id' => 45,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'JUAN MANUEL',
                'apellido' => 'TORRES',
                'legajo' => 24958900,
                'es_profesor' => 1,
            ),
            45 => 
            array (
                'id' => 46,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'Cynthia',
                'apellido' => 'LANIERI',
                'legajo' => 25443400,
                'es_profesor' => 1,
            ),
            46 => 
            array (
                'id' => 47,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'VANINA',
                'apellido' => 'VISCOVICH',
                'legajo' => 26681200,
                'es_profesor' => 1,
            ),
            47 => 
            array (
                'id' => 48,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'CARLOS',
                'apellido' => 'BRANDAN',
                'legajo' => 27815600,
                'es_profesor' => 1,
            ),
            48 => 
            array (
                'id' => 49,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'HORACIO',
                'apellido' => 'SOARES DIQUECH',
                'legajo' => 24186718,
                'es_profesor' => 1,
            ),
            49 => 
            array (
                'id' => 50,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MARIA CRISTINA',
                'apellido' => 'VAL',
                'legajo' => 24305600,
                'es_profesor' => 1,
            ),
            50 => 
            array (
                'id' => 51,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MARCELO',
                'apellido' => 'TOTARO',
                'legajo' => 27816700,
                'es_profesor' => 1,
            ),
            51 => 
            array (
                'id' => 52,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MARTA',
                'apellido' => 'MOLINA',
                'legajo' => 27208900,
                'es_profesor' => 1,
            ),
            52 => 
            array (
                'id' => 53,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'LUCIANA',
                'apellido' => 'GARCIA LARENAS',
                'legajo' => 27786718,
                'es_profesor' => 1,
            ),
            53 => 
            array (
                'id' => 54,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'NOEMI',
                'apellido' => 'KORIN',
                'legajo' => 20814500,
                'es_profesor' => 1,
            ),
            54 => 
            array (
                'id' => 55,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'CLAUDIA',
                'apellido' => 'SUSSER',
                'legajo' => 21442300,
                'es_profesor' => 1,
            ),
            55 => 
            array (
                'id' => 56,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MARIO',
                'apellido' => 'FAVIER DUBOIS',
                'legajo' => 18259000,
                'es_profesor' => 1,
            ),
            56 => 
            array (
                'id' => 57,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'CECILIA',
                'apellido' => 'PECCIA',
                'legajo' => 27735600,
                'es_profesor' => 1,
            ),
            57 => 
            array (
                'id' => 58,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'JORGE',
                'apellido' => 'GABUSI',
                'legajo' => 28661200,
                'es_profesor' => 1,
            ),
            58 => 
            array (
                'id' => 59,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MIRTA SOLEDAD',
                'apellido' => 'BECCAR',
                'legajo' => 257801,
                'es_profesor' => 1,
            ),
            59 => 
            array (
                'id' => 60,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'NATALIA',
                'apellido' => 'VAISTIJ',
                'legajo' => 29142300,
                'es_profesor' => 1,
            ),
            60 => 
            array (
                'id' => 61,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'HORACIO',
                'apellido' => 'DI MAURO',
                'legajo' => 28727800,
                'es_profesor' => 1,
            ),
            61 => 
            array (
                'id' => 62,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'LUANA',
                'apellido' => 'CONSORTI',
                'legajo' => 28619000,
                'es_profesor' => 1,
            ),
            62 => 
            array (
                'id' => 63,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MARCELA',
                'apellido' => 'CAIROLI',
                'legajo' => 26683400,
                'es_profesor' => 1,
            ),
            63 => 
            array (
                'id' => 64,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'GRACIELA',
                'apellido' => 'LIZARDO',
                'legajo' => 17262300,
                'es_profesor' => 1,
            ),
            64 => 
            array (
                'id' => 65,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MARIANA',
                'apellido' => 'TSIFTSIS',
                'legajo' => 23508143,
                'es_profesor' => 1,
            ),
            65 => 
            array (
                'id' => 66,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'FLORENCIA',
                'apellido' => 'BONET XICOY',
                'legajo' => 30641400,
                'es_profesor' => 1,
            ),
            66 => 
            array (
                'id' => 67,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'FACUNDO',
                'apellido' => 'PARDO',
                'legajo' => 26021200,
                'es_profesor' => 1,
            ),
            67 => 
            array (
                'id' => 68,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'SANTIAGO',
                'apellido' => 'LAGUNAS',
                'legajo' => 29438900,
                'es_profesor' => 1,
            ),
            68 => 
            array (
                'id' => 69,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'DIEGO',
                'apellido' => 'RANIERI',
                'legajo' => 21608900,
                'es_profesor' => 1,
            ),
            69 => 
            array (
                'id' => 70,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'CRISTIAN',
                'apellido' => 'HERRERA',
                'legajo' => 25590100,
                'es_profesor' => 1,
            ),
            70 => 
            array (
                'id' => 71,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'LEOPOLDO',
                'apellido' => 'PALLAROLI',
                'legajo' => 28725600,
                'es_profesor' => 1,
            ),
            71 => 
            array (
                'id' => 72,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'LEANDRO',
                'apellido' => 'NEGRI',
                'legajo' => 23043400,
                'es_profesor' => 1,
            ),
            72 => 
            array (
                'id' => 73,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'VALERIA',
                'apellido' => 'ALVAREZ',
                'legajo' => 193212,
                'es_profesor' => 1,
            ),
            73 => 
            array (
                'id' => 74,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'CINTIA ROMINA',
                'apellido' => 'TINTORERO',
                'legajo' => 25767800,
                'es_profesor' => 1,
            ),
            74 => 
            array (
                'id' => 75,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'CARINA',
                'apellido' => 'TAPIA',
                'legajo' => 156401,
                'es_profesor' => 1,
            ),
            75 => 
            array (
                'id' => 76,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MAURO JAVIER',
                'apellido' => 'LONTRATO',
                'legajo' => 30755500,
                'es_profesor' => 1,
            ),
            76 => 
            array (
                'id' => 77,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MARIANELA',
                'apellido' => 'COLOMBO',
                'legajo' => 25440100,
                'es_profesor' => 1,
            ),
            77 => 
            array (
                'id' => 78,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'LUCIANA',
                'apellido' => 'BONET XICOY',
                'legajo' => 30761100,
                'es_profesor' => 1,
            ),
            78 => 
            array (
                'id' => 79,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'DANIELA',
                'apellido' => 'PIZZI',
                'legajo' => 20770118,
                'es_profesor' => 1,
            ),
            79 => 
            array (
                'id' => 80,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'CAMILA',
                'apellido' => 'ARIAS NIGRO',
                'legajo' => 27925600,
                'es_profesor' => 1,
            ),
            80 => 
            array (
                'id' => 81,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MARIA',
                'apellido' => 'CAMELLI',
                'legajo' => 26051218,
                'es_profesor' => 1,
            ),
            81 => 
            array (
                'id' => 82,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'MARIA JOSE',
                'apellido' => 'BENITEZ COLL',
                'legajo' => 307484000,
                'es_profesor' => 1,
            ),
            82 => 
            array (
                'id' => 83,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'FLORENCIA',
                'apellido' => 'BELTRAMO',
                'legajo' => 30767400,
                'es_profesor' => 1,
            ),
            83 => 
            array (
                'id' => 84,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'SANDRA',
                'apellido' => 'AMAYA',
                'legajo' => 30775100,
                'es_profesor' => 1,
            ),
            84 => 
            array (
                'id' => 85,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'AGUSTINA',
                'apellido' => 'DOTTO',
                'legajo' => 25473400,
                'es_profesor' => 1,
            ),
            85 => 
            array (
                'id' => 86,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'LORENA',
                'apellido' => 'GOMEZ',
                'legajo' => 155990,
                'es_profesor' => 1,
            ),
            86 => 
            array (
                'id' => 87,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'ROMINA',
                'apellido' => 'ROMERO',
                'legajo' => 24831200,
                'es_profesor' => 1,
            ),
            87 => 
            array (
                'id' => 88,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'BELEN',
                'apellido' => 'FERREYRA',
                'legajo' => 30775000,
                'es_profesor' => 1,
            ),
            88 => 
            array (
                'id' => 89,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:33',
                'updated_at' => NULL,
                'nombre' => 'TATIANA',
                'apellido' => 'GABUSI',
                'legajo' => 27776700,
                'es_profesor' => 1,
            ),
            89 => 
            array (
                'id' => 90,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:44',
                'updated_at' => NULL,
                'nombre' => 'GRACIELA E.',
                'apellido' => 'MUSIMESSI',
                'legajo' => 1518900,
                'es_profesor' => 0,
            ),
            90 => 
            array (
                'id' => 91,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:44',
                'updated_at' => NULL,
                'nombre' => 'WALTER',
                'apellido' => 'VIGNA',
                'legajo' => 190238,
                'es_profesor' => 0,
            ),
            91 => 
            array (
                'id' => 92,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:44',
                'updated_at' => NULL,
                'nombre' => 'ALCIDES',
                'apellido' => 'LOPEZ GAONA',
                'legajo' => 25817800,
                'es_profesor' => 0,
            ),
            92 => 
            array (
                'id' => 93,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:44',
                'updated_at' => NULL,
                'nombre' => 'MARCELA ALEJANDRA',
                'apellido' => 'FRANCO',
                'legajo' => 17106700,
                'es_profesor' => 0,
            ),
            93 => 
            array (
                'id' => 94,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:44',
                'updated_at' => NULL,
                'nombre' => 'VIVIANA',
                'apellido' => 'VANDAMME',
                'legajo' => 283589,
                'es_profesor' => 0,
            ),
            94 => 
            array (
                'id' => 95,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:44',
                'updated_at' => NULL,
                'nombre' => 'MARIA',
                'apellido' => 'HERRERA',
                'legajo' => 236845,
                'es_profesor' => 0,
            ),
            95 => 
            array (
                'id' => 96,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:44',
                'updated_at' => NULL,
                'nombre' => 'PATRICIA',
                'apellido' => 'VEGA',
                'legajo' => 231356,
                'es_profesor' => 0,
            ),
            96 => 
            array (
                'id' => 97,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:44',
                'updated_at' => NULL,
                'nombre' => 'MARCELO',
                'apellido' => 'RODRIGUEZ',
                'legajo' => 6881700,
                'es_profesor' => 0,
            ),
            97 => 
            array (
                'id' => 98,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:44',
                'updated_at' => NULL,
                'nombre' => 'MARIA FILOMENA',
                'apellido' => 'MARTINEZ',
                'legajo' => 15190100,
                'es_profesor' => 0,
            ),
            98 => 
            array (
                'id' => 99,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:44',
                'updated_at' => NULL,
                'nombre' => 'MARIELA',
                'apellido' => 'GOMEZ',
                'legajo' => 250634,
                'es_profesor' => 0,
            ),
            99 => 
            array (
                'id' => 100,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:44',
                'updated_at' => NULL,
                'nombre' => 'CLAUDIA',
                'apellido' => 'SUAREZ',
                'legajo' => 20314500,
                'es_profesor' => 0,
            ),
            100 => 
            array (
                'id' => 101,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:44',
                'updated_at' => NULL,
                'nombre' => 'ELIANA',
                'apellido' => 'ALCARAZ',
                'legajo' => 307363,
                'es_profesor' => 0,
            ),
            101 => 
            array (
                'id' => 102,
                'baja' => 0,
                'created_at' => '2023-01-28 03:33:44',
                'updated_at' => NULL,
                'nombre' => 'GUADALUPE AYELEN',
                'apellido' => 'ZEQUEIRA',
                'legajo' => 307504,
                'es_profesor' => 0,
            ),
        ));
        
        
    }
}