<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\LicenciasController;
use App\Http\Livewire\Prueb;
use App\Http\Controllers\LicenciasGralController;

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
    Route::post('profesors/save@filter','save') -> name('profesors.save');
    Route::post('profesors/delete@filter','delete') -> name('profesors.delete');
    Route::post('profesors/filterProfesors@filter','filterProfesors') -> name('profesors.filterProfesors');
    Route::get('profesors/filterProfesors@filter','filterProfesors') -> name('profesors.filterProfesors');
    
    Route::post('profesors/licFilterDate@filter','licFilterDate') -> name('profesors.licFilterDate');
    Route::post('profesors/licDelete@filter','licDelete') -> name('profesors.licDelete');
    Route::post('profesors/licCreate@filter','licCreate') -> name('profesors.licCreate');
    Route::get('profesors/licFilterDate@fetch_data', 'licFilterDate') -> name('profesors.licFilterDate');

    Route::get('profesors/roles/{id_profesor}', 'roles') -> name('profesors.roles');
    Route::post('profesors/rolDelete@data','rolDelete') -> name('profesors.rolDelete');
    Route::post('profesors/rolCreate@filter','rolCreate') -> name('profesors.rolCreate');
    Route::post('profesors/rolSemDays@filter','rolSemDays') -> name('profesors.rolSemDays');
    Route::post('profesors/rolSaveSemDays@filter','rolSaveSemDays') -> name('profesors.rolSaveSemDays');
    Route::post('profesors/getRolProfSemDay@filter','getRolProfSemDay') -> name('profesors.getRolProfSemDay');
});
//profesorController

//reportController
Route::controller(ReportController::class)->group(function(){
    Route::get('report', 'index') -> name('report.index');
    Route::post('report/getRolByProfesor@filter','getRolByProfesor') -> name('report.getRolByProfesor');
    Route::post('report/saveLicences@filter','saveLicences') -> name('report.saveLicences');
    Route::get('report/genreport','genreport') -> name('report.genreport');
    Route::post('report/getreport@filter','getreport') -> name('report.getreport');
    Route::get('report/getreport@filter','getreport') -> name('report.getreport');
});
//reportController

//roles
Route::controller(RolesController::class)->group(function(){
    Route::get('roles', 'index') -> name('roles.index');
    Route::post('roles/rolCreate@filter','rolCreate') -> name('roles.rolCreate');
    Route::post('roles/rolSave@filter','rolSave') -> name('roles.rolSave');
    Route::post('roles/rolDelete@filter','rolDelete') -> name('roles.rolDelete');
});
//roles

//licencias
Route::controller(LicenciasController::class)->group(function(){
    Route::get('licencias', 'index') -> name('licencias.index');
    Route::post('licencias/licCreate@filter','licCreate') -> name('licencias.licCreate');
    Route::post('licencias/licSave@filter','licSave') -> name('licencias.licSave');
    Route::post('licencias/licDelete@filter','licDelete') -> name('licencias.licDelete');
    Route::post('licencias/getLicences@filter','getLicences') -> name('licencias.getLicences');
});
//licencias

//licencias General
Route::controller(LicenciasGralController::class)->group(function(){
    Route::get('licenciasgral', 'index') -> name('licenciasgral.index');
    Route::post('licenciasgral/licGralFilterDate@filter','licGralFilterDate') -> name('licenciasgral.licGralFilterDate');
    Route::get('licenciasgral/licGralFilterDate@filter', 'licGralFilterDate') -> name('profesors.licGralFilterDate');
});
//licencias General