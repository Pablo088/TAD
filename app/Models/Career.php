<?php

namespace App\Models;

use App\Traits\RegExTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;
    use RegExTrait;

    public function StudentCareer(){
        return $this->hasMany(StudentCareer::class,"career_id","id");
    }

    public static function maxCareerYear($career){
        self::sinCaracteresEspeciales($career);

        $maxCareerYears = (Career::select("total_years")
        ->where("name",$career)
        ->get()->toArray())[0]["total_years"];

        return $maxCareerYears;
    }
}
