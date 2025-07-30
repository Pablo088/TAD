<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function StudentAssists(){
        return $this->hasMany(StudentAssist::class,"student_ida","id");
    }
    
    public function StudentCareer(){
        return $this->hasOne(StudentCareer::class,"student_id","id");
    }
}
