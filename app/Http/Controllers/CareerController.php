<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Exception;
use Illuminate\Http\Request;

class CareerController extends Controller
{
       public function add(Request $request){
        $request->validate([
            "nombreCarrera" => ["required","string","between:6,32"],
            "cantidadAnios" => ["required","numeric","digits:1"],
            "divisiones" => ["required","string"]
        ]);

         try{
            $career = new Career();
            
            $career->name = $request->nombreCarrera;
            $career->total_years = $request->cantidadAnios;
            $career->career_divisions = $request->divisiones;

            $career->save();
            unset($student);
        }catch(Exception $e){
            unset($student);
            return redirect()->back()->with("error","Ocurrió un error al dar de alta la carrera.");
        }

        return redirect()->back()->with("success","¡La carrera fue dada de alta!");
    }
}
