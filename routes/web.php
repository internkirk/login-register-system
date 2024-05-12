<?php

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\MagicLinkController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginWithProviderController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware(['verified','auth'])->name('home');

Route::prefix('auth')->group(function () {
    Route::get('/register-form', [RegisteredUserController::class, 'showRegisterForm'])->name('auth.register.form');
    Route::post('/register-store',[RegisteredUserController::class, 'store'])->name('auth.register');
    Route::get('/login',[AuthenticatedSessionController::class, 'showLoginForm'])->name('auth.login.form');
    Route::post('/login',[AuthenticatedSessionController::class, 'login'])->name('auth.login');
    Route::get('/logout',[AuthenticatedSessionController::class, 'logout'])->name('logout');
    Route::get('/send-email-verification',[EmailVerificationController::class, 'send'])->name('email.send.verification');
    Route::get('/email-veify',[EmailVerificationController::class, 'verify'])->name('verify.email');
    Route::get('/forget-password',[PasswordResetLinkController::class,'showResetPasswordForm'])->name('auth.forget.password.form');
    Route::post('/forget-password',[PasswordResetLinkController::class,'sendResetPasswordLink'])->name('auth.forget.password');
    Route::get('/reset-password',[PasswordResetLinkController::class,'resetPasswordForm'])->name('auth.reset.password.form');
    Route::post('/reset-password',[PasswordResetLinkController::class,'resetPassword'])->name('auth.reset.password');
    Route::get('/login-with/{provider}',[LoginWithProviderController::class, 'redirectToProvider'])->name('auth.redirect.to.provider');
    Route::get('/{provider}/callback',[LoginWithProviderController::class, 'loginWithProvider'])->name('auth.login.with.provider');
    Route::get('/magic-link-form',[MagicLinkController::class, 'showForm'])->name('auth.show.magic.link.form');
    Route::post('/magic-link/request',[MagicLinkController::class, 'sendToken'])->name('auth.send.magic.request');
    Route::get('/magic-link/verify',[MagicLinkController::class, 'verifyToken'])->name('auth.verify.magic.link');
    Route::get('/two-factor',[TwoFactorController::class, 'showForm'])->name('auth.two.factor.form');
    Route::post('/two-factor/activate',[TwoFactorController::class, 'activate'])->name('auth.two.factor.activate');
    Route::post('/two-factor/deactivate',[TwoFactorController::class, 'deactivate'])->name('auth.two.factor.deactivate');
    Route::get('/two-factor/login/{email}',[TwoFactorController::class, 'showLoginForm'])->name('auth.two.factor.login.form');
    Route::post('/two-factor/login',[TwoFactorController::class, 'validatePassword'])->name('auth.two.factor.login');
});
