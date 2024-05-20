<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;

use App\Models\Assist;

use Carbon\Carbon;

use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function menu(){
        $student = Student::All();
        return view("studentMenu",compact("student"));
    }
    public function new(){
        return view("ABM.add");
    }
    public function add(Request $request){
        $request->validate([
            "dni"=>"required",
            "name"=>"required",
            "lastName"=>"required",
            "birthDate"=>"required",
            "group"=>"required"
        ]);
        
        $student = new Student();

        $student->dni = $request->dni;
        $student->name = $request->name;
        $student->lastName = $request->lastName;
        $student->birthDate = $request->birthDate;
        $student->group = $request->group;

        $student->save();

        return redirect()->route("student.new");
    }
    public function edit($id){
        $student = Student::find($id);
        return view("ABM.edit", compact("student"));
    }
    public function update(Request $request,$student){
        $request->validate([
            "dni"=>"required",
            "name"=>"required",
            "lastName"=>"required",
            "birthDate"=>"required",
            "group"=>"required"
        ]);
        
        $students = Student::find($student);
       
        $students->dni = $request->dni;
        $students->name = $request->name;
        $students->lastName = $request->lastName;
        $students->birthDate = $request->birthDate;
        $student->group = $request->group;

        $students->save();

        return redirect()->route("student.index", $student);
    }
    public function destroy($id){
        $student = Student::find($id);
        $student->delete();
        return redirect()->route("student.index");
    }
    public function addAssist(Request $request){
        $assist = new Assist();
        $dia_actual = date("Y-m-d");
        $comparacion = Assist::where("student_id",$request->id)->max("created_at");
        $dia_asistencia = Str::substr($comparacion,0,-9);
        if($dia_actual !== $dia_asistencia){
            $assist->student_id = $request->id;
            $assist->save();
            return redirect()->route("student.menu")->with(["success"=>"¡Se cargó la asistencia del alumno exitosamente!"]);
        } else{
            return redirect()->route("student.index")->with(["error2"=>"Ya se cargó anteriormente la asistencia al alumno"]);
        }
       
    }
    public function assistList($id){
        $student_assist = Assist::select("created_at")->where("student_id",$id)->get();
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
}