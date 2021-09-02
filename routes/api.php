<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ADAController;
use App\Http\Controllers\BehaviorController;
use App\Http\Controllers\DepartmentCardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentPlanController;
use App\Http\Controllers\UserActivityController;
use App\Http\Controllers\PerspectiveController;
use App\Http\Controllers\ScoreCardController;
use App\Http\Controllers\StrategicPlanController;
use App\Http\Controllers\TermActivityController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\TermSubActivityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSubActivityController;
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



Route::post('/login',[AuthController::class,'login']);


//visiblity status changing methods
Route::post('/change_score_card_visiblity/{id}',[ScoreCardController::class,'make_visible']);
Route::post('/change_year_card_visiblity/{id}',[YearCardController::class,'make_visible']);
Route::post('/change_department_card_visiblity/{id}',[DepartmentCardController::class,'make_visible']);
Route::post('/change_term_visiblity/{id}',[TermController::class,'make_visible']);

// user controller methods
Route::apiResource('/users',UserController::class)->except('delete');
Route::post('/share_to_department/{id}',[UserController::class,'make_visible']);
Route::post('/send_comment/{id}',[UserController::class,'send_comment']);
Route::post('/accept_activity',[UserController::class,'accept_activity']);
Route::get('/select/{id}',[UserController::class,'plan_to_be_selected']);
Route::get('/deactivate_user/{id}',[UserController::class,'make_deactive']);



Route::apiResource('/departments',DepartmentController::class);
Route::post('/assign_manager/{id}',[DepartmentController::class,'assignManager']);


Route::apiResource('/yearly_plans',YearlyPlanController::class);
Route::apiResource('/department_plans',DepartmentPlanController::class);
Route::apiResource('/year_cards',YearCardController::class);
Route::apiResource('/department_cards',DepartmentCardController::class);
Route::apiResource('/behaviors',BehaviorController::class);


Route::apiResource('/perspectives',PerspectiveController::class);
Route::apiResource('/adas',ADAController::class);

//user sub Activity related routes
Route::apiResource('/user_sub_activities',UserSubActivityController::class);
Route::post('/give_activity_result',[ UserSubActivityController::class, 'giveActivityResult']);
Route::post('/give_behavior_result',[ UserSubActivityController::class, 'giveBehaviorResult']);

Route::apiResource('/term_activities',TermActivityController::class);
Route::apiResource('/term_sub_activities',TermSubActivityController::class);
Route::apiResource('/terms',TermController::class);
Route::apiResource('/strategic_plans',StrategicPlanController::class);

Route::apiResource('/score_cards',ScoreCardController::class);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout',[AuthController::class,'logout']);

});
