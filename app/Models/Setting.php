<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public static function getSettings(){
        $settings = (self::select("dias_clases","promedio_promocion","promedio_regularidad","edad_minima")->get()->toArray())[0];
        return $settings;    
    }
}
