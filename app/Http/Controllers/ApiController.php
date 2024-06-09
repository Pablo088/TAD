<?php

namespace App\Http\Controllers;

use App\Models\Assist;
use App\Models\Condition;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function studentCondition($id){
        $assist = Assist::where("student_ida",$id)->count();
        $cantidadClases = 10;
        $condicion = ($assist / $cantidadClases)*100;

        if($condicion >= 80){
            $student = new Condition();
            $student->student_idc = $id;
            $student->statusd = "promocionado";
            $student->save();

            return "Promocionado $assist";
        } else if($condicion >= 60 && $condicion < 80){
            $student = new Condition();
            $student->student_idc = $id;
            $student->status = "regular";
            $student->save();

                    return "Regular $assist";
        } else {

            $student = new Condition();
            $student->student_idc = $id;
            $student->status = "libre";
            $student->save();

            return "Libre $assist";
        }
    }
}
