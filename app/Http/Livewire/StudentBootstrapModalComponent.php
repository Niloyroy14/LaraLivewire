<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;


class StudentBootstrapModalComponent extends Component
{
    public $searchItem;

    use WithFileUploads;

    public $name, $email, $phone, $photo, $old_photo, $edit_student_id, $delete_student_id;
    public $view_student_id, $view_name,$view_email, $view_phone, $view_photo;


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'name' => 'required|min:6|unique:students,id,' . $this->edit_student_id,
            'email' => 'required|email',
            'phone' => 'required|numeric|unique:students',
            'photo' => 'image|nullable|max:1024', // 1MB Max
        ]);
    }

    public function addStudentModal(){
        $this->resetInput();
        $this->dispatchBrowserEvent('show-add-student-modal');
    }


    public function storeStudent()
    {
        $validatedData = $this->validate([
            'name' => 'required|min:6|unique:students',
            'email' => 'required|email',
            'phone' => 'required|numeric|unique:students',
            'photo' => 'image|nullable|max:1024', // 1MB Max
        ]);

        //image upload
        if (!is_null($this->photo)) {
            $imageName = time() . '.' . $this->photo->extension();
            $this->photo->storeAs('student', $imageName);
            $data['photo'] = $imageName;
        }

        $data['name'] = $this->name;
        $data['email'] = $this->email;
        $data['phone'] = $this->phone;
        $data['status'] = 1;

        //Student::create($validatedData);
        //dd($data);
        Student::create($data);
        session()->flash('message', 'A New Student Has Added Succesfully');

        //clear the input field

        $this->resetInput();
       
        $this->dispatchBrowserEvent('close-modal');
    }



    public function resetInput()
    {
        $this->edit_student_id = '';
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->photo = '';
        $this->old_photo = '';
    }


    public function viewStudentDetails($id){

         $student = Student::find($id);
         $this->view_student_id = $student->id;
         $this->view_name = $student->name;
         $this->view_email = $student->email;
         $this->view_phone = $student->phone;
         $this->view_photo = $student->photo;

        $this->dispatchBrowserEvent('show-view-student-modal');
         
    }


    

    function closeViewStudentModal(){

        $this->view_student_id = '';
        $this->view_name = '';
        $this->view_email = '';
        $this->view_phone = '';
        $this->view_photo = '';

    }


    public function EditStudent($id){

        $this->resetInput();
        
        $student = Student::find($id);

        $this->edit_student_id = $student->id;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->phone = $student->phone;
        $this->old_photo = $student->photo;

        $this->dispatchBrowserEvent('show-edit-student-modal');

    }



    public function closeEditModal(){
        $this->resetInput();
    }

    public function updateStudent()
    {
        $validatedData = $this->validate([
            'name' => 'required|min:6|unique:students,id,' . $this->edit_student_id,
            'email' => 'required|email',
            'phone' => 'required|numeric|unique:students,id,' . $this->edit_student_id,
            'photo' => 'image|nullable|max:1024', // 1MB Max
        ]);
             //upload new image
   

        $student =  Student::find($this->edit_student_id);

        //new image upload
        if (($this->photo!='') && ($this->photo!=null)) {
           // dd($this->photo);
            //delete the old image from the folder
            if (File::exists('uploads/student/' . $student->photo)) {
                File::delete('uploads/student/' . $student->photo);
            }
             //then upload new image
            $imageName = time() . '.' . $this->photo->extension();
            $this->photo->storeAs('student', $imageName);
            $student->photo = $imageName;
        }

        $student->name = $this->name;
        $student->email  = $this->email;
        $student->phone  = $this->phone;
        $student->status  = 1;
        $student->save();

        session()->flash('message', 'Student Has Updated Succesfully');

        $this->dispatchBrowserEvent('close-modal');
        
    }

    public function deleteStudentModal($id){
        $this->delete_student_id = $id;
        $this->dispatchBrowserEvent('show-delete-student-modal');
    }

    public function canceldeleteModal(){
        $this->delete_student_id = '';
    }

    public function deleteStudent(){
        $student = Student::find($this->delete_student_id);
        if (!is_null($student)) {
            //delete the  image
            if (File::exists('uploads/student/' . $student->photo)) {
                File::delete('uploads/student/' . $student->photo);
            }
            $student->delete();
        }
        session()->flash('message', 'Student Has Deleted Succesfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->delete_student_id = '';
    }

    
    public function render()
    {
        $students = Student::where('name', 'like', '%' . $this->searchItem . '%')->orWhere('email', 'like', '%' . $this->searchItem . '%')->orWhere('phone', 'like', '%' . $this->searchItem . '%')->where('status', 1)->get();

        return view('livewire.student-bootstrap-modal-component',compact('students'));
    }
}
