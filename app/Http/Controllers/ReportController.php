<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;
use App\Models\RolesXProfesor;
use App\Models\Profesor;

class ReportController extends Controller
{
    public function index(){
        $profesors = Profesor::where('baja',0)->get();
        //$report = Report::paginate();
        return view("report/index",['profesors' => $profesors]);
    }

    public function getRolByProfesor(Request $request){
        if(request()->ajax())
            {
             if(!empty($request->legajo))
             {
                /*$this->validate($request,[
                    'from_date' => 'required|date',
                    'to_date' => 'required|date|after_or_equal:from_date',
                   ]);*/
              $rxps = RolesXProfesor::where('legajo_prof',$request->legajo)->paginate(10);
             }
             
            }
            return view("report/rolesByProfesor",['rxps' => $rxps])->render();     
    }
    public function createReport(Request $request){
        if(request()->ajax())
            {
             
            }
            return true;
    }
}
