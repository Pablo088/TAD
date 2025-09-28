<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\StudentCareer;
use \Illuminate\Support\Facades\DB;


class PdfController extends Controller
{
    public function report(Request $request){
        $careerName = $request->career;
        $divisionName = $request->division;
        $current_year = $request->current_year;

        $student = StudentCareer::select("dni","students.name AS student_name","current_year","division")
        ->join("students","students_careers.student_id","=","students.id")
        ->join("careers","students_careers.career_id","=","careers.id")
        ->where("careers.name",$careerName)
        ->where("students_careers.division",$divisionName) 
        ->where("students_careers.current_year",$current_year)
        ->get();

        if(isset($request->porcAsistencia) && $request->porcAsistencia != null){
            //dd("estamos pa");
        }
        dd($request->porcAsistencia);
        $pdf = Pdf::loadView('student.report',compact("student","careerName","divisionName","current_year"));
        
        return $pdf->stream('report.pdf');
    }
}
