<?php

use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\SettingController;
use App\Models\Career;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(StudentController::class)->group(function(){
    Route::get("/",function(){
        return view("studentIndex");
    })->name("student.index");

    Route::get("student/find","findStudent")->name("student.find");

    Route::get("student/list","list")->name("student.list");

    Route::get("student/new",function(){
        $careers = Career::all();
        return view("student.ABM.add",compact("careers"));
    })->name("student.new");

     Route::get("student/new/general",function(){
        return view("student.ABM.createGeneral");
    })->name("student.create.general");
    
    Route::post("student/new/add","add")->name("student.add");
    
    Route::get("student/edit/{id}","edit")->name("student.edit");
    
    Route::put("student/edit/update/{id}","update")->name("student.update");
    
    Route::delete("student/destroy/{id}","destroy")->name("student.destroy");

    Route::post("student/addAssist","addAssist")->name("student.addAssist");

    Route::get("student/{id}/nota",function($id){
        return view("student.notas",compact("id"));
    })->name("student.notas");

    Route::post("student/nota/subir","subirNotas")->name("subirNotas");

    Route::get("student/info/{id}","info")->name("student.info");
});

Route::controller(CareerController::class)->group(function(){       
    Route::put("create/career/add","add")->name("create.career.add");
});

Route::controller(SettingController::class)->group(function(){
    Route::get("student/settings","settings")->name("student.settings");
       
    Route::put("student/settings/add","addSettings")->name("student.addSettings");
});

Route::controller(PdfController::class)->group(function(){
    Route::get("pdf/report/filter","reportFilter")->name("report.pdf");
});