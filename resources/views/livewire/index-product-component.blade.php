<div>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" style="float:left;">All Product List</h5>
                        <a href=" {{route('add.products')}}" class="btn btn-sm btn-success" style="float:right ;">Add New Product</a>
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
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th width="30%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($products->count()>0)
                                @foreach($products as $key=> $product)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$product->title}}</td>
                                    <td style="text-align:center ;">
                                        @foreach($product->images as $image)
                                        <img src="{{asset('uploads/all/'.$image->image)}}" alt="{{$product->title}}" height="50px" width="50px">
                                        @endforeach

                                    </td>
                                    <td>{{$product->price}}</td>
                                    <td>
                                        <a href="{{route('edit.products',$product->id)}}" class="btn btn-sm btn-warning">Edit</a>

                                        <!-- <a href="javascript:void(0)" class="btn btn-sm btn-danger" wire:click="delete({{$product->id}})">Delete</a> -->
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger" wire:click.prevent="delete({{$product->id}})">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <td colspan="5" style="text-align: center ;">No Product Found</td>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>