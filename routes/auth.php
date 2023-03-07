<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

use App\Actions\LoginView;
use App\Actions\LoginUser;
use App\Actions\LogoutUser;
use App\Actions\RegisterUserView;
use App\Actions\RegisteriUserCreate;
use App\Actions\PasswordResetView;
use App\Actions\PasswordResetSend;
use App\Actions\NewPasswordView;
use App\Actions\NewPasswordCreate;
use App\Actions\ConfirmablePasswordView;
use App\Actions\ConfirmablePasswordCreate;
use App\Actions\EmailVerificationCheck;
use App\Actions\VerifyEmailCreate;
use App\Actions\VerifyEmailNotif;

//actions
Route::get('login', LoginView::class)->name('login');
Route::post('login', LoginUser::class);
Route::post('logout', LogoutUser::class)->name('logout');

Route::get('register', RegisterUserView::class)->name('register');
Route::post('register', RegisteriUserCreate::class);

Route::get('forgot-password', PasswordResetView::class)
			->name('password.request');
Route::get('forgot-password', PaswordResetSend::class)
			->name('password.email');

Route::get('reset-password/{token}', NewPasswordView::class)
			->name('password.reset');
Route::post('reset-password', NewPasswordCreate::class)
			->name('password.update');

Route::post('confirm-password', ConfirmablePasswordView::class)
			->name('password.confirm');
Route::post('confirm-password', ConfirmablePasswordCreate::class);

Route::get('verify-email', EmailVerificationCheck::class)
			->name('verification.notice');

Route::get('verify-email/{id}/{hash}', VerifyEmailCreate::class)
			->name('verification.verify');

Route::post('email/verification-notification', VerifyEmailNotif::class)
			->name('verification.send');
