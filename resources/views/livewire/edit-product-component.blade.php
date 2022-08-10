<div>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit New Product</h5>
                        <a href="{{route('list.products')}}" class="btn btn-sm btn-info" style="float:right;">All Products</a>
                    </div>
                    <div class="card-body">
                        @if(session()->has('message'))
                        <div class="alert alert-success text-center">{{session('message')}}</div>
                        @endif
                        <form wire:submit.prevent="updateProduct">
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
                            <div class="form-group">
                                <label for="images">Old Image</label>
                                <br>
                                @foreach($productImages as $image)
                                <img src="{{asset('uploads/all/'.$image->image)}}" alt="{{$title}}" height="70px" width="70px">
                                <a href="javascript:void(0)" wire:click.prevent="deleteImage({{ $image->id}},'{{$image->image}}')"><i class="fas fa-times text-danger mr-2"></i></a>
                                @endforeach
                                <br>
                                <label for="images">New Image</label>
                                <input type="file" class="form-control" wire:model="images" multiple>
                                @error('images.*')
                                <span class="text-danger" style="font-size:12px;">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Update Product </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>