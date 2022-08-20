<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class EditStudentComponent extends Component
{
    use WithFileUploads;
    public $edit_id, $name, $email, $phone,$photo,$old_photo;

    public function mount($id){
        
       $student = Student::find($id);

        $this->name = $student->name;
        $this->email = $student->email;
        $this->phone = $student->phone;
        $this->old_photo = $student->photo;
        $this->edit_id = $student->id;  
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'name' => 'required|min:6|unique:students,id,' . $this->edit_id,
            'email' => 'required|email',
            'phone' => 'required|numeric|unique:students,id,' . $this->edit_id,
            'photo' => 'image|nullable|max:1024', // 1MB Max
        ]);
    }

    public function updateStudent()
    {
        $validatedData = $this->validate([
            'name' => 'required|min:6|unique:students,id,'.$this->edit_id,
            'email' => 'required|email',
            'phone' => 'required|numeric|unique:students,id,'.$this->edit_id,
            'photo' => 'image|nullable|max:1024', // 1MB Max
        ]);


       $student =  Student::find($this->edit_id);

        //new image upload
        if (($this->photo != '') && ($this->photo != null)) {

            //delete the old image from the folder
            if (File::exists('uploads/student/' . $student->photo)) {
                File::delete('uploads/student/' . $student->photo);
            }

             //then upload new image
            $imageName = time() . '.' . $this->photo->extension();
            $this->photo->storeAs('student', $imageName);
            // $data['photo'] = $imageName;
            $student->photo = $imageName;
        }

        // $data['name'] = $this->name;
        // $data['email'] = $this->email;
        // $data['phone'] = $this->phone;
        // $data['status'] = 1;

        // Student::where('id', $this->edit_id)->update($data);

        $student->name = $this->name;
        $student->email  = $this->email;
        $student->phone  = $this->phone;
        $student->status  =1;
        $student->save();

        session()->flash('message', 'Student Has Updated Succesfully');

        return redirect()->route('list.students');
    }
    public function render()
    {
        return view('livewire.edit-student-component');
    }
}
