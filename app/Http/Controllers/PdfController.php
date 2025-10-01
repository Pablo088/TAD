<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\StudentCareer;
use \Illuminate\Support\Facades\DB;
use App\Models\Career;

class PdfController extends Controller
{
    public function report(Request $request){
        $dias_clases = Setting::getSetting("dias_clases");
        $maxCareerYears = Career::maxCareerYear($request->career);
        $careerName = $request->career;
        $divisionName = $request->division;
        $current_year = $request->current_year;
        $mensaje = "";

        //Bloque para validar los inputs
        $request->validate([
            "career" => ["required","string","career_exists"],
            "current_year" => ["required","numeric","digits:1","valid_career_year:$maxCareerYears"],
            "division" => ["required","string","size:1"]
        ]);
        
        //Aca comienza la consulta sql
        $student = StudentCareer::select("dni","students.name AS student_name","careers.name");

        //Bloque donde se maneja el select de porcentaje de asistencia
        if(isset($request->porcAsistencia) && $request->porcAsistencia != 0){
            $student = StudentCareer::select("dni","students.name AS student_name","careers.name", DB::raw("count('student_assists.student_id') AS asistencias"))
            ->join("student_assists","students_careers.student_id","=","student_assists.student_ida");
         
            switch($request->porcAsistencia){
                case 1: 
                    $mensaje = " alumnos con un porcentaje de asistencias mayor o igual al 80%";
                    $student = $student->having((DB::raw("(count('student_assists.student_id') * 100) / $dias_clases")),">=",80);
                break;
                case 2:
                    $mensaje = " alumnos con un porcentaje de asistencias mayor o igual al 60%";
                    $student = $student->having((DB::raw("(count('student_assists.student_id') * 100) / $dias_clases")),">=",60)
                    ->having((DB::raw("(count('student_assists.student_id') * 100) / $dias_clases")),"<",80);
                break;
                case 3: 
                    $mensaje = " alumnos con un porcentaje de asistencias menor al 60%";
                    $student = $student->having((DB::raw("(count('student_assists.student_id') * 100) / $dias_clases")),"<",60);
                break;
                case 4: 
                    $mensaje = "Reporte total de asistencias de alumnos";
                    continue;
                break;
            }
        }

        //Bloque donde se maneja el select del promedio de promocion
        if(isset($request->promNotas) && $request->promnNotas != 0){
            $student = StudentCareer::select("dni","students.name AS student_name","careers.name", DB::raw("AVG('student_notes.nota') AS prom_notas"))
            ->join("student_notes","students_careers.student_id","=","student_notes.student_idn");
            
            switch($request->promNotas){
                case 1: 
                    $mensaje = " alumnos con un promedio mayor o igual a 8";
                    $student = $student->having(DB::raw("(AVG('student_notes.nota')"),">=",8);
                break;
                case 2:
                    $mensaje = " alumnos con un promedio mayor o igual a 6";
                    $student = $student->having(DB::raw("(AVG('student_notes.nota')"),">=",6)
                    ->having(DB::raw("(AVG('student_notes.nota')"),"<",8);
                break;
                case 3: 
                    $mensaje = " alumnos con un promedio menor a 6";
                    $student = $student->having(DB::raw("(AVG('student_notes.nota')"),"<",6);
                break;
                case 4: 
                    $mensaje = "Reporte total de promedios de alumnos";
                    continue;
                break;
            }
        }

        //Bloque donde se maneja el select de condicion general
        if(isset($request->condGeneral) && $request->condGeneral != 0){
            $student = $student->join("student_assists","students_careers.student_id","=","student_assists.student_ida")
            ->having((DB::raw("(count('student_assists.student_id') * 100) / $dias_clases")),">=",80);
        }

        $student = $student->join("students","students_careers.student_id","=","students.id")
        ->join("careers","students_careers.career_id","=","careers.id")
        ->where("careers.name",$careerName)
        ->where("students.division",$divisionName) 
        ->where("students.current_year",$current_year)
        ->groupBy("students.id")
        ->get();
        
        //dd($student);

        $pdf = Pdf::loadView('student.report',compact("student","careerName","divisionName","current_year","mensaje"));
        
        return $pdf->stream('report.pdf');
    }
}