<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\EducationDetailsController;
use App\Http\Controllers\FundingDetailsController;
use App\Http\Controllers\GuarantorDetailsController;
use App\Http\Controllers\FinancialAssistanceController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FinalSubmissionController;

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
Route::get('/guarantor-details', [GuarantorDetailsController::class, 'index'])->name('guarantor-details');
Route::post('/guarantor-details', [GuarantorDetailsController::class, 'store'])->name('guarantor-details.store');
Route::get('/guarantor-details/{submissionId}/edit', [GuarantorDetailsController::class, 'edit'])->name('guarantor-details.edit');
Route::delete('/guarantor-details/{submissionId}', [GuarantorDetailsController::class, 'destroy'])->name('guarantor-details.destroy');
Route::get('/documents', [DocumentController::class, 'index'])->name('documents');
Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
Route::get('/documents/{submissionId}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
Route::delete('/documents/{submissionId}', [DocumentController::class, 'destroy'])->name('documents.destroy');
Route::get('/final-submission', [FinalSubmissionController::class, 'index'])->name('final-submission');
Route::post('/final-submission', [FinalSubmissionController::class, 'store'])->name('final-submission.store');
Route::get('/financial-assistance/{id}/edit', [FinancialAssistanceController::class, 'edit'])->name('financial-assistance.edit');
Route::get('/financial-assistance/{id}/print', [FinancialAssistanceController::class, 'print'])->name('financial-assistance.print');
Route::post('/financial-assistance/draft', [FinancialAssistanceController::class, 'saveDraft'])->name('financial-assistance.draft');

// Delete application route
Route::delete('/delete-application/{submissionId}', [FinancialAssistanceController::class, 'deleteApplication'])->name('delete-application');

// API Routes for Demo Form
Route::prefix('api')->group(function () {
    Route::post('/demo/submit', [DemoController::class, 'apiSubmit'])->name('api.demo.submit');
    Route::post('/resume-session', [FinancialAssistanceController::class, 'resumeSession'])->name('api.resume-session');
    Route::post('/clear-session', [FinancialAssistanceController::class, 'clearSession'])->name('api.clear-session');
});

// Test route for debugging
Route::get('/test-guarantor', function () {
    return view('test-guarantor');
});
Route::post('/test-guarantor', [App\Http\Controllers\TestController::class, 'testGuarantor']);
