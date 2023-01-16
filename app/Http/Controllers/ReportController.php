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

                $rolXProf = vwRolXProfesor::where('id', $lic->rolId)->first();

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

        $collection = new Collection();

        $fecIni = date('Y-m-d', strtotime($request->fecha_proceso));
        $fecFin = date('Y-m-d', strtotime($request->fecha_proceso . "+" . 5 . " days"));

        //obtengo roles sin fecha_fin y con fecha fin en rango
        $rxps1 = vwRolXProfesor::where('baja',0)->whereNull('fecha_fin')->get();
        $rxps1_2 = vwRolXProfesor::where('fecha_fin', '>', $fecFin)->get();
        $rxps1 = $rxps1->merge($rxps1_2);

        $rxps2 = vwRolXProfesor::where('baja', 0)->whereBetween('fecha_fin', [$fecIni, $fecFin])->get();
        
        $rxps = $rxps1->merge($rxps2);

        $rxps = collect($rxps)->sortByDesc('legajo_prof');

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
            //falta filtro rol
            $lxps = vwLicenciasXProfesor::where('legajo_prof', $rxp->legajo_prof)->where('id_rol_prof', $rxp->id)->whereBetween('fecha', [$fecIni, $fecFin])->get();

            foreach (($lxps) as $lxp) {
                $day = Carbon::parse($lxp->fecha);
                $dayName = $day->format('l');

                if ($day->dayOfWeek === Carbon::MONDAY) {
                    $tmp->lunes = $lxp->nombre_licencia;
                }
                if ($day->dayOfWeek === Carbon::TUESDAY) {
                    $tmp->martes = $lxp->nombre_licencia;
                }
                if ($day->dayOfWeek === Carbon::WEDNESDAY) {
                    $tmp->miercoles = $lxp->nombre_licencia;
                }
                if ($day->dayOfWeek === Carbon::THURSDAY) {
                    $tmp->jueves = $lxp->nombre_licencia;
                }
                if ($day->dayOfWeek === Carbon::FRIDAY) {
                    $tmp->viernes = $lxp->nombre_licencia;
                }
                if ($day->dayOfWeek === Carbon::SATURDAY) {
                    $tmp->sabado = $lxp->nombre_licencia;
                }
            }
            #endregion

            #region ver dias no disponibles
            $rxpsem = rolXProfesorSem::where('id_rol_prof', $rxp->id)->where('baja', 0)->first();
            $logs = new logs();
            $logs->nombre = "rxpsem: " . $rxp->apellido_profesor;
            $logs->save();
            if ($rxpsem) {
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

            #region ver fecha_fin
            if ($rxp->fecha_fin != null && ($rxp->fecha_fin >= $fecIni && $rxp->fecha_fin <= $fecFin)){
                $tmp = $this->setBajaSem($rxp,$tmp);
            }
            #endregion

            #region ver feriados
            #endregion

            $collection->push($tmp);
        }

        #region calcDay
        $dayIni =  date('d', strtotime($fecIni));
        $dayFin =  date('d', strtotime($fecFin));

        $idxFec = Carbon::parse($fecIni);
        if ($idxFec->month == 1) {
            $monthRep = "ENERO";
        } else if ($idxFec->month == 2) {
            $monthRep = "FEBRERO";
        } else if ($idxFec->month == 3) {
            $monthRep = "MARZO";
        } else if ($idxFec->month == 4) {
            $monthRep = "ABRIL";
        } else if ($idxFec->month == 5) {
            $monthRep = "MAYO";
        } else if ($idxFec->month == 6) {
            $monthRep = "JUNIO";
        } else if ($idxFec->month == 7) {
            $monthRep = "JULIO";
        } else if ($idxFec->month == 8) {
            $monthRep = "AGOSTO";
        } else if ($idxFec->month == 9) {
            $monthRep = "SEPTIEMBRE";
        } else if ($idxFec->month == 10) {
            $monthRep = "OCTUBRE";
        } else if ($idxFec->month == 11) {
            $monthRep = "NOVIEMBRE";
        } else if ($idxFec->month == 12) {
            $monthRep = "DICIEMBRE";
        }

        $yearRep = $idxFec->year;
        $dayReport = "desde" . " " . $dayIni . " al " . $dayFin . " de " . $monthRep . " del " . $yearRep;
        #endregion

        $json = json_encode($collection);

        return Excel::download(new profExport($collection, $dayReport), 'invoices.xlsx');

        //return Excel::download(new Export($collection), 'test.xlsx');
        //return $json;
    }
    public function setBajaSem($rxp,$tmp)
    {
        $dayFf = Carbon::parse($rxp->fecha_fin);
       
        
        if ($dayFf->dayOfWeek === Carbon::MONDAY) {
            $tmp->lunes = "BAJA";
            $tmp->martes = "BAJA";
            $tmp->miercoles = "BAJA";
            $tmp->jueves = "BAJA";
            $tmp->viernes = "BAJA";
            $tmp->sabado = "BAJA";
        }
        if ($dayFf->dayOfWeek === Carbon::TUESDAY) {
            $tmp->martes = "BAJA";
            $tmp->miercoles = "BAJA";
            $tmp->jueves = "BAJA";
            $tmp->viernes = "BAJA";
            $tmp->sabado = "BAJA";
        }
        if ($dayFf->dayOfWeek === Carbon::WEDNESDAY) {
            $tmp->miercoles = "BAJA";
            $tmp->jueves = "BAJA";
            $tmp->viernes = "BAJA";
            $tmp->sabado = "BAJA";
        }
        if ($dayFf->dayOfWeek === Carbon::THURSDAY) {
            $tmp->jueves = "BAJA";
            $tmp->viernes = "BAJA";
            $tmp->sabado = "BAJA";
        }
        if ($dayFf->dayOfWeek === Carbon::FRIDAY) {
            $tmp->viernes = "BAJA";
            $tmp->sabado = "BAJA";
        }
        if ($dayFf->dayOfWeek === Carbon::SATURDAY) {
            $tmp->sabado = "BAJA";
        }
       // dd($rxp);
        return $tmp;
    }
}
