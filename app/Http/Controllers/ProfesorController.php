<?php

namespace App\Http\Controllers;

use App\Models\Licencias;
use App\Models\LicenciasXProfesor;
use App\Models\Profesor;
use App\Models\Roles;
use App\Models\vwLicenciasXProfesor;
use App\Models\vwRolXProfesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use PharIo\Manifest\License;

class ProfesorController extends Controller
{
    public function index(){
        $profesores = Profesor::paginate();
        $roles = Roles::get();
        $licencias = Licencias::get();
        return view("profesors/index",['profesores' => $profesores]);
    }

    public function create(){
        return view("profesors/create");
    }
    
    public function presents($id_profesor){
        return view("profesors/presents",['id_profesor' => $id_profesor]);
    }

    public function absents($id_profesor){
        $profesor = Profesor::find($id_profesor);
        $roles = vwRolXProfesor::where('legajo_prof',$profesor->legajo)->get();
        $licencias = Licencias::get();
        $lxps = vwLicenciasXProfesor::where('legajo_prof',$profesor->legajo)->where('baja',0)->orderByDesc('fecha')->paginate(10);

        return view("profesors/absents",['lxps' => $lxps,'profesor'=>$profesor,'roles' => $roles,'licencias' => $licencias]);
    }

    
    public function licFilterDate(Request $request)
    {
           if(request()->ajax())
            {
             if(!empty($request->from_date))
             {
                $this->validate($request,[
                    'from_date' => 'required|date',
                    'to_date' => 'required|date|after_or_equal:from_date',
                   ]);
              $lxps = vwLicenciasXProfesor::where('legajo_prof',$request->legajo)->whereBetween('fecha', array($request->from_date, $request->to_date))->orderByDesc('fecha')->paginate(10);
             }
             else
             {
                $lxps = vwLicenciasXProfesor::where('legajo_prof',$request->legajo)->where('baja',0)->orderByDesc('fecha')->paginate(10);
             }
            }
            return view("profesors/filterAbsents",['lxps' => $lxps])->render();
        //return $lxps;           
    }

    public function licDelete(Request $request)
    {
        $lic=LicenciasXProfesor::find($request->id_licencia);
        $profesor = Profesor::where('legajo',$request->legajo)->first();
        $lic->delete();
        $myRequest = new Request();
        $myRequest->setMethod('POST');
        $myRequest->request->add(['from_date' => '','legajo' => $profesor->legajo]);
        return $this->licFilterDate($myRequest);
    }

    public function licCreate(Request $request)
    {
        $request->validate([
            'licencia'=>'required',
            'rol'=>'required',
            'fecha'=>'required'
        ]);

        if (isset($request->validator) && $request->validator->fails())
        {
            return response()->json(['errors'=>$request->validator->messages()]);
        }

        else
        {
        $lxp = LicenciasXProfesor::where('legajo_prof',$request->legajo)
        ->where('id_licencia', $request->licencia)->where('id_rol_prof', $request->rol)
        ->where('fecha', $request->fecha)->first();
        if($lxp){
            $errors= [
                "Ya existe una misma licencia para esta fecha"
            ];
            return response()->json(['errors'=>$errors], 422);
        }
        else{
        $lxp2 = new LicenciasXProfesor();
        $profesor = Profesor::where('legajo',$request->legajo)->first();
        $lxp2->id_licencia = $request->licencia;
        $lxp2->id_rol_prof = $request->rol;
        $lxp2->legajo_prof = $request->legajo;
        $lxp2->fecha = Carbon::createFromDate($request->fecha)->toDateTimeString();
        $lxp2->baja = 0;
        $lxp2->save();
        return route('profesors.absents',['id_profesor' => $profesor->id]);
        }
        }
    }

    
}
