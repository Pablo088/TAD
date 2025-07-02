<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Student;

use Illuminate\Support\Facades\Db;


class PdfController extends Controller
{
    public function pdf(){
        $student = Student::All();
        $pdf = Pdf::loadView('list', compact("student"));
        return $pdf->stream('list.pdf');
    }
    public function reportFilter(){
        $student = Student::select("dni","name","lastName","birthDate","division","prom",Db::raw("count(assists.created_at) as assist"))
                        ->groupBy("students.id","notas.student_idn","prom")                
                        ->join("notas","students.id","=","notas.student_idn")
                        ->join("assists","students.id","=","assists.student_ida")
                        ->where("prom",">=",6) 
                        ->having(Db::raw("count(assists.created_at)"),">=",6)
                        ->get();
        dd($student);
        $pdf = Pdf::loadView('report', compact("student"));
        
        return $pdf->stream('report.pdf');
    }
}
