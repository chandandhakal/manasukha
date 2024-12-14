<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\TherapistController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\TherapistAppointmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

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
    Route::get('/therapist/appointments', [TherapistAppointmentController::class, 'index'])
        ->name('therapist.appointments.index');
    Route::patch('/therapist/appointments/{appointment}/status', [TherapistAppointmentController::class, 'updateStatus'])
        ->name('therapist.appointments.update-status');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    Route::get('/therapists', [TherapistController::class, 'index'])->name('therapists.index');
});
