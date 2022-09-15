<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\RegisterController;
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

Route::view('/', 'welcome')->name('home');

Route::view('register', 'register.create')->name('register.page');
Route::post('register', [RegisterController::class, 'register'])->name('register');

Route::middleware('auth')->group(function () {
	Route::view('/email/verify', 'auth.verify-email')->name('verification.notice');
	Route::view('/email/verified', 'auth.email-verified')->name('verification.verified');

	Route::group(['controller' => VerificationController::class], function () {
		Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify')->middleware(['signed']);
		Route::post('/email/verification-notification', 'resend')->name('verification.send')->middleware(['throttle:6,1']);
	});
});

Route::get('change-locale/{locale}', [LanguageController::class, 'change'])->name('locale.change');
