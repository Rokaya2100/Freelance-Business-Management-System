<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\checkFreeLancer;
use App\Http\Middleware\CheckFreelancers;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\CommentController;
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
Route::get('projects', [ProjectController::class, 'index']);
Route::get('projects/{id}', [ProjectController::class, 'show']);
Route::get('comments/{projectId}', [CommentController::class, 'index']);
Route::get('comments/{id}', [CommentController::class, 'show']);
Route::middleware('auth:sanctum')->group(function(){
Route::delete('projects/del/{id}',[ProjectController::class,'forceDelete']);
Route::put('projects/update/{id}',[ProjectController::class,'updateProjectFromFreelancer']);
Route::apiResource('projects',ProjectController::class);
});
//auth api
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

Route::get('/portfolios', [PortfolioController::class, 'index']);
Route::get('/portfolio/{id}', [PortfolioController::class, 'show']);
//offer api

Route::get('/offers/show/{offer}', [OfferController::class, 'show']);
Route::get('/offers/{project}', [OfferController::class, 'getProjectOffers']);

Route::middleware('auth:sanctum')->group(function(){

Route::post('/portfolio/add-project', [PortfolioController::class, 'addProjectToPortfolio']);
Route::get('/portfolio/projects', [PortfolioController::class, 'getFreelancerProjects']);
Route::post('/portfolio/remove-project', [PortfolioController::class, 'removeProjectFromPortfolio']);
Route::post('/portfolio/fill', [PortfolioController::class, 'fillPortfolio']);
Route::put('/portfolio/update', [PortfolioController::class, 'updatePortfolio']);
Route::post('/freelancer/{user}/rate', [ReviewController::class, 'freelanceerrate']);
Route::post('/project/{project}/rate', [ReviewController::class, 'projectStore']);
Route::post('comments', [CommentController::class, 'store']);
Route::put('comments/{id}', [CommentController::class, 'update']);
Route::delete('comments/{id}', [CommentController::class, 'destroy']);
Route::post('/offers/{project}', [OfferController::class, 'store']);
Route::post('/offers/restore/{id}', [OfferController::class, 'restore'])->middleware(['CheckFreelancers']);
Route::post('/offers/status/{id}', [OfferController::class, 'updateStatus']);
Route::post('/updateOffers/{id}', [OfferController::class, 'update'])->middleware(['CheckFreelancers']);
Route::get('/freeOffersDeleted', [OfferController::class, 'freeOffersDeleted'])->middleware('auth:sanctum');
Route::get('/offers/offers-deleted/{user_id}', [OfferController::class, 'offersDeleted'])->middleware('auth:sanctum');
Route::delete('/offers/{id}/force-delete', [OfferController::class, 'forceDelete'])->middleware('auth:sanctum');
Route::delete('/offers/{id}', [OfferController::class, 'destroy'])->middleware(['CheckFreelancers']);
Route::apiResource('/offers',OfferController::class)->except(['destroy','update']);
});

//contract api

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// these are temporary one until we handle the Roles thing
Route::get('contracts', [ApiContractController::class, 'index'])->middleware('auth:sanctum');
Route::get('contracts/{id}', [ApiContractController::class, 'show'])->middleware('auth:sanctum');
Route::put('contracts/{offerId}/update', [ApiContractController::class, 'freelancerViewAndUpdateContract'])->middleware('auth:sanctum');

