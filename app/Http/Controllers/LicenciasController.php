<?php

namespace App\Http\Controllers;
use App\Models\Licencias;
use App\Models\LicenciasXProfesor;
use Illuminate\Http\Request;
use PharIo\Manifest\License;
 
class LicenciasController extends Controller
{
    public function index(){
        $licencias = Licencias::paginate(10);
        return view("licencias/index",['licencias' => $licencias]);
    }

    public function licCreate(Request $request)
    {
        if(request()->ajax())
        {
                $lic =null;
                if($request->id_lic > 0){
                $lic = Licencias::where('id',$request->id_lic)->first();
                }
                if($lic){
                    return view("licencias/licenciasAbm",['lic' => $lic,'lic_name' => $request->nombre_lic])->render();
                }
                else{  
                    $lic =new  Licencias();
                    $lic->id = 0;
                    return view("licencias/licenciasAbm",['lic' => $lic,'lic_name' => ''])->render();
                }
           
            
        }
    }

    public function licSave(Request $request)
    {
        if(request()->ajax())
            {
        $lic = new Licencias();
        //verifico datos obligatorios
        if($request->data['nombre'] == null || $request->data['nombre'] == ''){
            $errors= [
                "Nombre es obligatorio"
            ];
            return response()->json(['errors'=>$errors], 422);
        }
        else if($request->data['codigo'] == null || $request->data['codigo'] == '')
        {
            $errors= [
                "Codigo es obligatorio"
            ];
            return response()->json(['errors'=>$errors], 422);
        }
        //
        $name = $request->data['nombre'];
        $code = $request->data['codigo'];

        if($request->data['id']>0){
            $idLic = $request->data['id'];
            
            $rxp = Licencias::where('codigo', $code)->first();
            if($rxp){
                if($rxp->id != $idLic){
                $errors= [
                    "El codigo ya existe"
                ];
                return response()->json(['errors'=>$errors], 422);
            }
            }

            $lic = Licencias::where('id', $idLic)->first();
            if($lic)
            {
            $lic->nombre = $name;
            $lic->codigo = $code;
            }
            $lic->save();
            return route('licencias.index');
        }
        else{
            //si es rol nuevo

            //verifico si rol ya existe
            $lxp = Licencias::where('codigo', $code)->first();
            if($lxp){
                $errors= [
                    "El rol ya existe"
                ];
                return response()->json(['errors'=>$errors], 422);
            }
            $lic->baja = 0;
            $lic->nombre = $name;
            $lic->codigo = $code;
            
        $lic->save();
        return route('licencias.index');
        }
        
        }
    }
    
    public function licDelete(Request $request)
    {
        if(request()->ajax())
        {
            $lxp = LicenciasXProfesor::where('id_licencia',$request->id_lic)->where('baja',0)->first();
            if($lxp){
                $errors= [
                    "No se puede borrar la licencia, hay asignaciones vigentes."
                ];
                return response()->json(['errors'=>$errors], 422);
            }
            if($request->id_lic>0){
                $idLic = $request->id_lic;
                $lic = Licencias::where('id', $idLic)->first();
                if($lic)
                {
                    $active = $request->active == 'true' ? 0 : 1;
                    $lic->baja = $active;
                    $lic->save();
                    return route('licencias.index');
                }
            }
        }
    }

    public function getLicences(Request $request){
        if(request()->ajax())
            {
              $lic = Licencias::where('baja',0)->get();
            }
            return view("licencias/getLicenciasSel",['lic' => $lic])->render();     
    }
}
