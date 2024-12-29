<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\checkFreeLancer;
use App\Http\Middleware\CheckFreelancers;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OfferController;
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

//offer api
Route::middleware('auth:sanctum')->group(function(){

 Route::post('/offers/{project}', [OfferController::class, 'store']);
 Route::post('/offers/{id}/restore', [OfferController::class, 'restore'])->middleware(['CheckFreelancers']);


Route::put('/offers/status/{id}', [OfferController::class, 'updateStatus']);
Route::put('/offers/{id}', [OfferController::class, 'update'])->middleware(['CheckFreelancers']);

 Route::get('/offers/show/{offer}', [OfferController::class, 'show']);
 Route::get('/offers/{project}', [OfferController::class, 'getProjectOffers']);

 Route::delete('/offers/{id}/force-delete', [OfferController::class, 'forceDelete'])->middleware(['CheckFreelancers']);
 Route::delete('/offers/{id}', [OfferController::class, 'destroy'])->middleware(['CheckFreelancers']);

Route::apiResource('/offers',OfferController::class)->except(['destroy','update']);

});

//contract api


Route::get('contracts', [ApiContractController::class, 'index']);
Route::get('contracts/{id}', [ApiContractController::class, 'show']);
Route::put('contracts/{offerId}/update', [ApiContractController::class, 'freelancerViewAndUpdateContract']);

