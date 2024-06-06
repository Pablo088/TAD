<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Student;


class PdfController extends Controller
{
    public function pdf(){
        $student = Student::All();
        $pdf = Pdf::loadView('list', compact("student"));
        return $pdf->stream('list.pdf');
    }
}
