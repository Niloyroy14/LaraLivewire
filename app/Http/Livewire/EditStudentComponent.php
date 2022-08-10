<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;

class EditStudentComponent extends Component
{
    public $edit_id, $name, $email, $phone;

    public function mount($id){
        
       $student = Student::find($id);

        $this->name = $student->name;
        $this->email = $student->email;
        $this->phone = $student->phone;
        $this->edit_id = $student->id;  
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'name' => 'required|min:6|unique:students',
            'email' => 'required|email',
            'phone' => 'required|numeric|unique:students'
        ]);
    }

    public function updateStudent()
    {
        $validatedData = $this->validate([
            'name' => 'required|min:6|unique:students,id,'.$this->edit_id,
            'email' => 'required|email',
            'phone' => 'required|numeric|unique:students,id,'.$this->edit_id
        ]);

        $data['name'] = $this->name;
        $data['email'] = $this->email;
        $data['phone'] = $this->phone;
        $data['status'] = 1;

        Student::where('id', $this->edit_id)->update($data);
        session()->flash('message', 'Student Has Updated Succesfully');

        return redirect()->route('list.students');
    }
    public function render()
    {
        return view('livewire.edit-student-component');
    }
}
