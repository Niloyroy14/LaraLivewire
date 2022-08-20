<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;
use Illuminate\Support\Facades\File;

class IndexStudentComponent extends Component
{

    public $delete_id;
    public $searchItem;
    protected $listeners = ['deleteConfirmed' => 'deleteStudent'];

    // public function delete($id){
    //     Student::find($id)->delete();
    //     session()->flash('message', 'Student Has Deleted Succesfully');
    // }

    public function delete($id){
      $this->delete_id = $id;
      $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteStudent(){
        //$student = Student::where('id', $this->delete_id)->delete();
        $student = Student::find($this->delete_id);
        if (!is_null($student)) {
            //delete the  image
            if (File::exists('uploads/student/' . $student->photo)) {
                File::delete('uploads/student/' . $student->photo);
            }
            $student->delete();
        }
        $this->dispatchBrowserEvent('deleteAlert');
    }


    public function render()
    {
        // $students = Student::where('status',1)->get();
        $students = Student::where('name','like','%'.$this->searchItem.'%')->orWhere('email','like','%'.$this->searchItem.'%')->orWhere('phone','like','%'.$this->searchItem.'%')->where('status', 1)->get();
        return view('livewire.index-student-component',compact('students'));
    }
}
