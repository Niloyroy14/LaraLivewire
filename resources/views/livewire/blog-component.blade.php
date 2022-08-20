<div>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" style="float:left;">All Blog List</h5>
                    </div>
                    <div class="card-body">
                        @if(session()->has('message'))
                        <div class="alert alert-success text-center">{{session('message')}}</div>
                        @endif
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input type="text" wire:model="search" class="form-control w-25" placeholder="Search..." style="float:right">
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Keyword</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($blogs->count()>0)
                                @foreach($blogs as $key=> $blog)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$blog->title}}</td>
                                    <td>{{$blog->slug}}</td>
                                    <td>{{$blog->keywords}}</td>
                                    <td>{{$blog->description}}</td>
                                </tr>
                                @endforeach
                                @else
                                <td colspan="5" style="text-align: center ;">No Blogs Found</td>
                                @endif
                            </tbody>
                        </table>
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>