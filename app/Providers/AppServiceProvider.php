<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use App\Models\Career;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        FacadesValidator::extend("valid_career_year",function($attribute,$value,$parameters,$validator){
            
            $maxYears = $parameters[0] ?? null;
            return ($value <= $maxYears) ? true : false;
        });
        
        FacadesValidator::replacer("valid_career_year",function($message,$attribute,$rule,$parameters){
            return str_replace([":attribute",":years"],[$attribute,$parameters[0]],$message);    
        });

        FacadesValidator::extend("career_exists",function($value){
            $career = Career::where("name",$value);
            return ($career != null) ? true : false;
        });

        FacadesValidator::replacer("career_exists",function($message,$attribute,$rule,$parameters){
            return str_replace([":attribute"],$attribute,$message);
        });
    }
}