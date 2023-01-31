<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profesor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "profesores";
    /*protected function nombre():Attribute{
        return new Attribute(
            set: function($value){
                return strtolower($value);
            }   
        );
    }*/


}
