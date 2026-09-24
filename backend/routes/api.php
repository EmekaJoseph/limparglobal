<?php

use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\SecurityController;
use App\Http\Controllers\Api\Admin\SettingsController;
use App\Http\Controllers\Api\Admin\SiteVisitController as AdminSiteVisitController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployerRequestController;
use App\Http\Controllers\Api\SiteVisitController;
use App\Http\Controllers\Api\TalentApplicationController;
use Illuminate\Support\Facades\Route;

// Admin login. Throttled to slow down credential-guessing attempts.
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:6,1');

// Public form-submission and instrumentation endpoints, called by the frontend.
Route::post('/talent-applications', [TalentApplicationController::class, 'store'])->middleware('throttle:20,1');
Route::post('/employer-requests', [EmployerRequestController::class, 'store'])->middleware('throttle:20,1');
Route::post('/track-visit', [SiteVisitController::class, 'track'])->middleware('throttle:60,1');

// Authenticated admin routes.
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::get('/settings', [SettingsController::class, 'show']);
        Route::put('/settings', [SettingsController::class, 'update']);

        Route::put('/security/password', [SecurityController::class, 'updatePassword']);

        Route::get('/visitors', [AdminSiteVisitController::class, 'index']);

        Route::get('/talent-applications', [TalentApplicationController::class, 'index']);
        Route::get('/talent-applications/{talentApplication}', [TalentApplicationController::class, 'show']);
        Route::patch('/talent-applications/{talentApplication}', [TalentApplicationController::class, 'update']);
        Route::delete('/talent-applications/{talentApplication}', [TalentApplicationController::class, 'destroy']);
        Route::get('/talent-applications/{talentApplication}/cv', [TalentApplicationController::class, 'downloadCv']);

        Route::get('/employer-requests', [EmployerRequestController::class, 'index']);
        Route::get('/employer-requests/{employerRequest}', [EmployerRequestController::class, 'show']);
        Route::patch('/employer-requests/{employerRequest}', [EmployerRequestController::class, 'update']);
        Route::delete('/employer-requests/{employerRequest}', [EmployerRequestController::class, 'destroy']);
        Route::get('/employer-requests/{employerRequest}/jd', [EmployerRequestController::class, 'downloadJd']);
    });
});
