<?php

namespace App\Livewire;

use App\Models\Career;
use Livewire\Component;
use App\Models\StudentCareer;

class StudentListComponent extends Component
{
    public $search;
    public $yearFilter;
    public $divisionFilter;
    public $careerFilter;

    public function render()
    {   
        $careers = Career::select("name")->get();

        $student = StudentCareer::select("students.id","dni","students.name AS student_name","birthDate","careers.name AS career_name","division","current_year")
        ->join("students","students_careers.student_idc","=","students.id")
        ->join("careers","students_careers.career_idc","=","careers.id");
        
        if($this->search){
            $student->where("students.name","LIKE","%$this->search%");
            $student->orWhere("dni","LIKE","%$this->search%");
        }

        if($this->yearFilter){
            $student->where("current_year",$this->yearFilter);
        }

        if($this->divisionFilter){
            $student->where("division",$this->divisionFilter);
        }

         if($this->careerFilter){
            $student->where("careers.name",$this->careerFilter);
        }
        
        $student = $student->paginate(10);

        return view('livewire.student-list-component',compact("student","careers"));
    }
}
