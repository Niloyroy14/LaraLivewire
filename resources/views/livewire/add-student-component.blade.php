<div>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add New Student</h5>
                        <a href="{{route('list.students')}}" class="btn btn-sm btn-info" style="float:right ;">All Students</a>
                    </div>
                    <div class="card-body">
                        @if(session()->has('message'))
                        <div class="alert alert-success text-center">{{session('message')}}</div>
                        @endif
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
                                <button type="submit" class="btn btn-success">Add Student </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>