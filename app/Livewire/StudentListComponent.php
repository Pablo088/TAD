<?php

namespace App\Livewire;

use App\Models\Career;
use Livewire\Component;
use App\Models\Student;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class StudentListComponent extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search;
    public $yearFilter;
    public $divisionFilter;
    public $careerFilter;

    public function render()
    {   
        $careers = Career::select("id","name")->get();

        $filtersYear = Career::select("current_year")
        ->join("students_careers","careers.id","=","students_careers.career_id")
        ->where("careers.id",$this->careerFilter??1)
        ->distinct()
        ->orderBy("current_year","asc")
        ->get();

        $filtersDivision = Career::select("division")
        ->join("students_careers","careers.id","=","students_careers.career_id")
        ->where("careers.id",$this->careerFilter??1)
        ->distinct()
        ->orderBy("division","asc")
        ->get();

        $student = Student::select("students.id","dni","students.name AS student_name","birthDate","careers.name AS career_name","division","current_year")
        ->join("students_careers","students_careers.student_id","=","students.id")
        ->join("careers","students_careers.career_id","=","careers.id");
        
        if($this->search){
            $student->where("students.name","LIKE","%$this->search%")->get();
            $student->orWhere("dni","LIKE","%$this->search%");
        }

        if($this->yearFilter){
            $student->where("current_year",$this->yearFilter);
        }

        if($this->divisionFilter){
            $student->where("division",$this->divisionFilter);
        }

        if($this->careerFilter){
            $student->where("careers.id",$this->careerFilter);
        }

        $student = $student->paginate(10);

        return view('livewire.student-list-component',compact("student","careers","filtersYear","filtersDivision"));
    }
}
