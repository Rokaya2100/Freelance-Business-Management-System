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
Route::middleware('auth:sanctum')->group(function(){

 Route::post('/offers/{project}', [OfferController::class, 'store']);

Route::put('/offers/status/{offer}', [OfferController::class, 'updateStatus']);
Route::put('/offers/{offer}', [OfferController::class, 'update'])->middleware(['checkFreeLancer']);
 Route::get('/offers/show/{offer}', [OfferController::class, 'show']);
 Route::get('/offers/{project}', [OfferController::class, 'getProjectOffers']);

 Route::post('/offers/{id}/restore', [OfferController::class, 'restore']);
 Route::delete('/offers/{id}/force-delete', [OfferController::class, 'forceDelete']);
 Route::delete('/offers/{offer}', [OfferController::class, 'destroy'])->middleware( ['checkFreeLancer']);

Route::apiResource('/offers',OfferController::class);

});
