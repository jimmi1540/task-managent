<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

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
    return redirect()->route('login');
});
Route::get('/dashboard', [TasksController::class, 'Index'])->name('dashboard')->middleware('is_admin');
Route::get('/add-task', [TasksController::class, 'create'])->name('add.task')->middleware('is_admin');
Route::post('/create-task', [TasksController::class, 'AddTask'])->name('create.task')->middleware('is_admin');
Route::get('/edit-task/{id}',[TasksController::class, 'edit'])->name('tasks.edit')->middleware('is_admin');
Route::post('/Update-task/{id}',[TasksController::class, 'update'])->name('update.task')->middleware('is_admin');
Route::delete('/delete-task/{id}',[TasksController::class,'Destroy'])->name('tasks.destroy')->middleware('is_admin');
Auth::routes();
