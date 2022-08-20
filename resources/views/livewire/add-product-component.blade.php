<div>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add New Product</h5>
                        <a href="{{route('list.products')}}" class="btn btn-sm btn-info" style="float:right;">All Products</a>
                    </div>
                    <div class="card-body">
                        @if(session()->has('message'))
                        <div class="alert alert-success text-center">{{session('message')}}</div>
                        @endif
                        <form wire:submit.prevent="storeProduct">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" wire:model="title">
                                @error('title')
                                <span class="text-danger" style="font-size:12px;">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" wire:model="price">
                                @error('price')
                                <span class="text-danger" style="font-size:12px;">{{$message}}</span>
                                @enderror
                            </div>
                            <!-- Livewire provide this image previe temporary ulr automatic see documentation -->
                            @if($images)
                            <div class="form-group">
                                <label for="images">Image Preview</label>
                                <br>
                                @foreach($images as $image)
                                <img src="{{ $image->temporaryUrl() }}" height="100px" width="100px">
                                @endforeach
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="images">Image</label>
                                <input type="file" class="form-control" wire:model="images" multiple>
                                <div wire:loading wire:target="images">Uploading...</div>  <!--- for showing uploading text when file select --->
                                @error('images.*')
                                <span class="text-danger" style="font-size:12px;">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Add Product </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>