<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ContractController;


Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();


Route::middleware('role:admin')->group(function (){
// reports
Route::get('reports/trashed', [ReportController::class, 'trashed'])->name('reports.trashed');
Route::get('reports/excel', [ReportController::class,'exportAllReports'])->name('reports.excel');
Route::get('reports/{id}/oneExcel', [ReportController::class,'exportOneReport'])->name('reports.oneExcel');
Route::get('reports/{id}/restore', [ReportController::class, 'restore'])->name('reports.restore');
Route::delete('reports/{id}/forceDelete', [ReportController::class, 'forceDelete'])->name('reports.forceDelete');
Route::resource('reports', ReportController::class);


//projects
Route::get('projects/trashed', [ProjectController::class, 'trashed'])->name('projects.trashed');
Route::post('projects/{id}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
Route::delete('projects/{id}/forceDelete', [ProjectController::class, 'forceDelete'])->name('projects.forceDelete');
Route::resource('projects', ProjectController::class);


Route::get('sections/trashed', [SectionController::class, 'trashed'])->name('sections.trashed');
Route::post('sections/{id}/restore', [SectionController::class, 'restore'])->name('sections.restore');
Route::delete('sections/{id}/forceDelete', [SectionController::class, 'forceDelete'])->name('sections.forceDelete');
Route::resource('sections', SectionController::class);


// Route::resource('contracts', ContractController::class);

Route::get('contracts/show/{id}', [ContractController::class, 'show'])->name('contracts.show');
Route::get('contracts', [ContractController::class, 'index'])->name('contracts.index');
Route::delete('/contracts/{contract}', [ContractController::class, 'destroy'])->name('contracts.destroy');
Route::post('contracts/{id}/restore', [ContractController::class, 'restore'])->name('contracts.restore');
Route::delete('contracts/{id}/forceDelete', [ContractController::class, 'forceDelete'])->name('contracts.forceDelete');

Route::get('contracts/trashed', [ContractController::class, 'trashed'])->name('contracts.trashed');

Route::get('users/trashed', [UserController::class, 'trashed'])->name('users.trashed');
Route::post('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
Route::delete('users/{id}/forceDelete', [UserController::class, 'forceDelete'])->name('users.forceDelete');
Route::resource('users', UserController::class);
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/{page}', [AdminController::class,'index']);

// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
