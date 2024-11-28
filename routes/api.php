<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ContractController as ApiContractController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Project Api
Route::delete('projects/del/{id}',[ProjectController::class,'forceDelete']);
Route::apiResource('projects',ProjectController::class);

//auth api
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

//contract api


Route::get('contracts', [ApiContractController::class, 'index']);
Route::get('contracts/{id}', [ApiContractController::class, 'show']);
Route::put('contracts/{offerId}/update', [ApiContractController::class, 'freelancerViewAndUpdateContract']);
