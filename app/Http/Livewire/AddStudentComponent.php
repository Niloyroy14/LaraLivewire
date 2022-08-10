<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;

class AddStudentComponent extends Component
{
 
    public $name,$email,$phone;

    public function updated($propertyName){
        $this->validateOnly($propertyName, [
            'name' => 'required|min:6|unique:students',
            'email' => 'required|email',
            'phone' => 'required|numeric|unique:students'
        ]);
    }


    public function storeStudent(){
         $validatedData= $this->validate([
            'name' => 'required|min:6|unique:students',
            'email' => 'required|email',
            'phone'=> 'required|numeric|unique:students'
        ]);
        
         $data['name']= $this->name;
         $data['email'] = $this->email;
         $data['phone'] = $this->phone;
         $data['status'] = 1;

        //Student::create($validatedData);

        Student::create($data);
        session()->flash('message','A New Student Has Added Succesfully');

        //clear the input field

        $this->name ='';
        $this->email='';
        $this->phone ='';
         
        return redirect()->route('list.students');
    }


    public function render()
    {
        return view('livewire.add-student-component');
    }
}
