<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\checkFreeLancer;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OfferController;

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
//auth api
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

//offer api
Route::post('/offers/{project}', [OfferController::class, 'store'])->middleware('auth:sanctum');

Route::put('/offers/status/{offer}', [OfferController::class, 'updateStatus'])->middleware('auth:sanctum');
Route::put('/offers/{offer}', [OfferController::class, 'update'])->middleware(['checkFreeLancer','auth:sanctum',]);
 Route::get('/offers/show/{offer}', [OfferController::class, 'show'])->middleware('auth:sanctum');
 Route::get('/offers/{project}', [OfferController::class, 'getProjectOffers'])->middleware('auth:sanctum');

 Route::post('/offers/{id}/restore', [OfferController::class, 'restore'])->middleware('auth:sanctum');
 Route::delete('/offers/{id}/force-delete', [OfferController::class, 'forceDelete'])->middleware('auth:sanctum');
 Route::delete('/offers/{offer}', [OfferController::class, 'destroy'])->middleware( ['checkFreeLancer','auth:sanctum',]);

Route::apiResource('/offers',OfferController::class)->middleware('auth:sanctum');
