<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\VerificationController;
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

Route::get('/', [DashboardController::class, 'showWorldwide'])->name('home')->middleware(['auth', 'verified']);

Route::middleware('guest')->group(function () {
	Route::view('/register', 'auth.register')->name('register.page');
	Route::view('/login', 'auth.login')->name('login.page');

	Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
	Route::view('/forgot-password/verify', 'auth.password-verify')->name('password.notice');
	Route::view('/forgot-password/verified', 'auth.password-verified')->name('password.verified');

	Route::group(['controller' => PasswordResetController::class], function () {
		Route::post('/forgot-password', 'send')->name('password.send');
		Route::get('/reset-password/{token}', 'reset')->name('password.reset');
		Route::post('/reset-password', 'update')->name('password.update');
	});
});

Route::group(['controller' => AuthController::class], function () {
	Route::middleware('guest')->group(function () {
		Route::post('/register', 'register')->name('register');
		Route::post('/login', 'login')->name('login');
	});

	Route::post('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::middleware('auth')->group(function () {
	Route::view('/email/verify', 'auth.verify-email')->name('verification.notice');
	Route::view('/email/verified', 'auth.email-verified')->name('verification.verified');

	Route::group(['controller' => VerificationController::class], function () {
		Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify')->middleware('signed');
		Route::post('/email/verification-notification', 'resend')->name('verification.send')->middleware('throttle:6,1');
	});
});

Route::get('/change-locale/{locale}', [LanguageController::class, 'change'])->name('locale.change');
