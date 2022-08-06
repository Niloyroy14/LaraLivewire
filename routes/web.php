<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\IndexStudentComponent;
use App\Http\Livewire\AddStudentComponent;

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

Route::get('students', IndexStudentComponent::class)->name('list.students');
Route::get('add/students',AddStudentComponent::class)->name('add.students');