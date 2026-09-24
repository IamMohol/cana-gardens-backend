<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\HealthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - Cana Gardens
|--------------------------------------------------------------------------
|
| Base URL in production: https://api.canagardens.co.ke/api
|
*/

// Health Check Endpoint
Route::get('/health', [HealthController::class, 'index'])->name('api.health');

// Contact Form Endpoint with Rate Limiting (10 requests per minute per IP)
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('api.contact');

// Legacy alias for contact inquiries
Route::post('/inquiries', [ContactController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('api.inquiries');

// Public Data Endpoints
Route::get('/home-data', [HomeController::class, 'index'])->name('api.home-data');
Route::get('/gallery', [GalleryController::class, 'index'])->name('api.gallery');
Route::get('/blog', [BlogController::class, 'index'])->name('api.blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('api.blog.show');

// Authenticated User Endpoint
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
