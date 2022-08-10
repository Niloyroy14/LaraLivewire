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