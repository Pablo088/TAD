<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;

use App\Models\Assist;

class StudentController extends Controller
{
    public function index(){
        $student = Student::All();
        return view("student",compact("student"));
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
    public function addAssist($id){
        $assist = new Assist();
        $student = Student::find($id);
        $assist->student_id = $student->id;
        $assist->save();
        return redirect()->route("student.index");
    }
    public function assistList($id){
        $student_assist = Assist::select("created_at")->where("student_id",$id)->get();
        return view("ABM.assistList",compact("student_assist"));
    }
}