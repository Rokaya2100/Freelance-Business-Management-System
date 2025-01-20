<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\checkFreeLancer;
use App\Http\Middleware\CheckFreelancers;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OfferController;
// use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\PortfolioController;
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

//auth api
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

// Project Api
Route::get('projects', [ProjectController::class, 'index']);
Route::get('projects/{id}', [ProjectController::class, 'show']);
//offer api
Route::get('/offers/show/{offer}', [OfferController::class, 'show']);
Route::get('/offers/{project}', [OfferController::class, 'getProjectOffers']);
//portfolio
Route::get('/portfolios', [PortfolioController::class, 'index']);
Route::get('/portfolio/{id}', [PortfolioController::class, 'show']);
//reviews
Route::get('project/{id}/reviews', [ReviewController::class, 'index']);
Route::get('project/{project_id}/review/{review_id}', [ReviewController::class, 'showReview']);
//comments
Route::get('comments/{projectId}', [CommentController::class, 'index']);
Route::get('comments/{id}', [CommentController::class, 'show']);

Route::middleware(['auth:sanctum','role:client'])->group(function () {
Route::apiResource('projects',ProjectController::class)->except(['show','index']);
Route::post('/offers/status/{id}', [OfferController::class, 'updateStatus']);
//Rewiew Api to Project ad Freelancer
Route::post('/freelancer/{user}/rate', [ReviewController::class, 'freelancerRate']);
Route::post('/project/{project}/rate', [ReviewController::class, 'projectRate']);
//Comment Api
Route::post('comments', [CommentController::class, 'store']);
Route::put('comments/{id}', [CommentController::class, 'update']);
Route::delete('comments/{id}', [CommentController::class, 'destroy']);
});

Route::middleware(['auth:sanctum','role:freelancer'])->group(function () {
//Offer Api
Route::post('/offers/{project}', [OfferController::class, 'store']);
Route::post('/offers/restore/{id}', [OfferController::class, 'restore']);
Route::put('/updateOffers/{id}', [OfferController::class, 'update']);
Route::delete('/offers/{id}/force-delete', [OfferController::class, 'forceDelete']);
Route::delete('/offers/{id}', [OfferController::class, 'destroy']);
Route::apiResource('/offers',OfferController::class)->except(['destroy','update']);

Route::put('projects/update/{id}',[ProjectController::class,'updateProjectFromFreelancer']);

Route::put('contracts/{offerId}/update', [ApiContractController::class, 'freelancerViewAndUpdateContract']);

Route::put('/portfolio/update/{id}', [PortfolioController::class, 'updatePortfolio']);
Route::post('/portfolio/add-project', [PortfolioController::class, 'addProjectToPortfolio']);
Route::post('/portfolio/remove-project', [PortfolioController::class, 'removeProjectFromPortfolio']);
});

Route::middleware(['auth:sanctum','role:freelancer|client'])->group(function () {
Route::get('contracts', [ApiContractController::class, 'index']);
Route::get('contracts/{id}', [ApiContractController::class, 'show']);
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
