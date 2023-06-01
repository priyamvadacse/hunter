<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserApiController;
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

Route::get('response' , function(){
    return response()->json(['status' => false, 'message' => "Not Authorized"], 401);
})->name('api.error');



Route::post('/register', [AuthController::class, 'userRegister']);
Route::post('/register-with-mobile',[AuthController::class ,'registerWithPhone']);
Route::post('/veryfy-login-with-otp', [AuthController::class, 'loginWithOtp']);
Route::post('/resend-otp', [AuthController::class, 'resendOtp']);

Route::post('/login-with-social', [AuthController::class, 'socialLoginType']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/profile-update', [UserApiController::class, 'updateProfile']);
    Route::get('/get-profile', [UserApiController::class, 'getProfile']);

    // 
    Route::post('/get-match-nearby-location', [UserApiController::class, 'getMatchNearbyLocation']);
    Route::post('/save-like',[UserApiController::class, 'likeApiSave']);
    Route::post('/get-liked-list', [UserApiController::class, 'getLikedList']);
    Route::post('/delete-liked', [UserApiController::class, 'deleteLike']);

});
