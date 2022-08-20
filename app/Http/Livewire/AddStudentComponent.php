<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;
use Livewire\WithFileUploads;

class AddStudentComponent extends Component
{
    use WithFileUploads;
 
    public $name,$email,$phone,$photo;

    public function updated($propertyName){
        $this->validateOnly($propertyName, [
            'name' => 'required|min:6|unique:students',
            'email' => 'required|email',
            'phone' => 'required|numeric|unique:students',
            'photo' => 'image|nullable|max:1024', // 1MB Max
        ]);
    }


    public function storeStudent(){
         $validatedData= $this->validate([
            'name' => 'required|min:6|unique:students',
            'email' => 'required|email',
            'phone'=> 'required|numeric|unique:students',
            'photo' => 'image|nullable|max:1024', // 1MB Max
        ]);

        //image upload
        if(!is_null($this->photo)){
            $imageName = time() . '.' . $this->photo->extension();
            $this->photo->storeAs('student', $imageName);
            $data['photo'] = $imageName;
        }
        
         $data['name']= $this->name;
         $data['email'] = $this->email;
         $data['phone'] = $this->phone;
         $data['status'] = 1;

        //Student::create($validatedData);
        //dd($data);
        Student::create($data);
        session()->flash('message','A New Student Has Added Succesfully');

        //clear the input field

        $this->name ='';
        $this->email='';
        $this->phone ='';
        $this->photo ='';
        return redirect()->route('list.students');
    }


    public function render()
    {
        return view('livewire.add-student-component');
    }
}
