<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LicenciasXProfesor;
use App\Models\vwLicenciasXProfesor;

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
}
