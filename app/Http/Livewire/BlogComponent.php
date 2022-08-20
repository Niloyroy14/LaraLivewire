<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Blog;

use Livewire\WithPagination;

class BlogComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        $blogs = Blog::where('title', 'like', '%' . $this->search . '%')->paginate(10);
        return view('livewire.blog-component',compact('blogs'));
    }
}
