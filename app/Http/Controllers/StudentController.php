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
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class StudentController extends Controller
{
    public function studentIndex(){
        return view("studentIndex");
    }

    public function list(){
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $dia_actual = Carbon::now()->format("-m-d");
        
        $student = Student::select("students.id","dni","name","lastName","birthDate","students.year","division")
        ->join("divisions","divisions.student_idd","=","students.id")->paginate(10);
        
        $cumpleanios = Student::where("birthDate","LIKE","%".$dia_actual."%")
        ->select("name","lastName","birthDate")->get();
        
        //dd($student);

        return view("student.studentList",compact("student","cumpleanios"));
    }

     public function new(){
        return view("student.ABM.add");
    }

    public function edit($id){
        $student = Student::find($id);
        return view("student.ABM.edit", compact("student"));
    }

    public function notas($id){
        return view("student.notas",compact("id"));
    }

    public function info($id){
        $studentAssist = Assist::where("student_ida",$id)->count();

        $diasClases = Setting::select("dias_clases")->first();

        $assistPercentage = round(($studentAssist * 100) / $diasClases->dias_clases);

        $student_assist = Assist::select("created_at")->where("student_ida",$id)->get();
       
        return view("student.studentInfo",compact("assistPercentage","student_assist"));
    }      

    public function settings(Setting $settings){
        $settings = Setting::first();
        //dd($settings);
        return view("settings",compact("settings"));
    }   
 
    public function filter(Request $request){

        $student = Student::where("students.year",$request->filter)
        ->join("divisions","students.id","=","divisions.student_idd")->get();

        return view("student.studentFilter",compact("student"));
    }

    public function add(Request $request){
        $log = new Logging();
        $idUsuario =  Auth::user()->id??null;

        if($idUsuario !== null){
            $log->user_id = $idUsuario;
            $log->user_nav = $request->header('user-agent');
            $log->user_ip = $request->ip('user-agent');
            $log->user_action = "alta";
            $log->save();
        }

        $request->validate([
            "dni"=> ["required","int"],
            "name"=> ["required","string"],
            "lastName"=> ["required","string"],
            "birthDate"=> ["required","date"],
            "year"=> ["required","string"],
            "division"=> ["required","string"]
        ]);

        //bloque para validar si el alumno ya existe
        $studentExist = Student::where("dni",$request->dni)->get();

        if($studentExist !== null){
            return redirect()->back()->with("error","Ya existe un alumno con este dni");
        }
    
        try{
            $student = new Student();

            $student->dni = $request->dni;
            $student->name = $request->name;
            $student->lastName = $request->lastName;
            $student->birthDate = $request->birthDate;
            $student->year = $request->year;
            $student->division = $request->division;

            $student->save();
            unset($student);
        } catch (Exception $e){
            unset($student);
            return redirect()->back()->with("error","Ocurrio un error al intentar dar de alta al alumno. ",$e);
        }    

        return redirect()->back()->with("success","¡El alumno fue dado de alta!");
    }
    
    public function update(Request $request,$student){
        $log = new Logging();
        $idUsuario = Auth::user()->id??null;

        if($idUsuario !== null){
            $log->user_id = Auth::user()->id;
            $log->user_nav = $request->header('user-agent');
            $log->user_ip = $request->ip('user-agent');
            $log->user_action = "modificacion";
            $log->save();
        }

        $request->validate([
            "dni" => ["required","int"],
            "name" => ["required","string"],
            "lastName" => ["required","string"],
            "birthDate" => ["required","date"],
            "year" => ["required","string"],
            "division" => ["required","string"]
        ]);

        try{
            $students = Student::find($student);
            //dd($request);
            
            $students->dni = $request->dni;
            $students->name = $request->name;
            $students->lastName = $request->lastName;
            $students->birthDate = $request->birthDate;
            $students->year = $request->year;
            $students->division = $request->division;

            $students->save();
            unset($students);
        } catch(Exception $e){
            unset($students);
            return redirect()->route("student.edit")->with("error","Ocurrio un error al intentar actualizar al alumno. ",$e);
        }

        return redirect()->back()->with("success","¡Se actualizaron los datos del alumno!");
    }

    public function destroy(Request $request,$id){
        $log = new Logging();
        $idUsuario =  Auth::user()->id??null;

        if($idUsuario !== null){
            $log->user_id = Auth::user()->id;
            $log->user_nav = $request->header('user-agent');
            $log->user_ip = $request->ip('user-agent');
            $log->user_action = "baja";
            $log->save();
        } 

        try{
            $student = Student::find($id);
            $student->delete();
            unset($student);
        } catch(Exception $e) {
            unset($student);
            return redirect()->route("student.list")->with("error","Ocurrió un error al intentar eliminar al alumno. ".$e);
        }
        
        return redirect()->route("student.list");
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
            return redirect()->route("student.list")->with(["success"=>"¡Se cargó la asistencia del alumno exitosamente!"]);
        } else{
            return redirect()->route("student.index")->with(["error2"=>"Ya se cargó anteriormente la asistencia al alumno"]);
        } 
    }

    public function findStudent(Request $request){
        $student = Student::where("dni",$request->dni)->get();
        if(count($student) !== 0){
            return view("studentFind",compact("student"));
        } else{
            return redirect()->route("student.index")->with(["error"=>"El dni del alumno que ingresaste no existe"]);
        }
    }

    public function subirNotas(Request $request){
        $request->validate([
            "nota1" => ["required","int"],
            "nota2" => ["required","int"],
            "nota3" => ["required","int"]
        ]);
        
        try{
            $notas = new Nota();
            $notas->student_idn = $request->id;
            $notas->nota1 = $request->nota1;
            $notas->nota2 = $request->nota2;
            $notas->nota3 = $request->nota3;
            $notas->prom = ($request->nota1+$request->nota2+$request->nota3)/3;
            $notas->save();
            unset($notas);
        } catch (Exception $e){
            unset($notas);
            return redirect()->back()->with("error","Ocurrió un error al cargar las notas del alumno. ".$e);
        } 

        return redirect()->back()->with("success","¡Se cargaron las notas del alumno!");
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