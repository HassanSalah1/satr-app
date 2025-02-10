<?php
use App\Http\Controllers\Api\SpeechController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\DonationController;
use App\Http\Controllers\Api\ContactUsController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::get('/speeches', [SpeechController::class, 'index']);
    Route::get('/speeches/{speech}', [SpeechController::class, 'show']);

    Route::get('/pages', [PageController::class, 'index']);
    Route::get('/pages/{slug}', [PageController::class, 'show']);

    Route::get('/donations', [DonationController::class, 'index']);
    Route::get('/donations/{donation}', [DonationController::class, 'show']);

    Route::post('/contact-us', [ContactUsController::class, 'store']);
});

