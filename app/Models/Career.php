<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    public function StudentCareer(){
        return $this->hasMany(StudentCareer::class,"career_id","id");
    }

    public static function maxCareerYear($career){
         $maxCareerYears = (Career::select("total_years")
        ->where("id",$career)
        ->get()->toArray())[0]["total_years"];

        return $maxCareerYears;
    }
}
