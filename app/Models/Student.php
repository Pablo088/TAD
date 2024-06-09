<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function assists(){
        return $this->hasMany(Assist::class,"student_ida");
    }
    public function divisions(){
        return $this->hasOne(Division::class,"student_idd");
    }
    public function notas(){
        return $this->hasOne(Nota::class,"student_idn");
    }
}
