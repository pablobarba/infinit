<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LicenciasXProfesor extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "licencias_x_profesor";
}
