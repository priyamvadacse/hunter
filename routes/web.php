<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/dashboard',[DashboardController::class, 'index'])->name('admin.dashboard');

// Route::group(['middleware' => ['auth:admin']], function() {
//     Route::get('/users', [UserController::class, 'users']);
//   });

Route::prefix('admin')->group(base_path('routes/admin_route.php'));


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LandingPageController::class, 'landingPage'])->name('landing.page');
Route::get('/contact-us', [LandingPageController::class, 'contactUs'])->name('landing.contactus');
Route::get('/story',[LandingPageController::class,'storypage'])->name('landing.story');
Route::get('/story-details-page/{id}', [LandingPageController::class, 'storyDetailPage'])->name('landing.story_details_page');
Route::get('/about',[LandingPageController::class,'aboutPage'])->name('landing.aboutpage');
Route::get('/faq-page', [LandingPageController::class, 'faqPage'])->name('landing.faq_page');
Route::get('privacy-&-cookie-policy', [LandingPageController::class, 'privacyPolicya'])->name('landing.privacy_policy');
Route::get('terms-and-conditions', [LandingPageController::class, 'termAndCondition'])->name('landing.term_conditions');

