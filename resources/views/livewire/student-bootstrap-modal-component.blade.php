<div>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" style="float:left;">All Student List</h5>
                        <button type="button" class="btn btn-primary" wire:click="addStudentModal()" style="float:right ;"> Add New Student </button>
                    </div>
                    <div class="card-body">
                        @if(session()->has('message'))
                        <div class="alert alert-success text-center">{{session('message')}}</div>
                        @endif
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input type="text" wire:model="searchItem" class="form-control w-25" placeholder="Search..." style="float:right">
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Photo</th>
                                    <th width="30%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($students->count()>0)
                                @foreach($students as $key=> $student)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$student->name}}</td>
                                    <td>{{$student->email}}</td>
                                    <td>{{$student->phone}}</td>
                                    <td style="text-align:center ;">
                                        @if($student->photo!=null && $student->photo!='')
                                        <img src="{{asset('uploads/student/'.$student->photo)}}" alt="{{$student->name}}" height="50px" width="50px">
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-secondary" wire:click="viewStudentDetails({{$student->id}})">View</button>
                                        <button type="button" class="btn btn-sm btn-warning" wire:click="EditStudent({{$student->id}})">Edit</button>
                                        <button class="btn btn-sm btn-danger" wire:click="deleteStudentModal({{$student->id}})">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <td colspan="5" style="text-align: center ;">No Students Found</td>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Student Modal -->
    <div wire:ignore.self class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeStudent">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name')
                            <span class="text-danger" style="font-size:12px;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" wire:model="email">
                            @error('email')
                            <span class="text-danger" style="font-size:12px;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" wire:model="phone">
                            @error('phone')
                            <span class="text-danger" style="font-size:12px;">{{$message}}</span>
                            @enderror
                        </div>
                        @if($photo)
                        <div class="form-group">
                            <label for="photo">Photo Preview</label>
                            <br>
                            <img src="{{ $photo->temporaryUrl() }}" height="100px" width="100px">
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" class="form-control" wire:model="photo">
                            <div wire:loading wire:target="photo">Uploading...</div>
                            <!--- for showing uploading text when file select --->
                            @error('photo')
                            <span class="text-danger" style="font-size:12px;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success mt-2">Add Student </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add Student Modal -->

    <!-- View Student Modal -->

    <div wire:ignore.self class="modal fade" id="viewStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Student Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click=closeViewStudentModal></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{$view_name}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{$view_email}}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{$view_phone}}</td>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <td>
                                    @if($view_photo!=null && $view_photo!='')
                                    <img src="{{asset('uploads/student/'.$view_photo)}}" alt="{{$student->name}}" height="50px" width="50px">
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End View Student Modal -->

    <!-- Edit Student Modal -->
    <div wire:ignore.self class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeEditModal"></button>
                </div>
                <div class=" modal-body">
                    <form wire:submit.prevent="updateStudent">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name')
                            <span class="text-danger" style="font-size:12px;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" wire:model="email">
                            @error('email')
                            <span class="text-danger" style="font-size:12px;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" wire:model="phone">
                            @error('phone')
                            <span class="text-danger" style="font-size:12px;">{{$message}}</span>
                            @enderror
                        </div>
                        @if(!is_null($old_photo))
                        <div class="form-group">
                            <label for="images">Old Photo</label>
                            <br>
                            <img src="{{asset('uploads/student/'.$old_photo)}}" alt="{{$name}}" height="70px" width="70px">
                        </div>
                        @endif
                        @if($photo)
                        <div class="form-group">
                            <label for="photo">Photo Preview</label>
                            <br>
                            <img src="{{ $photo->temporaryUrl() }}" height="100px" width="100px">
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" class="form-control" wire:model="photo">
                            <div wire:loading wire:target="photo">Uploading...</div>
                            <!--- for showing uploading text when file select --->
                            @error('photo')
                            <span class="text-danger" style="font-size:12px;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success mt-2">Update Student </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Edit Student Modal -->

    <!-- Delete Student Modal -->

    <div wire:ignore.self class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class=" modal-body">
                    <h6>Are you sure? You delete this student data</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="canceldeleteModal()">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteStudent()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- End Delete Student Modal -->

</div>


@section('scripts')
<script>
    window.addEventListener('show-add-student-modal', event => {
        $('#addStudentModal').modal('show');
    });

    window.addEventListener('close-modal', event => {
        $('#addStudentModal').modal('hide');
        $('#editStudentModal').modal('hide');
        $('#deleteStudentModal').modal('hide');
    });

    window.addEventListener('show-view-student-modal', event => {
        $('#viewStudentModal').modal('show');
    });

    window.addEventListener('show-edit-student-modal', event => {
        $('#editStudentModal').modal('show');
    });

    window.addEventListener('show-delete-student-modal', event => {
        $('#deleteStudentModal').modal('show');
    });
</script>

@endsection