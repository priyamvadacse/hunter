<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BoostController;
use App\Http\Controllers\Api\CmsApiController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    Route::get('/get-user-details/{user_id}', [UserApiController::class, 'getUserDetails']);

    Route::get('/search-by-username/{username}', [UserApiController::class, 'userSearchByname']);

    Route::get('/get-package', [UserApiController::class, 'getPackage']);
    Route::post('/check-my-subcription', [UserApiController::class, 'checkMySubscription']);
    Route::post('/active-package', [UserApiController::class, 'activePackage']);

    Route::get('user-list', [UserApiController::class, 'userList']);

    Route::post('/multiple-image-save', [UserApiController::class, 'multiImgeStore']);
    Route::get('/fetch-user-image', [UserApiController::class, 'fetchUserImages']);
 // this fillter use to with pagination
    Route::post('/apply-fillter', [UserApiController::class, 'applyFillter']);
    // this fillter use to without pagination
    Route::post('/get-fillter-data', [UserApiController::class, 'getFillterData']);
    // user update in profile 
    Route::post('/user-update-profile', [UserApiController::class, 'userUpdateProfile']);

    // cms route
    Route::get('/about-us', [CmsApiController::class, 'aboutUs']);
    Route::get('/privacy-cookie-policy', [CmsApiController::class, 'privacyPolicy']);

    // route use for check my subsription cron job
    Route::get('/check-subscription-expire', [UserApiController::class, 'subcriptionPlanExpire']);

    // email verified with otp 
    Route::post('/send-otp-email', [AuthController::class, 'sendOtpEmail']);
    Route::post('/email-otp-verified', [AuthController::class, 'emailVerified']);

    // phone no verified with otp
    Route::post('/send-otp-mobile', [AuthController::class, 'mobileOtpSend']);
    Route::post('/user-mobile-otp-verification', [AuthController::class, 'userMobileVerification']);

    // image verification
    Route::post('/image-verification', [AuthController::class, 'imageVerify']);

    // send feedback
    Route::post('/send-feedback', [UserApiController::class, 'sendFeedback']);
    
    // route for boost package
    Route::get('/get-boost-package', [BoostController::class, 'getBootsPackage']);

    // route use for get like
    Route::get('/get-user-like',[UserApiController::class, 'getUserLike']);
    
    // rote payment check
    Route::post('/ntt-payment-callback', [UserApiController::class, 'paymentCheck']);

});

// help center
Route::get('/terms-and-condition', [CmsApiController::class, 'termsAndCondition']);