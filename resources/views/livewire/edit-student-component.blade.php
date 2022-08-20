<div>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Student</h5>
                    </div>
                    <div class="card-body">
                        @if(session()->has('message'))
                        <div class="alert alert-success text-center">{{session('message')}}</div>
                        @endif
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
                                <label for="">Photo Preview</label>
                                <br>
                                <img src="{{ $photo->temporaryUrl() }}" height="100px" width="100px">
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="photo">New Photo</label>
                                <input type="file" class="form-control" wire:model="photo">
                                <div wire:loading wire:target="photo">Uploading...</div>
                                @error('photo')
                                <span class="text-danger" style="font-size:12px;">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Update Student </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>