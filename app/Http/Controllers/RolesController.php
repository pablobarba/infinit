<?php

namespace App\Http\Controllers;
use App\Models\Roles;
use App\Models\RolesXProfesor;
use App\Models\vwRolXProfesor;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index(){
        $roles = Roles::paginate(10);
        return view("roles/index",['roles' => $roles]);
    }

    public function rolCreate(Request $request)
    {
        if(request()->ajax())
            {
                $rol =null;
                if($request->id_rol > 0){
                $rol = Roles::where('id',$request->id_rol)->first();
                }
                if($rol){
                    return view("roles/rolesAbm",['rol' => $rol,'rol_name' => $request->nombre_rol])->render();
                }
                else{  
                    $rol =new  Roles();
                    $rol->id = 0;
                    return view("roles/rolesAbm",['rol' => $rol,'rol_name' => ''])->render();
                }
           
            
    }
    }

    public function rolSave(Request $request)
    {
        if(request()->ajax())
            {
        $rol = new Roles();
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
        else{
            //si es rol nuevo

            //verifico si rol ya existe
            $rxp = Roles::where('codigo', $code)->first();
            if($rxp){
                $errors= [
                    "El rol ya existe"
                ];
                return response()->json(['errors'=>$errors], 422);
            }
            $rol->baja = 0;
            $rol->nombre = $name;
            $rol->codigo = $code;
            
        $rol->save();
        return route('roles.index');
        }
        
        }
    }
    
    public function rolDelete(Request $request)
    {
        if(request()->ajax())
        {
            $rxp = RolesXProfesor::where('id_rol',$request->id_rol)->where('baja',0)->first();
            if($rxp){
                $errors= [
                    "No se puede borrar el rol, hay asignaciones vigentes."
                ];
                return response()->json(['errors'=>$errors], 422);
            }
            if($request->id_rol>0){
                $idRol = $request->id_rol;
                $rol = Roles::where('id', $idRol)->first();
                if($rol)
                {
                    $active = $request->active == 'true' ? 0 : 1;
                    $rol->baja = $active;
                    $rol->save();
                    return route('roles.index');
                }
            }
        }
    }

}
