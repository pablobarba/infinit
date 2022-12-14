<?php

namespace Database\Factories;
use App\Models\Profesor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profesor>
 */
class ProfesorFactory extends Factory
{
    protected $model = Profesor::class;

    public function definition()
    {
        return ['nombre' => $this->faker -> text($maxNbChars = 20),
        'apellido' => $this->faker -> text($maxNbChars = 20),
        'baja'=> 0 ,
        'legajo'=> $this->faker ->randomNumber(5, false),
        'es_profesor'=>1
            //
        ];
    }
}
