<div>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" style="float:left;">All Article List</h5>
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
                                @if($articles->count()>0)
                                @foreach($articles as $key=> $article)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$article->title}}</td>
                                    <td>{{$article->slug}}</td>
                                    <td>{{$article->keywords}}</td>
                                    <td>{{$article->description}}</td>
                                </tr>
                                @endforeach
                                @else
                                <td colspan="5" style="text-align: center ;">No Articles Found</td>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


 @section('scripts')
<script>
    window.onscroll = function(event) {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            window.livewire.emit('load-more');
        }
    }
</script>
@endsection