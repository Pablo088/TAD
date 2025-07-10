<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;

class StudentListComponent extends Component
{
    public $search;
    public $yearFilter;
    public $divisionFilter;

    public function recargar(){
        $this->reset();
    }
    
    public function render()
    {   
        $student = Student::select("students.id","dni","name","birthDate","students.year","division","career")
        ->join("divisions","divisions.student_idd","=","students.id");
        
        if($this->search){
            $student->where("name","LIKE","%$this->search%");
        }

        if($this->yearFilter){
            $student->where("students.year",$this->yearFilter);
        }
        //dd($student);
        if($this->divisionFilter){
            $student->where("division",$this->divisionFilter);
        }
        
        $student = $student->paginate(10);

        return view('livewire.student-list-component',compact("student"));
    }
}
