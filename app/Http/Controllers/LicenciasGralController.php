<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LicenciasXProfesor;
use App\Models\vwLicenciasXProfesor;
use App\Models\Profesor;
use App\Models\vwRolXProfesor;
use App\Models\Licencias;
use App\Models\logs;
use Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;

class LicenciasGralController extends Controller
{
    public function index()
    {
        $lxps = vwLicenciasXProfesor::where('baja', 0)->orderByDesc('fecha')->paginate(10);

        return view("licenciasgral/indexLicGral", ['lxps' => $lxps]);
    }

    public function licGralFilterDate(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $this->validate($request, [
                    'from_date' => 'required|date',
                    'to_date' => 'required|date|after_or_equal:from_date',
                ]);
                $lxps = vwLicenciasXProfesor::where('baja', 0)->whereBetween('fecha', array($request->from_date, $request->to_date))->orderByDesc('fecha')->paginate(10);
            } else {
                $lxps = vwLicenciasXProfesor::where('baja', 0)->orderByDesc('fecha')->paginate(10);
            }
        }
        return view("licenciasgral/filterAbsents", ['lxps' => $lxps])->render();
        //return $lxps;           
    }

    public function licxfec()
    {
        $profesors = Profesor::where('baja', 0)->get();
        return view("licenciasgral/licxfec", ['profesors' => $profesors]);
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
        return view("licenciasgral/licxfec_rolxprof", ['rxps' => $rxps])->render();
    }

    public function saveLicences(Request $request)
    {
        if (request()->ajax()) {

            /*Crear licencias x prof
                //id_licencia
                fecFrom
                fechaout
                legajo_prof
                id_rol_prof
                */
            $lic = $request;
            $profesors = Profesor::where('legajo', $lic->profesor)->first();
            $licencia = Licencias::where('id', $lic->licenciaId)->first();

            $rolXProf = vwRolXProfesor::where('id', $lic->rolId)->first();
            $fecFrom = $request->fecha_from;
            $fecTo = $request->fecha_to;

            if ($profesors) {

                if ($licencia) {

                    if ($rolXProf) {

                        if ($fecFrom && $fecTo) {
                            $dateFrom = Carbon::createFromFormat("Y-m-d", $fecFrom);
                            $dateTo = Carbon::createFromFormat("Y-m-d", $fecTo);
                            $diff2 = $dateFrom->diffInDays($fecTo);

                            $resultCompareDates = $dateTo->gt($dateFrom);
                            if ($resultCompareDates) {
                                //while ($diff2>0){
                                //$dateRange = CarbonPeriod::create($datefrom, $dateto);
                                $dateRange = CarbonPeriod::create($fecFrom, $fecTo);
                                foreach ($dateRange as $date) {
                                    $day = Carbon::parse($date);
                                    if ($day->dayOfWeek != Carbon::SUNDAY) {
                                        $licXprof = new LicenciasXProfesor();
                                        $licXprof->baja = 0;
                                        $licXprof->legajo_prof = $profesors->legajo;
                                        $licXprof->id_licencia = $licencia->id;
                                        $licXprof->id_rol_prof = $lic->rolId;
                                        $licXprof->fecha = $date;

                                        $licXProfTmp = LicenciasXProfesor::where('legajo_prof', $licXprof->legajo_prof)->where('id_licencia', $licXprof->id_licencia)->where('fecha', $licXprof->fecha)->where('id_rol_prof', $licXprof->id_rol_prof)->first();
                                    if ($licXProfTmp) {
                                        $logs = new logs();
                                        $logs->nombre = "ya existe licencia_x_profesor";
                                        $logs->detalle = "licencia_x_profesor: -legajo: " . $profesors->legajo . " -fecha: " . $licXprof->fecha . " -licencia: " . $licXprof->id_licencia . " -rolxprof: " . $licXprof->id_rol_prof;
                                        $logs->save();
                                    } else {
                                        $licXprof->save();
                                    }
                                        $licXprof->save();
                                    }
                                }
                            } else {
                                $logs = new logs();
                                $logs->nombre = "Fecha de fin menor a fecha de inicio";
                                $logs->save();
                            }
                        } else {
                            $logs = new logs();
                            $logs->nombre = "No se ingreso fecha Inicio o fin";
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
        }
        //return route('report.index');
    }
}
