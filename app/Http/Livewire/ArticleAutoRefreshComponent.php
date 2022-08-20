<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Article;


class ArticleAutoRefreshComponent extends Component
{
    public $search = '';
    public $limitPerPage =10;
    protected $listeners = ['load-more' => 'loadMore'];


    public function loadMore(){
        $this->limitPerPage = $this->limitPerPage +5;
    }

    public function render()
    {
        $articles = Article::latest()->where('title', 'like', '%' . $this->search . '%')->paginate($this->limitPerPage);
        //return view('livewire.article-auto-refresh-component',compact('articles'))->extends('layouts.app');
        return view('livewire.article-auto-refresh-component', compact('articles'));

    }
}
