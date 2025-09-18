<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Career;
use App\Models\Student;
use App\Models\StudentAssist;

class StudentIndexComponent extends Component
{
    public $search;
    public $yearFilter;
    public $divisionFilter;
    public $careerFilter;
    public $studentAssisted = [];

    public function filter(){

        $careers = Career::select("id","name")->get();

        $student = Student::select("students.id AS student_id","students.name AS student_name","careers.name AS career_name","division","current_year")
        ->join("students_careers","students_careers.student_id","=","students.id")
        ->join("careers","students_careers.career_id","=","careers.id")
        ->where("careers.id",$this->careerFilter??1);
        
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

        if($this->yearFilter){
            $student->where("current_year",$this->yearFilter);
        }

        if($this->divisionFilter){
            $student->where("division",$this->divisionFilter);
        }

         if($this->search != null){
            $student->orWhere("students.name","LIKE","%$this->search%"); 
        }
       
        $student = $student->paginate(10);

        return [$student,$careers,$filtersYear,$filtersDivision];
    }

    public function render(){
        $filters = $this->filter();
        $student = $filters[0];
        $careers = $filters[1];
        $filtersYear = $filters[2];
        $filtersDivision = $filters[3];

        return view('livewire.student-index-component',compact("careers","student",'filtersYear','filtersDivision'));
    }

    public function selectAll(){
        $student = ($this->filter())[0];
        
        if(count($this->studentAssisted) == 0){
            foreach($student as $students){
                array_push($this->studentAssisted,["student_id"=>$students->student_id,"checked" => true]);
            }
        }else{
            for($i = 0; $i < count($this->studentAssisted); $i++){     
                ($this->studentAssisted[$i]["checked"] == false) ? $this->studentAssisted[$i]['checked'] = true : $this->studentAssisted[$i]['checked'] = false;
            }
        }

    }

    public function giveAssist($value){
        if(count($this->studentAssisted) == 0){
            $this->studentAssisted += ["student_id" => $value,"checked" => true];
        }else{
            for($i = 0; $i < count($this->studentAssisted); $i++){
                if($this->studentAssisted[$i]['student_id'] == $value && $this->studentAssisted[$i]['checked'] == false){
                    $this->studentAssisted[$i]['checked'] = true;
                    break;
                }else if($this->studentAssisted[$i]['student_id'] == $value && $this->studentAssisted[$i]['checked'] == true){
                    $this->studentAssisted[$i]['checked'] = false;
                    break;
                }
            }
        }
    }

    public function sendAssist(){            
         for($i = 0; $i < count($this->studentAssisted); $i++){
            if($this->studentAssisted[$i]['checked'] == true){
                $student_assist = new StudentAssist();
                $student_assist->student_ida = $this->studentAssisted[$i]['student_id'];
                $student_assist->save();
            }   
        }
        
        return redirect()->back()->with("success","¡Se agregaron las asistencias!");
    }
}
