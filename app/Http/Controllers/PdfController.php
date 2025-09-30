<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\StudentAssist;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\StudentCareer;
use \Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
    public function report(Request $request){
        $dias_clases = (Setting::getSettings())["dias_clases"];
        $careerName = $request->career;
        $divisionName = $request->division;
        $current_year = $request->current_year;
        $msjAsistencia = "";
        
        $student = StudentCareer::select("dni","students.name AS student_name","careers.name", DB::raw("count('student_assists.student_id') AS asistencias"))
        ->join("students","students_careers.student_id","=","students.id")
        ->join("careers","students_careers.career_id","=","careers.id");

        //Bloque donde se maneja el select de porcentaje de asistencia
        if(isset($request->porcAsistencia) && $request->porcAsistencia != 0){
            $student = $student->join("student_assists","students_careers.student_id","=","student_assists.student_ida");
         
            switch($request->porcAsistencia){
                case 1: 
                    $msjAsistencia = "Reporte de alumnos con un porcentaje de asistencias mayor o igual al 80%";
                    $student = $student->having((DB::raw("(count('student_assists.student_id') * 100) / $dias_clases")),">=",80);
                break;
                case 2:
                    $msjAsistencia = "Reporte de alumnos con un porcentaje de asistencias mayor o igual al 60%";
                    $student = $student->having((DB::raw("(count('student_assists.student_id') * 100) / $dias_clases")),">=",60)
                    ->having((DB::raw("(count('student_assists.student_id') * 100) / $dias_clases")),"<",80);
                break;
                case 3: 
                    $msjAsistencia = "Reporte de alumnos con un porcentaje de asistencias menor al 60%";
                    $student = $student->having((DB::raw("(count('student_assists.student_id') * 100) / $dias_clases")),"<",60);
                break;
                case 4: 
                    $msjAsistencia = "Reporte total de asistencias de alumnos";
                    continue;
                break;
            }
        }

        //Bloque donde se maneja el select del promedio de promocion
        if(isset($request->promNotas) && $request->promnNotas != 0){
            $student = $student->join("student_assists","students_careers.student_id","=","student_assists.student_ida")
            ->having((DB::raw("(count('student_assists.student_id') * 100) / $dias_clases")),">=",80);
        }

        //Bloque donde se maneja el select de condicion general
        if(isset($request->condGeneral) && $request->condGeneral != 0){
            $student = $student->join("student_assists","students_careers.student_id","=","student_assists.student_ida")
            ->having((DB::raw("(count('student_assists.student_id') * 100) / $dias_clases")),">=",80);
        }

        $student = $student->where("careers.name",$careerName)
        ->where("students.division",$divisionName) 
        ->where("students.current_year",$current_year)
        ->groupBy("students.id")
        ->get();
        
        //dd($student);

        $pdf = Pdf::loadView('student.report',compact("student","careerName","divisionName","current_year","msjAsistencia"));
        
        return $pdf->stream('report.pdf');
    }
}