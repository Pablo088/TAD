<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get("details",[ProductController::class,"details"]);
Route::get("product/{id}",[ProductController::class,"product"]);

Route::resource('products', ProductController::class);

Route::controller(StudentController::class)->group(function(){
    Route::get("student","index")->name("student.index");

    Route::get("student/new","new")->name("student.new");
    
    Route::post("student/new/add","add")->name("student.add");
    
    Route::get("student/{id}/edit","edit")->name("student.edit");
    
    Route::put("student/{id}","update")->name("student.update");
    
    Route::delete("student/{id}","destroy")->name("student.destroy");

    Route::get("student/{id}/assists","studentAssists")->name("student.assists");
});