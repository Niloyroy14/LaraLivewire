<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;

class IndexStudentComponent extends Component
{
    public function render()
    {
        $students = Student::where('status',1)->get();
        return view('livewire.index-student-component',compact('students'));
    }
}
