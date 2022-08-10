<div>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" style="float:left;">All Student List</h5>
                        <a href=" {{route('add.students')}}" class="btn btn-sm btn-success" style="float:right ;">Add New Student</a>
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
                                    <td>
                                        <a href="{{route('edit.students',$student->id)}}" class="btn btn-sm btn-warning">Edit</a>
                                        
                                        <!-- <a href="javascript:void(0)" class="btn btn-sm btn-danger" wire:click="delete({{$student->id}})">Delete</a> -->
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger" wire:click.prevent="delete({{$student->id}})">Delete</a>
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
</div>