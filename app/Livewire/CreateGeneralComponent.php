<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Career;

class CreateGeneralComponent extends Component
{
    public function render()
    {
        $careers = Career::select("id","name")->get()??null;
        return view('livewire.create-general-component',compact("careers"));
    }
}
