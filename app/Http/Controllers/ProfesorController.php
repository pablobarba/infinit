<?php

namespace App\Http\Controllers;

use App\Models\Licencias;
use App\Models\LicenciasXProfesor;
use App\Models\Profesor;
use App\Models\Roles;
use App\Models\RolesXProfesor;
use App\Models\vwLicenciasXProfesor;
use App\Models\rolSemDays;
use App\Models\rolXProfesorSem;
use App\Models\vwRolXProfesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use PharIo\Manifest\License;
use App\Models\logs;

class ProfesorController extends Controller
{
    public function index()
    {
        $profesores = Profesor::where('baja', 0)->paginate();
        $roles = Roles::get();
        $licencias = Licencias::get();
        return view("profesors/index", ['profesores' => $profesores]);
    }
    
    public function create()
    {
        return view("profesors/create");
    }

    public function presents($id_profesor)
    {
        return view("profesors/presents", ['id_profesor' => $id_profesor]);
    }

    public function absents($id_profesor)
    {
        $profesor = Profesor::find($id_profesor);
        $roles = vwRolXProfesor::where('legajo_prof', $profesor->legajo)->get();
        $licencias = Licencias::get();
        $lxps = vwLicenciasXProfesor::where('legajo_prof', $profesor->legajo)->where('baja', 0)->orderByDesc('fecha')->paginate(10);

        return view("profesors/absents", ['lxps' => $lxps, 'profesor' => $profesor, 'roles' => $roles, 'licencias' => $licencias]);
    }

    public function filterProfesors(Request $request)
    {
        $profesores = new Profesor();
        if (request()->ajax()) {
            $search = $request->filter;
            $logs = new Logs();
            $logs->nombre = "search: " . $search;
            $logs->save();
            if ($search && ($search != "" || $search != " ")) {
                $profesores = Profesor::where('baja', 0)->where('nombre', 'like', '%' . $search . '%')->orWhere('apellido', 'like', '%' . $search . '%')
                    ->orWhere('legajo', 'like', '%' . $search . '%')->paginate(15);
                    return view("profesors/filterProfesors", ['profesores' => $profesores])->render();
            }
        }
        $profesores = Profesor::where('baja', 0)->paginate(15);
        

        return view("profesors/filterProfesors", ['profesores' => $profesores])->render();
    }

    public function licFilterDate(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $this->validate($request, [
                    'from_date' => 'required|date',
                    'to_date' => 'required|date|after_or_equal:from_date',
                ]);
                $lxps = vwLicenciasXProfesor::where('legajo_prof', $request->legajo)->where('baja', 0)->whereBetween('fecha', array($request->from_date, $request->to_date))->orderByDesc('fecha')->paginate(10);
            } else {
                $lxps = vwLicenciasXProfesor::where('legajo_prof', $request->legajo)->where('baja', 0)->orderByDesc('fecha')->paginate(10);
            }
        }
        return view("licenciasgral/filterAbsents", ['lxps' => $lxps])->render();
        //return $lxps;           
    }

    public function licDelete(Request $request)
    {
        $lic = LicenciasXProfesor::find($request->id_licencia);
        $profesor = Profesor::where('legajo', $request->legajo)->first();
        $lic->delete();
        $myRequest = new Request();
        $myRequest->setMethod('POST');
        $myRequest->request->add(['from_date' => '', 'legajo' => $profesor->legajo]);
        return $this->licFilterDate($myRequest);
    }

    public function licCreate(Request $request)
    {
        $request->validate([
            'licencia' => 'required',
            'rol' => 'required',
            'fecha' => 'required'
        ]);

        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json(['errors' => $request->validator->messages()]);
        } else {
            $lxp = LicenciasXProfesor::where('legajo_prof', $request->legajo)
                ->where('id_licencia', $request->licencia)->where('id_rol_prof', $request->rol)
                ->where('fecha', $request->fecha)->first();
            if ($lxp) {
                $errors = [
                    "Ya existe una misma licencia para esta fecha"
                ];
                return response()->json(['errors' => $errors], 422);
            } else {
                $lxp2 = new LicenciasXProfesor();
                $profesor = Profesor::where('legajo', $request->legajo)->first();
                $lxp2->id_licencia = $request->licencia;
                $lxp2->id_rol_prof = $request->rol;
                $lxp2->legajo_prof = $request->legajo;
                $lxp2->fecha = Carbon::createFromDate($request->fecha)->toDateTimeString();
                $lxp2->baja = 0;
                $lxp2->save();
                return route('profesors.absents', ['id_profesor' => $profesor->id]);
            }
        }
    }

    public function roles($id_profesor)
    {
        $profesor = Profesor::find($id_profesor);
        $rxps = vwRolXProfesor::where('legajo_prof', $profesor->legajo)->get();
        $roles = Roles::get();
        return view("profesors/roles", ['rxps' => $rxps, 'profesor' => $profesor, 'roles' => $roles]);
    }

    public function rolDelete(Request $request)
    {
        if (request()->ajax()) {
            $request->validate([
                'fecha_fin' => 'required',
            ]);

            if (isset($request->validator) && $request->validator->fails()) {

                return response()->json(['errors' => $request->validator->messages()], 422);
            } else {
                $rol = RolesXProfesor::find($request->id_rol_x_pro);
                $rol->baja = 0;
                $rol->fecha_fin = $request->fecha_fin;
                $rol->save();
                $profesor = Profesor::where('legajo', $request->legajo)->first();
                return route('profesors.roles', ['id_profesor' => $profesor->id]);
            }
        }
    }

    public function rolCreate(Request $request)
    {
        $request->validate([
            'id_rol' => 'required',
            'sit_revista' => 'required'
        ]);

        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json(['errors' => $request->validator->messages()]);
        } else {
            //check if already exist
            $rxp = RolesXProfesor::where('legajo_prof', $request->legajo)
                ->where('id_rol', $request->id_rol)->where('sit_revista', $request->sit_revista)->first();
            if ($rxp) {
                $errors = [
                    "Ya existe la asignación por rol"
                ];
                return response()->json(['errors' => $errors], 422);
            } else {
                $rxp2 = new RolesXProfesor();
                $profesor = Profesor::where('legajo', $request->legajo)->first();
                $rxp2->id_rol = $request->id_rol;
                $rxp2->legajo_prof = $request->legajo;
                $rxp2->sit_revista =  $request->sit_revista;
                $rxp2->baja = 0;
                $rxp2->save();
                return route('profesors.roles', ['id_profesor' => $profesor->id]);
            }
        }
    }

    public function rolSemDays(Request $request)
    {
        if (request()->ajax()) {
            $rxpss = rolXProfesorSem::where('id_rol_prof', $request->id_rol_prof)->first();
            if ($rxpss) {
                return view("profesors/rolesSemDays", ['r' => $rxpss, 'nombre_rol' => $request->nombre_rol, 'data_sit' => $request->data_sit])->render();
            } else {
                $rxpss = new  rolXProfesorSem();
                $rxpss->id = 0;
                $rxpss->id_rol_prof = $request->id_rol_prof;
                $rxpss->legajo_prof = $request->legajo;
                $rxpss->lunes = 0;
                $rxpss->martes = 0;
                $rxpss->miercoles = 0;
                $rxpss->jueves = 0;
                $rxpss->viernes = 0;
                $rxpss->sabado = 0;
                return view("profesors/rolesSemDays", ['r' => $rxpss, 'nombre_rol' => $request->nombre_rol, 'data_sit' => $request->data_sit])->render();
            }
        }
    }

    public function rolSaveSemDays(Request $request)
    {
        if (request()->ajax()) {
            $rxpss = new rolXProfesorSem();
            $result = json_decode($request);
            if ($request->data['id'] > 0) {
                $idRolSem = $request->data['id'];
                $rxpss = rolXProfesorSem::where('id',$idRolSem)->first();
            }

            $rxpss->id_rol_prof = $request->data['id_rol_prof'];
            $rxpss->baja = 0;
            $rxpss->lunes = $request->data['monday'] == 'true' ? 1 : 0;
            $rxpss->martes = $request->data['tuesday'] == 'true' ? 1 : 0;
            $rxpss->miercoles = $request->data['wenesday'] == 'true' ? 1 : 0;
            $rxpss->jueves = $request->data['thursday'] == 'true' ? 1 : 0;
            $rxpss->viernes = $request->data['friday'] == 'true' ? 1 : 0;
            $rxpss->sabado = $request->data['saturday'] == 'true' ? 1 : 0;

            $rxpss->save();
        }
    }

    public function save(Request $request)
    {
        if (request()->ajax()) {
            $profesor = new Profesor();
            //verifico datos obligatorios
            if ($request->data['nombre'] == null || $request->data['nombre'] == '') {
                $errors = [
                    "Nombre es obligatorio"
                ];
                return response()->json(['errors' => $errors], 422);
            } else if ($request->data['apellido'] == null || $request->data['apellido'] == '') {
                $errors = [
                    "Apellido es obligatorio"
                ];
                return response()->json(['errors' => $errors], 422);
            } else if ($request->data['legajo'] == null || $request->data['legajo'] == '') {
                $errors = [
                    "Legajo es obligatorio"
                ];
                return response()->json(['errors' => $errors], 422);
            }
            //
            $name = $request->data['nombre'];
            $lastname = $request->data['apellido'];
            $legajo = $request->data['legajo'];
            $isProfesor = $request->data['es_profesor'];

            /* if($request->data['id']>0){
            $idRol = $request->data['id'];
            
            $rxp = Roles::where('codigo', $code)->first();
            if($rxp){
                if($rxp->id != $idRol){
                $errors= [
                    "El codigo ya existe"
                ];
                return response()->json(['errors'=>$errors], 422);
            }
            }

            $rol = Roles::where('id', $idRol)->first();
            if($rol)
            {
            $rol->nombre = $name;
            $rol->codigo = $code;
            }
            $rol->save();
            return route('roles.index');
        }
        else{*/
            //si es rol nuevo

            //verifico si rol ya existe
            $rxp = Profesor::where('legajo', $legajo)->first();
            if ($rxp) {
                $errors = [
                    "El legajo ya existe"
                ];
                return response()->json(['errors' => $errors], 422);
            }
            $profesor->baja = 0;
            $profesor->nombre = $name;
            $profesor->apellido = $lastname;
            $profesor->legajo = $legajo;
            $profesor->legajo = $legajo;
            $profesor->es_profesor = $request->data['es_profesor'] == 'true' ? 1 : 0;

            $profesor->save();
            return route('profesors.index');
            //}

        }
    }

    public function getRolProfSemDay(Request $request)
    {
        if (request()->ajax()) {
            $rxpss = rolXProfesorSem::where('id_rol_prof', $request->id_rol_prof)->first();
            if ($rxpss) {
                return $rxpss;
            }
        }
    }

    public function delete(Request $request)
    {
        if (request()->ajax()) {
            $profesor = Profesor::where('id', $request->id_profesor)->first();
            $profesor->baja = 1;
            $profesor->save();
            return route('profesors.index');
        }
    }
}
