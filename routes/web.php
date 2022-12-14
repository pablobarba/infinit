<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\ReportController;
use App\Http\Livewire\Prueb;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class);

//profesorController
Route::controller(ProfesorController::class)->group(function(){
    Route::get('profesors', 'index') -> name('profesors.index');
    Route::get('profesors/create', 'create') -> name('profesors.create');
    Route::get('profesors/presents/{id_profesor}','presents') -> name('profesors.presents');
    Route::get('profesors/absents/{id_profesor}', 'absents') -> name('profesors.absents');
    
    Route::post('profesors/licFilterDate@filter','licFilterDate') -> name('profesors.licFilterDate');
    Route::post('profesors/licDelete@filter','licDelete') -> name('profesors.licDelete');
    Route::post('profesors/licCreate@filter','licCreate') -> name('profesors.licCreate');
    Route::get('profesors/licFilterDate@fetch_data', 'licFilterDate') -> name('profesors.licFilterDate');

    //Route::get('profesors/absents/{id_profesor}', 'absents') -> name('profesors.absents');
});
//profesorController

//reportController
Route::controller(ReportController::class)->group(function(){
    Route::get('report', 'index') -> name('report.index');
    Route::post('report/getRolByProfesor@filter','getRolByProfesor') -> name('report.getRolByProfesor');
    Route::post('report/createReport@filter','createReport') -> name('report.createReport');
});
//reportController