<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BehaviorController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PerspectiveController;
use App\Http\Controllers\ScoreCardController;
use App\Http\Controllers\StrategicPlanController;
use App\Http\Controllers\YearCardController;
use App\Http\Controllers\YearlyPlanController;
use App\Models\YearCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/logins',[AuthController::class,'login']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('/score_cards',ScoreCardController::class);
Route::apiResource('/departments',DepartmentController::class);
Route::apiResource('/yearlyplans',YearlyPlanController::class);
Route::apiResource('/yearcards',YearCardController::class);
Route::apiResource('/behaviors',BehaviorController::class);


Route::apiResource('/perspectives',PerspectiveController::class);
Route::apiResource('/strategic_plans',StrategicPlanController::class);

Route::get('/logout',[AuthController::class,'logout']);
    
});
