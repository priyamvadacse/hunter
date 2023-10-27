<?php

use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CookiepolicyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\kyc\KycController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ManageEmployeeController;
use App\Http\Controllers\Admin\OffersController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\payment\PaymentController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\StoryController;
use App\Http\Controllers\Admin\TermconditionController;
use App\Http\Controllers\User\AddUserController;
use App\Models\Admin\Payment;
use Illuminate\Support\Facades\Route;

Route::get('/' , [LoginController::class , 'index'])->name('admin.login');
Route::post('login' , [LoginController::class , 'loginSubmit'])->name('admin.submit_login');

Route::group(['middleware' => 'isAdmin'] , function () {
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('logout' , [LoginController::class , 'logout'])->name('admin.logout');

    //Route for user
    Route::get('/user', [AddUserController::class, 'index'])->name('admin.user');


    // Route for Admin profile

    Route::get('/member-profile',[AdminProfileController::class,'index'])->name('admin.profile');
    Route::get('/profile-page',[AdminProfileController::class,'adminProfilePage'])->name('admin.profilepage');
    Route::post('/admin-profile',[AdminProfileController::class,'profile_submit'])->name('admin.profilesubmit');
    Route::get('/change-password',[AdminProfileController::class,'changePassword'])->name('admin.changePassword');
    Route::post('/password-reset',[AdminProfileController::class,'password_reset'])->name('admin.passwordreset');
    Route::post('/add-user', [AddUserController::class, 'addUser'])->name('admin.add.user');
    Route::get('/user-list', [AddUserController::class, 'userList'])->name('admin.user.list');
    Route::get('/active-user-list', [AddUserController::class, 'ActiveUserList'])->name('admin.active_user.list');
    Route::get('/active-user-list-ajax', [AddUserController::class, 'ActiveUserListAjax'])->name('admin.active_user.list.ajax');
    Route::get('/inactive-user-list', [AddUserController::class, 'InactiveUserList'])->name('admin.inactive_user.list');
    Route::get('/inactive-user-list-ajax', [AddUserController::class, 'InactiveUserListAjax'])->name('admin.inactive_user.list.ajax');
    Route::get('/padi-user-list',[AddUserController::class,'paidUsaerlist'])->name('admin.paiduserlist');
    Route::get('/padi-user-list-ajax',[AddUserController::class,'userPaidList'])->name('admin.paiduserlist_ajax');
    Route::get('/unpadi-user-list',[AddUserController::class,'unPaidusaerList'])->name('admin.unpaiduserlist');
    Route::get('/unpaid-user-list-ajax',[AddUserController::class,'unPaidusaerListAjax'])->name('admin.unpaiduserlist_ajax');
    Route::get('/search-date',[AddUserController::class,'searchData'])->name('admin.searchData');

    Route::get('/verified-user-list', [AddUserController::class, 'VerifiedUserList'])->name('admin.verified_user.list');
    Route::get('/verified-user-list-ajax', [AddUserController::class, 'VerifiedUserListAjax'])->name('admin.verified_user.list.ajax');
    Route::get('/user-list-ajax', [AddUserController::class, 'userListAjax'])->name('admin.user.list_ajax');
    // Route::post('/user-list-ajax', [AddUserController::class, 'userListAjax'])->name('admin.user.list_ajax');

    Route::post('/delete-user', [AddUserController::class, 'deleteUser'])->name('admin.user.delete');
    Route::get('/edit-user/{id}', [AddUserController::class, 'editUser'])->name('admin.user.edit');
    Route::post('/update-user', [AddUserController::class, 'update'])->name('admin.update.user');
    Route::post('/user-status', [AddUserController::class, 'userStatus'])->name('admin.user.status');
    Route::post('/csv-import',[AddUserController::class,'csv'])->name('admin.csvpage');
    Route::post('/csv-export',[AddUserController::class,'csvExport'])->name('admin.csvexport');



    Route::get('/package',[PackageController::class,'package'])->name('admin.package');
    Route::post('/add-package',[PackageController::class,'addPackage'])->name('admin.add.package');
    Route::post('/update-package',[PackageController::class,'updatePackage'])->name('admin.update.package');
    Route::post('/delete-package',[PackageController::class,'deletePackage'])->name('admin.delete.package');

    Route::get('/package-details-list', [PackageController::class, 'PackageDetails'])->name('admin.list.details');
    Route::get('/add-package-details', [PackageController::class, 'addPackageDetails'])->name('admin.add_package.details');
    Route::post('/store-package-details', [PackageController::class, 'storePackageDetails'])->name('admin.store_package.details');
    Route::get('/privacy-policy',[PrivacyPolicyController::class,'privacy_policy'])->name('admin.Privacypolicy');
    Route::post('/add-policy',[PrivacyPolicyController::class,'addPolicy'])->name('admin.addpolicy');
    Route::get('/contact-us',[ContactController::class,'contactus'])->name('admin.contact');
    Route::post('/save-contact',[ContactController::class,'showContactus'])->name('admin.contactus');
    Route::get('/term-condition',[TermconditionController::class,'termCondition'])->name('admin.termcondition');
    Route::post('/save-termcondition',[TermconditionController::class,'saveTermcondition'])->name('admin.savetermcondition');
    Route::get('/cookie-policy',[CookiepolicyController::class,'cookiepolicyPage'])->name('admin.cookiepolicy');
    Route::post('/updatecookie-policy',[CookiepolicyController::class,'updatecookiePolicy'])->name('admin.cookiepolicypage');
    Route::get('/faq',[FaqController::class,'faqPage'])->name('admin.faqpage');
    Route::post('/save-faq',[FaqController::class,'saveFaq'])->name('admin.savefaq');
    Route::get('/showfaq-page',[FaqController::class,'showFaq'])->name('admin.showfaq');
    Route::get('/edit-page{id}',[FaqController::class,'EditPage'])->name('admin.editpage');
    Route::post('/updatefaq-page',[FaqController::class,'faqUpdate'])->name('admin.faqupdate');
    Route::get('/deletefaq-page/{id}',[FaqController::class,'delateFaq'])->name('admin.delatefaq');
    Route::post('/changestatus',[FaqController::class,'change_status'])->name('admin.change-status');

    Route::get('/social-media-page',[ContactController::class,'socialMediaPage'])->name('admin.social_media_page');
    Route::post('/social-media-update',[ContactController::class,'socialMediaUpdate'])->name('admin.social_medial_update');

    //about us
    Route::get('about-us-page', [FaqController::class, 'aboutUsPage'])->name('admin.about_us'); 
    Route::post('/about-us-update',[FaqController::class, 'about_usUpdate'])->name('admin.about_us_update');


    //offers route//

    Route::get('/offer',[OffersController::class,'offerPage'])->name('admin.offer');
    Route::post('/offer-save',[OffersController::class,'offerSave'])->name('admin.offersave');
    Route::post('/update-offer',[OffersController::class,'offerUpdates'])->name('admin.offerupdate');
    Route::post('/delete-offer',[OffersController::class,'offerDelete'])->name('admin.offerdelete');


    //kyc route
    Route::get('/kyc-verified',[KycController::class,'kycVerifiedlist'])->name('admin.kycverifiedlist');
    Route::get('/kyc-unverified',[KycController::class,'kycUnverifiedlist'])->name('admin.kycUnverifiedlist');
    Route::get('/kyc-verified-ajax',[KycController::class,'kycVerifiedAjax'])->name('admin.kyc.verified-user-ajax');
    Route::get('/kyc-unverified-list-ajax',[KycController::class,'kycUnverifiedAjax'])->name('admin.kyc.unverified_listuser-ajax');


   //Payment Route
   Route::get('/payment',[PaymentController::class,'paymentPage'])->name('admin.payment');
   Route::get('/payment-list-ajax',[PaymentController::class,'paymentList'])->name('admin.payment_ajax_list');
   Route::get('/invoices/{id}',[PaymentController::class,'invoicesPage'])->name('admin.invoice');
   Route::get('/pending-list',[PaymentController::class,'pendindList'])->name('admin.pendinglist');


    // route for  boost
    Route::get('/boost-package-index', [PackageController::class, 'index'])->name('admin.boost.index_page');
    Route::post('/save-boost-package', [PackageController::class, 'saveUserBoost'])->name('admin.boost.saveUserBoost');
    Route::post('/update-boost-package', [PackageController::class , 'updateBoostPackage'])->name('admin.boost.update_boost_package');
    Route::post('/boost-package-delete', [PackageController::class, 'deleteBoostPackage'])->name('admin.delete_boost.package');
    
    Route::get('story-index', [StoryController::class, 'storyIndex'])->name('admin.story_index');
    Route::get('story-list-ajax', [StoryController::class, 'storyListAjax'])->name('admin.story_list_ajax');
    Route::get('add-story-page', [StoryController::class, 'addStoryPage'])->name('admin.add_story_pages');
    Route::post('save-story', [StoryController::class, 'saveStory'])->name('admin.save_story');
    Route::get('edit-story-page/{id}', [StoryController::class, 'editStoryPage'])->name('admin.edit_story_page');
    Route::post('update-story', [StoryController::class, 'updateStory'])->name('admin.update_story');
    Route::post('delete-story', [StoryController::class, 'deleteStory'])->name('admin.delete_story');
    Route::post('update-status-story', [StoryController::class, 'updateStatusStory'])->name('admin.update_status_story');

    //route for manage employee
    Route::get('employee', [ManageEmployeeController::class, 'AddEmployee'])->name('admin.manage_employee');
    Route::post('store-employee', [ManageEmployeeController::class, 'storeEmployee'])->name('admin.store_employee');
    Route::get('show-employee-ajax', [ManageEmployeeController::class, 'EmployeeListAjax'])->name('admin.ajax_employee');
    Route::get('show-permission/{id}', [ManageEmployeeCOntroller::class, 'showPermission'])->name('admin.show_permission');
    Route::post('update-permission', [ManageEmployeeController::class, 'updatePermission'])->name('admin.update_Permission');
});
