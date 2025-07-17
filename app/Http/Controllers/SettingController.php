<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Setting;

use Exception;

class SettingController extends Controller
{
    public function settings(Setting $settings){
        $settings = Setting::first();

        return view("settings",compact("settings"));
    }

     public function addSettings(Setting $setting,Request $request){     
        $settings = Setting::first();
        
        if($settings == null){
            $request -> validate([
                "dias_clases" => "required",
                "promedio_promocion" => "required",
                "promedio_regularidad" => "required",
                "edad_minima" => "required"
            ]);
    
            try{
                $settings = new Setting();
                $settings->dias_clases = $request->dias_clases;
                $settings->promedio_promocion = $request->promedio_promocion;
                $settings->promedio_regularidad = $request->promedio_regularidad;
                $settings->edad_minima = $request->edad_minima;
                
                $settings->save();
            } catch (Exception $e) {
                unset($settings);
                return redirect()->route("student.settings")->with("error","Ocurrió un error al intentar cargar la configuración. ".$e);
            }
            
            unset($settings);
            return redirect()->route("student.settings")->with("success","¡Se cargó la configuración!");
        }else{
            $request -> validate([
                "dias_clases" => "required",
                "promedio_promocion" => "required",
                "promedio_regularidad" => "required",
                "edad_minima" => "required"
            ]);
            
            try{
                $settings->dias_clases = $request->dias_clases;
                $settings->promedio_promocion = $request->promedio_promocion;
                $settings->promedio_regularidad = $request->promedio_regularidad;
                $settings->edad_minima = $request->edad_minima;
                
                $settings->save();
            } catch (Exception $e) {
                unset($settings);
                return redirect()->route("student.settings")->with("error","Ocurrió un error al intentar actualizar la configuración. ".$e);
            }
            
            unset($settings);
            return redirect()->route("student.settings")->with("success","¡Se actualizó la configuración!");
        }
    }        
}
