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
use App\Models\rolXProfesorSem;
use App\Models\vwLicenciasXProfesor;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

use App\Exports\Export;
use App\Exports\profExport;
use Maatwebsite\Excel\Facades\Excel;

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
                $rxps = vwRolXProfesor::where('legajo_prof', $request->legajo)->where('baja', 0)->paginate(10);
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
                                    $fecIni = date('Y-m-d', strtotime($request->fecha . "+" . $daysToAdd . " days"));
                                    $licXprof->fecha = $fecIni;

                                    //veo si ya existe licencia por rol prof
                                    $licXProfTmp = LicenciasXProfesor::where('legajo_prof', $profesors->legajo)->where('id_licencia', $licencia->id)->where('fecha', $fecIni)->where('id_rol_prof', $rolXProf->id)->first();
                                    if ($licXProfTmp) {
                                        $logs = new logs();
                                        $logs->nombre = "ya existe licencia_x_profesor";
                                        $logs->detalle = "licencia_x_profesor: -legajo: " . $profesors->legajo . " -fecha: " . $fecIni . " -licencia: " . $licencia->id . " -rolxprof: " . $rolXProf->id;
                                        $logs->save();
                                    } else {
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

    public function genreport()
    {
        return view("report/generateReport");
    }

    //request array feriados && fecha_proceso(lunes)
    public function getreport(Request $request)
    {
        $sem = $request->fecha_proceso;

        #region log
        $logs = new logs();
        $logs->nombre = "sem: " . $sem;
        $logs->save();
        #endregion

        $collection = new Collection();
        $rxps = vwRolXProfesor::where('baja', 0)->whereNull('fecha_fin')->orderBy('legajo_prof', 'DESC')->get();
        
        $logs = new logs();
        $logs->nombre = "vwRolXProfesor_count: " . $rxps->count();
        $logs->save();

        foreach (($rxps) as $rxp) {
            //por cada rol prof veo dias disponibles
            //id baja legajo_prof nombre_profesor apellido_profesor nombre_rol sit_revista fecha_fin	
            $tmp = (object)[
                'legajo' => $rxp->legajo_prof,
                'apellido' => $rxp->apellido_profesor,
                'nombre' => $rxp->nombre_profesor,
                'puesto' => $rxp->nombre_rol,
                'sit_revista' => $rxp->sit_revista,
                'lunes' => "",
                'martes' => "",
                'miercoles' => "",
                'jueves' => "",
                'viernes' => "",
                'sabado' => "",
                'observaciones' => ""
            ];

            #region ver licencias
            $fecIni = date('Y-m-d', strtotime($request->fecha_proceso));
            $fecFin = date('Y-m-d', strtotime($request->fecha_proceso . "+" . 6 . " days"));
            #region log
            $logs = new logs();
            $logs->nombre = "fecIni: " . $fecIni;
            $logs->save();
            $logs2 = new logs();
            $logs2->nombre = "fecFin: " . $fecFin;
            $logs2->save();
            #endregion

            //falta filtro rol
            $lxps = vwLicenciasXProfesor::where('legajo_prof', $rxp->legajo_prof)->whereBetween('fecha', [$fecIni, $fecFin])->get();
            foreach (($lxps) as $lxp) {
                $day = Carbon::parse($lxp->fecha);
                $dayName = $day->format('l');

                if ($day->dayOfWeek === Carbon::MONDAY) {
                    $tmp->lunes = $lxp->nombre_licencia;
                    $logs = new logs();
                    $logs->nombre = "MONDAY: " . $tmp->lunes;
                    $logs->save();
                }
                if ($day->dayOfWeek === Carbon::TUESDAY) {
                    $tmp->martes = $lxp->nombre_licencia;
                    $logs = new logs();
                    $logs->nombre = "TUESDAY: " . $tmp->martes;
                    $logs->save();
                }
                if ($day->dayOfWeek === Carbon::WEDNESDAY) {
                    $tmp->miercoles = $lxp->nombre_licencia;
                    $logs = new logs();
                    $logs->nombre = "WEDNESDAY: " . $tmp->miercoles;
                    $logs->save();
                }
                if ($day->dayOfWeek === Carbon::THURSDAY) {
                    $tmp->jueves = $lxp->nombre_licencia;
                    $logs = new logs();
                    $logs->nombre = "THURSDAY: " . $tmp->jueves;
                    $logs->save();
                }
                if ($day->dayOfWeek === Carbon::FRIDAY) {
                    $tmp->viernes = $lxp->nombre_licencia;
                    $logs = new logs();
                    $logs->nombre = "FRIDAY: " . $tmp->viernes;
                    $logs->save();
                }
                if ($day->dayOfWeek === Carbon::SUNDAY) {
                    $tmp->sabado = $lxp->nombre_licencia;
                    $logs = new logs();
                    $logs->nombre = "SUNDAY: " . $tmp->sabado;
                    $logs->save();
                }
            }
            #endregion

            #region ver feriados
            #endregion

            #region ver dias no disponibles
            $rxpsem = rolXProfesorSem::where('id_rol_prof', $rxp->id)->where('baja', 0)->first();
            $logs = new logs();
            $logs->nombre = "rxpsem: " . $rxp->apellido_profesor ;
            $logs->save();
            if ($rxpsem) {
                $logs = new logs();
            $logs->nombre = "rxpsem: IN" . " count: " . $rxpsem->count();
            $logs->detalle = "rxpsem: IN" .  json_encode($rxpsem);          
            $logs->save();

            $logs = new logs();
            $logs->nombre = "rxpsem: LUNES" . $rxpsem->lunes;    
            $logs->save();
                if ($rxpsem->lunes == 1) {
                    $tmp->lunes = "NC-No Corresponde";
                }
                if ($rxpsem->martes == 1) {
                    $tmp->martes = "NC-No Corresponde";
                }
                if ($rxpsem->miercoles == 1) {
                    $tmp->miercoles = "NC-No Corresponde";
                }
                if ($rxpsem->jueves == 1) {
                    $tmp->jueves = "NC-No Corresponde";
                }
                if ($rxpsem->viernes == 1) {
                    $tmp->viernes = "NC-No Corresponde";
                }
                if ($rxpsem->sabado == 1) {
                    $tmp->sabado = "NC-No Corresponde";
                }
            }
            #endregion
            $collection->push($tmp);
        }
        
        $json = json_encode($collection);

        return Excel::download(new profExport($collection), 'invoices.xlsx');
        
        //return Excel::download(new Export($collection), 'test.xlsx');
        //return $json;
    }

    
}
