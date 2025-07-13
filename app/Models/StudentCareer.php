<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCareer extends Model
{
    use HasFactory;

    protected $table = "students_careers";

    public function student(){
        return $this->belongsTo(Student::class,'student_idc','id');
    }
    public function career(){
        return $this->belongsTo(Career::class,'career_idc','id');
    }
}
