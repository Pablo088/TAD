<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;

use Illuminate\Support\Str;

use App\Models\Logging;

use Illuminate\Support\Facades\Auth;

use App\Models\Assist;

use App\Models\Nota;

use Carbon\Carbon;

use Illuminate\Support\Facades\Db;

use App\Models\Setting;

class StudentController extends Controller
{
    public function menu(){
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $dia_actual = Carbon::now()->format("m-d");
        $student = Student::select("students.id","dni","name","lastName","birthDate","students.year","division")->join("divisions","divisions.student_idd","=","students.id")->get();
        $cumpleanios = Student::where("birthDate","LIKE","%".$dia_actual."%")->select("name","lastName")->get();
        return view("studentMenu",compact("student","cumpleanios"));
    }

    public function filter(Request $request){

        $student = Student::where("students.year",$request->filter)->join("divisions","students.id","=","divisions.student_idd")->get();
        return view("studentFilter",compact("student"));
    }

    public function new(){
        return view("ABM.add");
    }

    public function add(Request $request){
        $log = new Logging();
        $idUsuario =  Auth::user()->id;

        if($idUsuario !== null){
            $log->user_id = Auth::user()->id;
            $log->user_nav = $request->header('user-agent');
            $log->user_ip = $request->ip('user-agent');
            $log->user_action = "alta";
            $log->save();
        }

        $request->validate([
            "dni"=>"required",
            "name"=>"required",
            "lastName"=>"required",
            "birthDate"=>"required",
            "year"=>"required",
            "division"=>"required"
        ]);
        
        $student = new Student();

        $student->dni = $request->dni;
        $student->name = $request->name;
        $student->lastName = $request->lastName;
        $student->birthDate = $request->birthDate;
        $student->year = $request->year;
        $student->division = $request->division;

        $student->save();

        return redirect()->route("student.new");
    }

    public function edit($id){
        $student = Student::find($id);
        return view("ABM.edit", compact("student"));
    }
    
    public function update(Request $request,$student){
        $log = new Logging();
        $idUsuario =  Auth::user()->id;

        if($idUsuario !== null){
            $log->user_id = Auth::user()->id;
            $log->user_nav = $request->header('user-agent');
            $log->user_ip = $request->ip('user-agent');
            $log->user_action = "modificacion";
            $log->save();
        }

        $request->validate([
            "dni"=>"required",
            "name"=>"required",
            "lastName"=>"required",
            "birthDate"=>"required",
            "year"=>"required",
            "division"=>"required"
        ]);
        
        $students = Student::find($student);
       
        $students->dni = $request->dni;
        $students->name = $request->name;
        $students->lastName = $request->lastName;
        $students->birthDate = $request->birthDate;
        $student->year = $request->year;
        $students->division = $request->division;

        $students->save();

        return redirect()->route("student.menu", $student);
    }

    public function destroy(Request $request,$id){
        $log = new Logging();
        $idUsuario =  Auth::user()->id;

        if($idUsuario !== null){
            $log->user_id = Auth::user()->id;
            $log->user_nav = $request->header('user-agent');
            $log->user_ip = $request->ip('user-agent');
            $log->user_action = "baja";
            $log->save();
        } 

        $student = Student::find($id);
        $student->delete();
        return redirect()->route("student.menu");
    }
    
    public function addAssist(Request $request){
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $assist = new Assist();
        $dia_actual = Carbon::now()->format("Y-m-d");
        $comparacion = Assist::where("student_ida",$request->id)->max("created_at");
        $dia_asistencia = Str::substr($comparacion,0,-9);

        if($dia_actual !== $dia_asistencia){
            $assist->student_ida = $request->id;
            $assist->save();
            return redirect()->route("student.menu")->with(["success"=>"¡Se cargó la asistencia del alumno exitosamente!"]);
        } else{
                return redirect()->route("student.index")->with(["error2"=>"Ya se cargó anteriormente la asistencia al alumno"]);
              } 
    }
    
    public function assistList($id){
        $student_assist = Assist::select("created_at")->where("student_ida",$id)->get();
        return view("ABM.assistList",compact("student_assist"));
    }

    public function studentIndex(){
        return view("studentIndex");
    }

    public function findStudent(Request $request){
        $student = Student::where("dni",$request->dni)->get();
        if(count($student) !== 0){
            return view("studentFind",compact("student"));
        } else{
            return redirect()->route("student.index")->with(["error"=>"El dni del alumno que ingresaste no existe"]);
        }
    }

    public function settings(){
        return view("settings");
    }

    public function notas($id){
        return view("notas",compact("id"));
    }

    public function subirNotas(Request $request){
        $notas = new Nota();

        $request->validate([
            "id"=>"required",
            "nota1"=>"required",
            "nota2"=>"required",
            "nota3"=>"required"
        ]);

        $notas->student_idn = $request->id;
        $notas->nota1 = $request->nota1;
        $notas->nota2 = $request->nota2;
        $notas->nota3 = $request->nota3;
        $notas->prom = ($request->nota1+$request->nota2+$request->nota3)/3;
        $notas->save(); 

        return redirect()->route("student.menu");
    }        

    public function setting(){
        return view("settings");
    }      

    public function addSettings(Setting $setting,Request $request){
        
            $settings = Setting::first();

            if($settings == null){
                $settings = new Setting();

                $request -> validate([
                    "dias_clases" => "required",
                    "promedio_promocion" => "required",
                    "promedio_regularidad" => "required",
                    "edad_minima" => "required"
                ]);
        
                $settings->dias_clases = $request->dias_clases;
                $settings->promedio_promocion = $request->promedio_promocion;
                $settings->promedio_regularidad = $request->promedio_regularidad;
                $settings->edad_minima = $request->edad_minima;
        
                $settings->save();
        
                return redirect()->route("student.settings")->with(["success"=>"¡Se cargó la configuración!"]);
            }else if($settings !== null){

                $request -> validate([
                    "dias_clases" => "required",
                    "promedio_promocion" => "required",
                    "promedio_regularidad" => "required",
                    "edad_minima" => "required"
                ]);
                
                $settings->dias_clases = $request->dias_clases;
                $settings->promedio_promocion = $request->promedio_promocion;
                $settings->promedio_regularidad = $request->promedio_regularidad;
                $settings->edad_minima = $request->edad_minima;
        
                $settings->save();
        
                return redirect()->route("student.settings")->with(["success"=>"¡Se actualizó la configuración!"]);
            }
    }      

    public function condition($id){
        $studentAssist = Assist::where("student_ida",$id)->count();

        $diasClases = Setting::select("dias_clases")->first();

        $assistPercentage = round(($studentAssist * 100) / $diasClases->dias_clases);
       
        return view("studentCondition",compact("assistPercentage"));
    }            
}