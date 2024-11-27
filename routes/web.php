<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\SectionController;

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

// Route::resource('contracts', ContractController::class);

Route::get('contracts/show/{id}', [ContractController::class, 'show'])->name('contracts.show');
Route::get('contracts', [ContractController::class, 'index'])->name('contracts.index');
Route::delete('/contracts/{contract}', [ContractController::class, 'destroy'])->name('contracts.destroy');
Route::post('contracts/{id}/restore', [ContractController::class, 'restore'])->name('contracts.restore');
Route::get('contracts/trashed', [ContractController::class, 'trashed'])->name('contracts.trashed');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/{page}', [AdminController::class,'index']);
