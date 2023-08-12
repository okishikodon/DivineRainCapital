<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\FileDisplayController;
use App\Http\Controllers\PublicFileController;

Route::get('/', function () {
    return view('welcome');
});

// public routes (no authentication required)
Route::prefix('public')->group(function () {
    Route::get('/pitch-deck', [PublicFileController::class, 'showPitchDeck'])->name('public.pitch-deck');
    Route::get('/reports', [PublicFileController::class, 'showReports'])->name('public.reports');
});

// upload routes for public files (if needed)
Route::middleware(['auth'])->group(function () {
    Route::post('/public/upload-pitch-deck', [PublicFileController::class, 'uploadPitchDeck'])->name('public.upload.pitch-deck');
    Route::post('/public/upload-report', [PublicFileController::class, 'uploadReport'])->name('public.upload.report');
});

// Authenticated routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware(['auth'])->group(function () {
        Route::prefix('investor')->group(function () {
            Route::get('/private-documents', [InvestorController::class, 'privateDocuments'])->name('investor.private-documents');
            Route::get('/legal-disclaimers', [InvestorController::class, 'legalDisclaimers'])->name('investor.legal-disclaimers');
            Route::get('/performance', [InvestorController::class, 'performance'])->name('investor.performance');
            Route::get('/investor-reports', [InvestorController::class, 'investorReports'])->name('investor.investor-reports');
            Route::get('/fund-information', [InvestorController::class, 'fundInformation'])->name('investor.fund-information');
            // add routes here
        });

        Route::get('/files/{category}', [FileDisplayController::class, 'show'])->name('files.show')->middleware('auth');
        Route::get('/files/show/{category}/{file}', [FileDisplayController::class, 'showSingle'])->name('files.show.single');

        // route for uploads
        Route::post('/upload', [FileUploadController::class, 'store'])->name('upload.store')->middleware('auth');
    });
});
