<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContractController as ApiContractController;
use App\Http\Controllers\PortfolioController;

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



// these are temporary one until we handle the Roles thing
Route::get('contracts', [ApiContractController::class, 'index'])->middleware('auth:sanctum');
Route::get('contracts/{id}', [ApiContractController::class, 'show'])->middleware('auth:sanctum');
Route::put('contracts/{offerId}/update', [ApiContractController::class, 'freelancerViewAndUpdateContract'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/portfolio/add-project', [PortfolioController::class, 'addProjectToPortfolio']);
    Route::get('/portfolio/projects', [PortfolioController::class, 'getFreelancerProjects']);
    Route::post('/portfolio/remove-project', [PortfolioController::class, 'removeProjectFromPortfolio']);
    Route::post('/portfolio/fill', [PortfolioController::class, 'fillPortfolio']);
    Route::put('/portfolio/update', [PortfolioController::class, 'updatePortfolio']);
});

Route::get('/portfolios', [PortfolioController::class, 'index']);
Route::get('/portfolio/{id}', [PortfolioController::class, 'show']);