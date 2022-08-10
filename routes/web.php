<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\IndexStudentComponent;
use App\Http\Livewire\AddStudentComponent;
use App\Http\Livewire\EditStudentComponent;
use App\Http\Livewire\IndexProductComponent;
use App\Http\Livewire\AddProductComponent;
use App\Http\Livewire\EditProductComponent;


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

//products

Route::get('products', IndexProductComponent::class)->name('list.products');
Route::get('add/products', AddProductComponent::class)->name('add.products');
Route::get('edit/products/{id}', EditProductComponent::class)->name('edit.products');