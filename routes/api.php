<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactPeopleController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExpoCompanyController;
use App\Http\Controllers\ExpoController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\GuideLineController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LogoCompanyController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PageContactUsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PageSectionController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\RefController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TermsConditionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::post('application-form', [UserController::class, 'applicationForm']);
Route::post('/log/index', [UserController::class, 'logIndex']);
Route::get('/user-total-count-country', [UserController::class, 'totalCountPerCountry']);

//////////////////////////////////////// user ////////////////////////////////

Route::post('/user/index', [UserController::class, 'index']);
Route::post('user/restore', [UserController::class, 'restore']);
Route::delete('user/delete', [UserController::class, 'destroy']);
Route::put('/user/{id}/{column}', [UserController::class, 'toggle']);
Route::delete('user/force-delete', [UserController::class, 'forceDelete']);
Route::apiResource('user', UserController::class);



Route::get('/get-user-public', [UserController::class, 'indexPublic']);
Route::get('/get-user-active', [UserController::class, 'indexActive']);

//////////////////////////////////////// user ////////////////////////////////





//////////////////////////////////////// Slider ////////////////////////////////

Route::post('slider/index', [SliderController::class, 'index']);
Route::post('slider/restore', [SliderController::class, 'restore']);
Route::delete('slider/delete', [SliderController::class, 'destroy']);
Route::put('/slider/{id}/{column}', [SliderController::class, 'toggle']);
Route::delete('slider/force-delete', [SliderController::class, 'forceDelete']);
Route::apiResource('slider', SliderController::class);

//////////////////////////////////////// Slider ////////////////////////////////



//////////////////////////////////////// About ////////////////////////////////

Route::post('about/index', [AboutController::class, 'index']);
Route::post('about/restore', [AboutController::class, 'restore']);
Route::delete('about/delete', [AboutController::class, 'destroy']);
Route::put('/about/{id}/{column}', [AboutController::class, 'toggle']);
Route::delete('about/force-delete', [AboutController::class, 'forceDelete']);
Route::apiResource('about', AboutController::class);

//////////////////////////////////////// About ////////////////////////////////



//////////////////////////////////////// Expo Company ////////////////////////////////

Route::post('/expo-company/index', [ExpoCompanyController::class, 'index']);
Route::post('expo-company/restore', [ExpoCompanyController::class, 'restore']);
Route::delete('expo-company/delete', [ExpoCompanyController::class, 'destroy']);
Route::delete('expo-company/force-delete', [ExpoCompanyController::class, 'forceDelete']);
Route::put('/expo-company/{id}/{column}', [ExpoCompanyController::class, 'toggle']);
Route::apiResource('expo-company', ExpoCompanyController::class);
//////////////////////////////////////// Expo Company ////////////////////////////////


//////////////////////////////////////// company ////////////////////////////////
Route::post('/company/index', [CompanyController::class, 'index']);
Route::post('company/restore', [CompanyController::class, 'restore']);
Route::delete('company/delete', [CompanyController::class, 'destroy']);
Route::delete('company/force-delete', [CompanyController::class, 'forceDelete']);
Route::put('/company/{id}/{column}', [CompanyController::class, 'toggle']);
Route::apiResource('company', CompanyController::class);

//////////////////////////////////////// company ////////////////////////////////



//////////////////////////////////////// Service ////////////////////////////////
Route::post('/service/index', [ServiceController::class, 'index']);
Route::post('service/restore', [ServiceController::class, 'restore']);
Route::delete('service/delete', [ServiceController::class, 'destroy']);
Route::delete('service/force-delete', [ServiceController::class, 'forceDelete']);
Route::put('/service/{id}/{column}', [ServiceController::class, 'toggle']);
Route::apiResource('service', ServiceController::class);
Route::get('get-service/{slug}', [ServiceController::class, 'showPublic']);

//////////////////////////////////////// Service ////////////////////////////////



////////////////////////////////////////// Admin ////////////////////////////////
Route::post('/admin/index', [AdminController::class, 'index']);
Route::post('admin/restore', [AdminController::class, 'restore']);
Route::delete('admin/delete', [AdminController::class, 'destroy']);
Route::delete('admin/force-delete', [AdminController::class, 'forceDelete']);
Route::put('/admin/{id}/{column}', [AdminController::class, 'toggle']);
Route::post('/admin-select', [AdminController::class, 'index']);
Route::post('/admin-logout', [AdminController::class, 'logout']);
Route::get('/get-admin', [AdminController::class, 'getCurrentAdmin']);
Route::apiResource('admin', AdminController::class);

Route::post('/admin/login', [AdminController::class, 'login']);
////////////////////////////////////////// Admin ////////////////////////////////


Route::group(['middleware' => ['api']], static function () {
    Route::get('/media', [MediaController::class, 'index']);
    Route::get('/media/{media}', [MediaController::class, 'show']);
    Route::post('/media', [MediaController::class, 'store']);
    Route::delete('/media/{media}', [MediaController::class, 'destroy']);
    Route::get('/get-unused-media', [MediaController::class, 'getUnUsedImages']);
    Route::delete('/delete-unused-media', [MediaController::class, 'deleteUnUsedImages']);
});
Route::get('/get-media/{media}', [MediaController::class, 'show']);
Route::post('/media-array', [MediaController::class, 'showMedia']);
Route::post('/media-upload-many', [MediaController::class, 'storeMany']);


//////////////////////////////////////// faq ////////////////////////////////

Route::post('/faq/index', [FAQController::class, 'index']);
Route::post('faq/restore', [FAQController::class, 'restore']);
Route::delete('faq/delete', [FAQController::class, 'destroy']);
Route::delete('faq/force-delete', [FAQController::class, 'forceDelete']);
Route::put('/faq/{id}/{column}', [FAQController::class, 'toggle']);
Route::apiResource('faq', FAQController::class);


//////////////////////////////////////// faq ////////////////////////////////


//////////////////////////////////////// PageContactUs ////////////////////////////////

Route::post('/page-contact-us/index', [PageContactUsController::class, 'index']);
Route::post('page-contact-us/restore', [PageContactUsController::class, 'restore']);
Route::delete('page-contact-us/delete', [PageContactUsController::class, 'destroy']);
Route::delete('page-contact-us/force-delete', [PageContactUsController::class, 'forceDelete']);
Route::put('/page-contact-us/{id}/{column}', [PageContactUsController::class, 'toggle']);
Route::apiResource('page-contact-us', PageContactUsController::class);


//////////////////////////////////////// PageContactUs ////////////////////////////////



//////////////////////////////////////// ContactUs ////////////////////////////////
Route::post('/contactus/index', [ContactUsController::class, 'index']);
Route::post('contactus/restore', [ContactUsController::class, 'restore']);
Route::delete('contactus/delete', [ContactUsController::class, 'destroy']);
Route::delete('contactus/force-delete', [ContactUsController::class, 'forceDelete']);
Route::put('/contactus/{id}/{column}', [ContactUsController::class, 'toggle']);
Route::apiResource('contactus', ContactUsController::class);
Route::post('contact-us-public', [ContactUsController::class, 'store'])->middleware('throttle:3,1');

//////////////////////////////////////// ContactUs ////////////////////////////////



//////////////////////////////////////// job ////////////////////////////////
Route::post('/job/index', [JobController::class, 'index']);
Route::post('job/restore', [JobController::class, 'restore']);
Route::delete('job/delete', [JobController::class, 'destroy']);
Route::delete('job/force-delete', [JobController::class, 'forceDelete']);
Route::put('/job/{id}/{column}', [JobController::class, 'toggle']);
Route::apiResource('job', JobController::class);
Route::post('job-public', [JobController::class, 'store'])->middleware('throttle:3,1');

//////////////////////////////////////// job ////////////////////////////////





Route::post('/logo-company/index', [LogoCompanyController::class, 'index']);
Route::post('logo-company/restore', [LogoCompanyController::class, 'restore']);
Route::delete('logo-company/delete', [LogoCompanyController::class, 'destroy']);
Route::delete('logo-company/force-delete', [LogoCompanyController::class, 'forceDelete']);
Route::put('/logo-company/{id}/{column}', [LogoCompanyController::class, 'toggle']);
Route::apiResource('logo-company', LogoCompanyController::class);

Route::get('/get-logo-company/public', [LogoCompanyController::class, 'indexPublic']);
Route::get('/get-expo-list', [LogoCompanyController::class, 'indexPublicExpo']);


//////////////////////////////////////// package ////////////////////////////////

Route::post('/package/index', [PackageController::class, 'index']);
Route::post('package/restore', [PackageController::class, 'restore']);
Route::delete('package/delete', [PackageController::class, 'destroy']);
Route::delete('package/force-delete', [PackageController::class, 'forceDelete']);
Route::put('/package/{id}/{column}', [PackageController::class, 'toggle']);
Route::apiResource('package', PackageController::class);

Route::get('/get-package/public', [PackageController::class, 'indexPublic']);


//////////////////////////////////////// Expo Company ////////////////////////////////

Route::post('/expo-company/index', [ExpoCompanyController::class, 'index']);
Route::post('expo-company/restore', [ExpoCompanyController::class, 'restore']);
Route::delete('expo-company/delete', [ExpoCompanyController::class, 'destroy']);
Route::delete('expo-company/force-delete', [ExpoCompanyController::class, 'forceDelete']);
Route::put('/expo-company/{id}/{column}', [ExpoCompanyController::class, 'toggle']);
Route::apiResource('expo-company', ExpoCompanyController::class);
