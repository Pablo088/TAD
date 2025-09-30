<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Str;
use App\Models\StudentAssist;
use Carbon\Carbon;
use App\Models\Setting;
use App\Models\StudentCareer;
use App\Models\StudentNote;
use Exception;

class StudentController extends Controller
{
    public function list(){
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $dia_actual = Carbon::now()->format("-m-d");
        
        $cumpleanios = Student::where("birthDate","LIKE","%".$dia_actual."%")
        ->select("name","birthDate")->get();
        
        return view("student.studentList",compact("cumpleanios"));
    }

    public function edit($student){
        $students = StudentCareer::select("students.id AS student_id","careers.id AS career_id","dni","birthDate","students.name AS student_name","division","current_year","careers.name AS career_name")
        ->join("students","students.id","=","students_careers.student_id")
        ->join("careers","careers.id","=","students_careers.career_id")
        ->where("students.id",$student)
        ->get()->toArray();
        
        $careers = Career::select("id","name")->where("name","!=",$students[0]["career_name"])->get();
        
        return view("student.ABM.edit", compact("students","careers"));
    }

    public function info($id){
        $studentNote = StudentNote::where("student_idn",$id)->paginate(10);
        
        $diasClases = Setting::select("dias_clases")->first();
        
        $studentAssist = StudentAssist::where("student_ida",$id)->count();
        
        $assistPercentage = round(($studentAssist * 100) / $diasClases->dias_clases);

        $student = StudentAssist::select("student_assists.created_at","name")
        ->join("students","students.id","=","student_assists.student_ida")
        ->where("student_ida",$id)
        ->paginate(10);
       
        return view("student.studentInfo",compact("assistPercentage","student","studentNote"));
    }         

    public function add(Request $request){
       $maxCareerYears = Career::maxCareerYear($request->career);

        $request->validate([
            "dni" => ["required","numeric","digits:8"],
            "name" => ["required","string","between:6,64"],
            "birthDate" => ["required","date"],
            "career" => ["required","string","career_exists"],
            "current_year" => ["required","numeric","digits:1","valid_career_year:$maxCareerYears"],
            "division" => ["required","string","size:1"]
        ]);

         try{
            $student = new Student();
            
            $student->dni = $request->dni;
            $student->name = $request->name;
            $student->birthDate = $request->birthDate;
            $student->current_year = $request->current_year;
            $student->division = $request->division;
            $student->save();
        
            $student_career = new StudentCareer();
            $student_career->student_id = $student->id;
            $student_career->career_id = $request->career;

            unset($student);
            unset($student_career);
        }catch(Exception $e){
            unset($student);
            return redirect()->back()->with("error","Ocurrió un error al actualizar los datos del alumno.");
        }

        return redirect()->back()->with("success","¡El alumno fue dado de alta!");
    }
    
    public function update(Request $request,$student){
        $maxCareerYears = Career::maxCareerYear($request->career);

        $request->validate([
            "dni" => ["required","numeric","digits:8"],
            "name" => ["required","string","between:6,64"],
            "birthDate" => ["required","date"],
            "career" => ["required","string","career_exists"],
            "current_year" => ["required","numeric","digits:1","valid_career_year:$maxCareerYears"],
            "division" => ["required","string","size:1"]
        ]);

        try{
            $student = Student::find($student);
            
            $student->dni = $request->dni;
            $student->name = $request->name;
            $student->birthDate = $request->birthDate;
            $student->current_year = $request->current_year;
            $student->division = $request->division;
            $student->save();

            $student_career = new StudentCareer();
            $student_career->student_id = $student->id;
            $student_career->career_id = $request->career;
            $student_career->save();

            unset($student_career);
            unset($student);
        }catch(Exception $e){
            unset($student);
            return redirect()->back()->with("error","Ocurrió un error al actualizar los datos del alumno.");
        }

        return redirect()->back()->with("success","¡Se actualizaron los datos del alumno!");
    }

    public function destroy($id){
        try{
            $student = Student::find($id);
            $student->delete();
            unset($student);
        } catch(Exception $e) {
            unset($student);
            return redirect()->route("student.list")->with("error","Ocurrió un error al intentar eliminar al alumno.");
        }
        
        return redirect()->route("student.list");
    }
    
    public function addAssist(Request $request){
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $assist = new StudentAssist();
        $dia_actual = Carbon::now()->format("Y-m-d");
        $comparacion = StudentAssist::where("student_ida",$request->id)->max("created_at");
        $dia_asistencia = Str::substr($comparacion,0,-9);

        if($dia_actual !== $dia_asistencia){
            $assist->student_ida = $request->id;
            $assist->save();
            return redirect()->route("student.list")->with(["success"=>"¡Se cargó la asistencia del alumno exitosamente!"]);
        } else{
            return redirect()->route("student.index")->with(["error2"=>"Ya se cargó anteriormente la asistencia al alumno"]);
        } 
    }

    public function subirNotas(Request $request){
        $request->validate([
            "nombreUnidad" => ["required","string","between:7,30"],
            "nombreParcial" => ["required","string","between:7,64"],
            "nota" => ["required","int"]
        ]);
        
        try{
            $notas = new StudentNote();
            $notas->student_idn = $request->id;
            $notas->unidad = $request->nombreUnidad;
            $notas->nombre_parcial = $request->nombreParcial;
            $notas->nota = $request->nota;
            $notas->save();
            unset($notas);
        } catch (Exception $e){
            unset($notas);
            return redirect()->back()->with("error","Ocurrió un error al cargar la nota del alumno.");
        } 

        return redirect()->back()->with("success","¡Se cargo la nota del alumno!");
    }           
}