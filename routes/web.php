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

Route::middleware(['auth'])->group(function () {
    Route::get('/assessment', [AssessmentController::class, 'index'])->name('assessment.index');
    Route::get('/assessment/results', [AssessmentController::class, 'showResults'])->name('assessment.results');
    Route::get('/assessment/{type}', [AssessmentController::class, 'showQuestionnaire'])->name('assessment.show');
    Route::get('/assessment/{type}/submit', [AssessmentController::class, 'submitQuestionnaire'])->name('assessment.submit');
    Route::get('/assessment/{type}/question/{number}', [AssessmentController::class, 'showQuestion'])->name('assessment.question');
    Route::post('/assessment/{type}/question/{number}', [AssessmentController::class, 'saveAnswer'])->name('assessment.save-answer');
});
