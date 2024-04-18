<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;

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
            "birthDate"=>"required"
        ]);
        
        $student = new Student();

        $student->dni = $request->dni;
        $student->name = $request->name;
        $student->lastName = $request->lastName;
        $student->birthDate = $request->birthDate;

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
            "birthDate"=>"required"
        ]);
        
        $students = Student::find($student);
       
        $students->dni = $request->dni;
        $students->name = $request->name;
        $students->lastName = $request->lastName;
        $students->birthDate = $request->birthDate;

        $students->save();

        return redirect()->route("student.index", $student);
    }
    public function destroy($id){
        $student = Student::find($id);
        $student->delete();
        return redirect()->route("student.index");
    }
}