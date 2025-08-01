<?php

namespace App\Http\Controllers;

use App\Models\Career;

use Illuminate\Http\Request;

use App\Models\Student;

use Illuminate\Support\Str;

use App\Models\StudentAssist;

use Carbon\Carbon;

use App\Models\Setting;

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
        $students = Student::select("students.id AS student_id","career_id","students.id AS student_id","dni","birthDate","students.name AS student_name","division","current_year","careers.name AS career_name")
        ->join("careers","careers.id","=","students.career_id")
        ->where("students.id",$student)
        ->get()->toArray();
        
        $careers = Career::select("id","name")->where("name","!=",$students[0]["career_name"])->get();
        
        return view("student.ABM.edit", compact("students","careers"));
    }

    public function info($id){
        $studentAssist = StudentAssist::where("student_ida",$id)->count();

        $diasClases = Setting::select("dias_clases")->first();

        $assistPercentage = round(($studentAssist * 100) / $diasClases->dias_clases);

        $student = StudentAssist::select("student_assists.created_at","name")
        ->join("students","students.id","=","student_assists.student_ida")
        ->where("student_ida",$id)
        ->paginate(10);
       
        return view("student.studentInfo",compact("assistPercentage","student"));
    }         
 
    public function filter(Request $request){

        $student = Student::where("students.year",$request->filter)
        ->join("divisions","students.id","=","divisions.student_idd")->get();

        return view("student.studentFilter",compact("student"));
    }

    public function add(Request $request){
        $maxCareerYears = (Career::select("total_years")
        ->where("id",$request->career)
        ->get()->toArray())[0]["total_years"];

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
            $student->career_id = $request->career;
            $student->current_year = $request->current_year;
            $student->division = $request->division;

            $student->save();
            unset($student);
        }catch(Exception $e){
            unset($student);
            return redirect()->back()->with("error","Ocurrió un error al actualizar los datos del alumno.");
        }

        return redirect()->back()->with("success","¡El alumno fue dado de alta!");
    }
    
    public function update(Request $request,$student){
        $maxCareerYears = (Career::select("total_years")
        ->where("id",$request->career)
        ->get()->toArray())[0]["total_years"];

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
            $student->career_id = $request->career;
            $student->current_year = $request->current_year;
            $student->division = $request->division;

            $student->save();
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
            return redirect()->route("student.list")->with("error","Ocurrió un error al intentar eliminar al alumno. ".$e);
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
            $notas = new Student();
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
}