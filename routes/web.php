<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SectionController;


Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

// sections

Route::get('sections/trashed', [SectionController::class, 'trashed'])->name('sections.trashed');
Route::post('sections/{id}/restore', [SectionController::class, 'restore'])->name('sections.restore');
Route::resource('sections', SectionController::class);

// reports
 Route::get('reports/trashed', [ReportController::class, 'trashed'])->name('reports.trashed');
Route::get('reports/excel', [ReportController::class,'exportAllReports'])->name('reports.excel');
Route::get('reports/{id}/oneExcel', [ReportController::class,'exportOneReport'])->name('reports.oneExcel');
Route::get('reports/{id}/restore', [ReportController::class, 'restore'])->name('reports.restore');
Route::delete('reports/{id}/forceDelete', [ReportController::class, 'forceDelete'])->name('reports.forceDelete');
Route::resource('reports', ReportController::class);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/{page}', [AdminController::class,'index']);
