<?php

use App\Http\Controllers\Admin\CarRentalImageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleRedirectController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\VerificationController;
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

// Route::get('/', [HomeController::class, 'index'])
//     ->name('home');

// Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'id|en']], function () {
//     Route::get('/', [HomeController::class, 'index'])->name('home');
// });

// Route::group(['prefix' => '{locale}'], function () {
//     Route::get('/', [HomeController::class, 'index'])->name('home');
// });

Route::get('/', [LocaleRedirectController::class, 'redirect']);


Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => 'id|en'],
    // 'middleware' => 'setlocale'
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/bintan-tour-packages', [HomeController::class, 'index'])->name('tour');
    Route::get('/bintan-taxi-service', [HomeController::class, 'index'])->name('taxi');
    Route::get('/bintan-car-rental', [HomeController::class, 'index'])->name('rental');
    Route::get('/bintan-staycation', [HomeController::class, 'index'])->name('stay');
    Route::get('/bintan-hotel-package', [HomeController::class, 'index'])->name('stay-hotel');

});


Route::get('/detail/{slug}', [DetailController::class, 'index'])
    ->name('detail');

Route::post('/checkout/{id}', [CheckoutController::class, 'process'])
    ->name('checkout_process')
    ->middleware(['auth','verified']);

Route::get('/checkout/{id}', [CheckoutController::class, 'index'])
    ->name('checkout')
    ->middleware(['auth','verified']);

Route::post('/checkout/create/{detail_id}', [CheckoutController::class, 'create'])
    ->name('checkout-create')
    ->middleware(['auth','verified']);

Route::get('/checkout/remove/{detail_id}', [CheckoutController::class, 'remove'])
    ->name('checkout-remove')
    ->middleware(['auth','verified']);

Route::get('/checkout/confirm/{id}', [CheckoutController::class, 'success'])
    ->name('checkout-success')
    ->middleware(['auth','verified']);

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function() {
        Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('travel-package', \App\Http\Controllers\Admin\TravelPackageController::class);
        Route::resource('gallery', \App\Http\Controllers\Admin\GalleryController::class);
        Route::resource('transaction', \App\Http\Controllers\Admin\TransactionController::class);
        Route::resource('destination', \App\Http\Controllers\Admin\DestinationController::class);
        // Package Travel
        Route::resource('package-travel', \App\Http\Controllers\Admin\PackageTravelController::class);

        Route::get('/package-travel/dest/{id}', [\App\Http\Controllers\Admin\PackageTravelController::class, 'getPackageDestById'])->name('package-travel.dest');
        Route::post('/package-travel/dest', [\App\Http\Controllers\Admin\PackageTravelController::class, 'storePackageDest'])->name('package-travel-dest.store');
        Route::post('/package-travel/dest/{id}', [\App\Http\Controllers\Admin\PackageTravelController::class, 'deletePackageDest'])->name('package-travel.dest.delete');

        Route::get('/package-travel/price/{id}', [\App\Http\Controllers\Admin\PackageTravelController::class, 'getAllPackagePricesById'])->name('package-travel.price');
        Route::post('/package-travel/price/store', [\App\Http\Controllers\Admin\PackageTravelController::class, 'storePackagePrice'])->name('package-travel.price.store');
        Route::put('/package-travel/price/update/{id}', [\App\Http\Controllers\Admin\PackageTravelController::class, 'updatePackagePrice'])->name('package-travel.price.update');
        Route::post('/package-travel/price/delete/{id}', [\App\Http\Controllers\Admin\PackageTravelController::class, 'deletePackagePrice'])->name('package-travel.price.delete');


        Route::get('/package-travel/image/{id}', [\App\Http\Controllers\Admin\PackageTravelController::class, 'getPackageImageById'])->name('package-travel.image');
        Route::post('/package-travel/image/store', [\App\Http\Controllers\Admin\PackageTravelController::class, 'storeImage'])->name('package-travel.image.store');
        Route::post('/package-travel/image/update', [\App\Http\Controllers\Admin\PackageTravelController::class, 'updateImage'])->name('package-travel.image.update');
        Route::post('/package-travel/image/delete/{id}', [\App\Http\Controllers\Admin\PackageTravelController::class, 'deleteImage'])->name('package-travel.image.delete');


        Route::get('/package-travel/incl/{id}', [\App\Http\Controllers\Admin\PackageTravelController::class, 'getPackageInclById'])->name('package-travel.incl');
        Route::post('/package-travel/incl', [\App\Http\Controllers\Admin\PackageTravelController::class, 'storePackageIncl'])->name('package-travel-incl.store');
        Route::post('/package-travel/incl/delete/{id}', [\App\Http\Controllers\Admin\PackageTravelController::class, 'deletePackageIncl'])->name('package-travel.incl.delete');


        Route::get('/package-travel/excl/{id}', [\App\Http\Controllers\Admin\PackageTravelController::class, 'getPackageExclById'])->name('package-travel.excl');
        Route::post('/package-travel/excl', [\App\Http\Controllers\Admin\PackageTravelController::class, 'storePackageExcl'])->name('package-travel-excl.store');
        Route::post('/package-travel/excl/delete/{id}', [\App\Http\Controllers\Admin\PackageTravelController::class, 'deletePackageExcl'])->name('package-travel.excl.delete');

        // Package Stay
        Route::resource('package-stay', \App\Http\Controllers\Admin\PackageStayController::class);

        Route::get('/package-stay/price/{id}', [\App\Http\Controllers\Admin\PackageStayController::class, 'getAllPackagePricesById'])->name('package-stay.price');
        Route::post('/package-stay/price/store', [\App\Http\Controllers\Admin\PackageStayController::class, 'storePackagePrice'])->name('package-stay.price.store');
        Route::put('/package-stay/price/update/{id}', [\App\Http\Controllers\Admin\PackageStayController::class, 'updatePackagePrice'])->name('package-stay.price.update');
        Route::post('/package-stay/price/delete/{id}', [\App\Http\Controllers\Admin\PackageStayController::class, 'deletePackagePrice'])->name('package-stay.price.delete');

        Route::get('/package-stay/image/{id}', [\App\Http\Controllers\Admin\PackageStayController::class, 'getAllPackageImageById'])->name('package-stay.image');
        Route::post('/package-stay/image/store', [\App\Http\Controllers\Admin\PackageStayController::class, 'storeImage'])->name('package-stay.image.store');
        Route::post('/package-stay/image/update', [\App\Http\Controllers\Admin\PackageStayController::class, 'updateImage'])->name('package-stay.image.update');
        Route::post('/package-stay/image/delete/{id}', [\App\Http\Controllers\Admin\PackageStayController::class, 'deleteImage'])->name('package-stay.image.delete');

        Route::get('/package-stay/incl/{id}', [\App\Http\Controllers\Admin\PackageStayController::class, 'getAllPackageInclsById'])->name('package-stay.incl');
        Route::post('/package-stay/incl', [\App\Http\Controllers\Admin\PackageStayController::class, 'storePackageIncl'])->name('package-stay-incl.store');
        Route::post('/package-stay/incl/delete/{id}', [\App\Http\Controllers\Admin\PackageStayController::class, 'deletePackageIncl'])->name('package-stay.incl.delete');

        // Car Rental Service
        Route::resource('car-rental', \App\Http\Controllers\Admin\CarRentalController::class);

        // Taxi Service
        Route::resource('taxi', \App\Http\Controllers\Admin\TaxiController::class);


        Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
            // ...existing routes...
            
            // Car Rental Image Routes
            Route::post('/car-rental-image/store', [CarRentalImageController::class, 'store'])->name('car-rental-image.store');
            Route::get('/car-rental-image/list', [CarRentalImageController::class, 'list'])->name('car-rental-image.list');
            Route::delete('/car-rental-image/{id}', [CarRentalImageController::class, 'destroy'])->name('car-rental-image.destroy');
        });
    });

// Authentication Routes
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

Route::post('/password/confirm', [ConfirmPasswordController::class, 'confirm'])->name('password.confirm');
Route::get('/password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');

Route::post('/email/verification-notification', [VerificationController::class, 'resend'])->name('verification.send');
Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
