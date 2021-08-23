<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PerspectiveController;
use App\Http\Controllers\ScoreCardController;
use App\Http\Controllers\StrategicPlanController;
use App\Http\Controllers\YearlyPlanController;
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

Route::apiResource('/scorecards',ScoreCardController::class);
Route::apiResource('/departments',DepartmentController::class);
Route::apiResource('/yearlyplans',YearlyPlanController::class);

Route::apiResource('/perspectives',PerspectiveController::class);
Route::apiResource('/strategicplans',StrategicPlanController::class);


