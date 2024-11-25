<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();


Route::get('sections/trashed', [SectionController::class, 'trashed'])->name('sections.trashed');
Route::post('sections/{id}/restore', [SectionController::class, 'restore'])->name('sections.restore');
Route::resource('sections', SectionController::class);

Route::get('users/trashed', [UserController::class, 'trashed'])->name('users.trashed');
Route::post('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
Route::resource('users', UserController::class);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/{page}', [AdminController::class,'index']);
