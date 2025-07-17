<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Career;
use App\Models\Student;

class StudentIndexComponent extends Component
{
    public $search;
    public $yearFilter;
    public $divisionFilter;
    public $careerFilter;
    
    public function render()
    {
        $careers = Career::select("id","name")->get();

        $student = Student::select("students.id","dni","students.name AS student_name","careers.name AS career_name","division","current_year")
        ->join("careers","students.career_id","=","careers.id");
        
        if($this->search){
            $student->where("students.name","LIKE","%$this->search%")->get();
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

        return view('livewire.student-index-component',compact("careers","student"));
    }
}
