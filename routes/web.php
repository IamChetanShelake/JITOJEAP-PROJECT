<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\EducationDetailsController;
use App\Http\Controllers\FundingDetailsController;
use App\Http\Controllers\FinancialAssistanceController;
use App\Http\Controllers\MainController;

// Main Page Route
Route::get('/', [MainController::class, 'index'])->name('main');

// Additional Main Page Routes
Route::get('/search', [MainController::class, 'search'])->name('main.search');
Route::get('/create-form', [MainController::class, 'createForm'])->name('main.create-form');

// Welcome Page (keep for reference)
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Demo Form Routes
Route::get('/demo', [DemoController::class, 'index'])->name('demo');
Route::post('/demo/submit', [DemoController::class, 'submit'])->name('demo.submit');

// Financial Assistance Routes
Route::get('/financial-assistance', [FinancialAssistanceController::class, 'index'])->name('financial-assistance');
Route::get('/family-details', [FinancialAssistanceController::class, 'familyDetails'])->name('family-details');
Route::get('/education-details', [EducationDetailsController::class, 'index'])->name('education-details');
Route::post('/financial-assistance', [FinancialAssistanceController::class, 'store'])->name('financial-assistance.store');
Route::post('/family-details', [FinancialAssistanceController::class, 'storeFamilyDetails'])->name('family-details.store');
Route::post('/education-details', [EducationDetailsController::class, 'store'])->name('education-details.store');
Route::get('/education-details/{submissionId}/edit', [EducationDetailsController::class, 'edit'])->name('education-details.edit');
Route::delete('/education-details/{submissionId}', [EducationDetailsController::class, 'destroy'])->name('education-details.destroy');
Route::get('/funding-details', [FundingDetailsController::class, 'index'])->name('funding-details');
Route::post('/funding-details', [FundingDetailsController::class, 'store'])->name('funding-details.store');
Route::get('/funding-details/{submissionId}/edit', [FundingDetailsController::class, 'edit'])->name('funding-details.edit');
Route::delete('/funding-details/{submissionId}', [FundingDetailsController::class, 'destroy'])->name('funding-details.destroy');
Route::get('/financial-assistance/{id}/edit', [FinancialAssistanceController::class, 'edit'])->name('financial-assistance.edit');
Route::get('/financial-assistance/{id}/print', [FinancialAssistanceController::class, 'print'])->name('financial-assistance.print');
Route::post('/financial-assistance/draft', [FinancialAssistanceController::class, 'saveDraft'])->name('financial-assistance.draft');

// API Routes for Demo Form
Route::prefix('api')->group(function () {
    Route::post('/demo/submit', [DemoController::class, 'apiSubmit'])->name('api.demo.submit');
    Route::post('/resume-session', [FinancialAssistanceController::class, 'resumeSession'])->name('api.resume-session');
    Route::post('/clear-session', [FinancialAssistanceController::class, 'clearSession'])->name('api.clear-session');
});
