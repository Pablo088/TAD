<?php

namespace App\Http\Controllers;

use App\Models\Assist;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function studentCondition($id){
        $assist = Assist::where("student_id",$id)->count();
        $cantidadClases = 10;
        $condicion = ($assist / $cantidadClases)*100;

        if($condicion >= 80){
            return "Promocionado $assist";
        } else if($condicion >= 60 && $condicion < 80){
                    return "Regular $assist";
        } else {
            return "Libre $assist";
        }
    }
}
