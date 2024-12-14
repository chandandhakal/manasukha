<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssessmentController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/signup', [App\Http\Controllers\AuthController::class, 'showSignupForm'])->name('signup.form');
Route::post('/signup', [App\Http\Controllers\AuthController::class, 'signup'])->name('signup');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::middleware(['auth', 'not.therapist'])->group(function () {
    Route::get('/assessment', [AssessmentController::class, 'showQuestionnaire'])->name('assessment.show');
    Route::post('/assessment', [AssessmentController::class, 'submitQuestionnaire'])->name('assessment.submit');
    Route::get('/assessment/results', [AssessmentController::class, 'showResults'])->name('assessment.results');
});
