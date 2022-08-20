<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\IndexStudentComponent;
use App\Http\Livewire\AddStudentComponent;
use App\Http\Livewire\EditStudentComponent;
use App\Http\Livewire\IndexProductComponent;
use App\Http\Livewire\AddProductComponent;
use App\Http\Livewire\EditProductComponent;
use App\Http\Livewire\BlogComponent;
use App\Http\Livewire\ArticleAutoRefreshComponent;
use App\Http\Livewire\StudentBootstrapModalComponent;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//students

Route::get('students', IndexStudentComponent::class)->name('list.students');
Route::get('add/students',AddStudentComponent::class)->name('add.students');
Route::get('edit/students/{id}', EditStudentComponent::class)->name('edit.students');


//students with bootstrap modal

Route::get('students/modal', StudentBootstrapModalComponent::class)->name('list.students.modal');


//products

Route::get('products', IndexProductComponent::class)->name('list.products');
Route::get('add/products', AddProductComponent::class)->name('add.products');
Route::get('edit/products/{id}', EditProductComponent::class)->name('edit.products');


//blogs
Route::get('blogs', BlogComponent::class)->name('list.blogs');

//articles
Route::get('articles', ArticleAutoRefreshComponent::class)->name('list.articles');


