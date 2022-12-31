<?php

namespace App\Http\Controllers;

use App\Models\Licencias;
use App\Models\LicenciasXProfesor;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;
use App\Models\RolesXProfesor;
use App\Models\Profesor;
use App\Models\vwRolXProfesor;
use App\Models\logs;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $profesors = Profesor::where('baja', 0)->get();
        //$report = Report::paginate();
        return view("report/index", ['profesors' => $profesors]);
    }

    public function getRolByProfesor(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->legajo)) {
                /*$this->validate($request,[
                    'from_date' => 'required|date',
                    'to_date' => 'required|date|after_or_equal:from_date',
                   ]);*/
                $rxps = vwRolXProfesor::where('legajo_prof', $request->legajo)->where('baja',0)->paginate(10);
            }
        }
        return view("report/rolesByProfesor", ['rxps' => $rxps])->render();
    }
    public function saveLicences(Request $request)
    {
        if (request()->ajax()) {
            //{"profesor":"36718500","rolId":"2","rol":"Rol 2","dia":"Domingo","licenciaId":"3","licencia":"covid2"}
            /*Crear licencias x prof
                //id_licencia
                fecha
                legajo_prof
                id_rol_prof
                */
            foreach (json_decode($request->licencias) as $lic) {
                $profesors = Profesor::where('legajo', $lic->profesor)->first();
                $licencia = Licencias::where('id', $lic->licenciaId)->first();
                $rolXProf = Licencias::where('id', $lic->rolId)->first();

                $fecIni = $request->fecha;

                $licXprof = new LicenciasXProfesor();
                $licXprof->baja = 0;
                if ($fecIni) {
                    if ($profesors) {
                        $licXprof->legajo_prof = $profesors->legajo;
                        if ($licencia) {
                            $licXprof->id_licencia = $licencia->id;
                            if ($rolXProf) {
                                $licXprof->id_rol_prof = $lic->rolId;
                                if ($lic->dia) {
                                    $day = $lic->dia;
                                    $daysToAdd = 0;
                                    if (strtoupper($day) == "LUNES") {
                                        $daysToAdd = 0;
                                    }
                                    if (strtoupper($day) == "MARTES") {
                                        $daysToAdd = 1;
                                    }
                                    if (strtoupper($day) == "MIERCOLES") {
                                        $daysToAdd = 2;
                                    }
                                    if (strtoupper($day) == "JUEVES") {
                                        $daysToAdd = 3;
                                    }
                                    if (strtoupper($day) == "VIERNES") {
                                        $daysToAdd = 4;
                                    }
                                    if (strtoupper($day) == "SABADO") {
                                        $daysToAdd = 5;
                                    }
                                    //if (strtoupper($day) == "DOMINGO") {
                                    //   $daysToAdd = 6;
                                    //}
                                   // $fecIni = $fecIni->addDays($daysToAdd);
                                    $fecIni = date('Y-m-d',strtotime($request->fecha . "+".$daysToAdd." days"));
                                    $licXprof->fecha = $fecIni;
                                    //test2
                                    $logs = new logs();
                                    $logs->nombre = "fecINI2: " . $fecIni;
                                    $logs->save();
                                    
                                    //veo si ya existe licencia por rol prof
                                    $licXProfTmp = LicenciasXProfesor::where('legajo_prof',$profesors->legajo)->where('id_licencia',$licencia->id)->where('fecha',$fecIni)->where('id_rol_prof',$rolXProf->id)->first();
                                    if($licXProfTmp)
                                    {
                                        $logs = new logs();
                                        $logs->nombre = "ya existe licencia_x_profesor";
                                        $logs->detalle = "licencia_x_profesor: -legajo: " . $profesors->legajo . " -fecha: " . $fecIni . " -licencia: " . $licencia->id . " -rolxprof: " . $rolXProf->id;
                                        $logs->save();
                                    }
                                    else{
                                        $licXprof->save();
                                    }
                                    
                                } else {
                                    $logs = new logs();
                                    $logs->nombre = "No se informo dia";
                                    $logs->save();
                                }
                            } else {
                                $logs = new logs();
                                $logs->nombre = "No existe rol x Prof - id:" . $lic->rolId;
                                $logs->save();
                            }
                        } else {
                            $logs = new logs();
                            $logs->nombre = "No existe licencia - id:" . $lic->licenciaId;
                            $logs->save();
                        }
                    } else {
                        $logs = new logs();
                        $logs->nombre = "No existe profesor - legajo:" . $lic->profesor;
                        $logs->save();
                    }
                } else {
                    $logs = new logs();
                    $logs->nombre = "No se ingreso fecha Inicio";
                    $logs->save();
                }
            }
        }
        return route('report.index');
    }

    public function report(Request $request)
    {
        $sem = $request->date;

        $rxps = vwRolXProfesor::where('baja',0)->get();

        foreach (($rxps) as $lic) {
            
        }
    }

}
