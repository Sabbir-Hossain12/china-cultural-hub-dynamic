<?php

use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Web\AiController;
use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;

// home route
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('page/{slug}', [HomeController::class, 'pagedata']);
Route::get('shop-by-category', [HomeController::class, 'shopbycategory']);

Route::get('image-upload', [ImageController::class, 'index']);
Route::post('image-upload', [ImageController::class, 'store'])->name('image.store');

//ChatGPT
Route::get('/ai-assistant', [AiController::class,'aiAssistant'])->name('ai-assistant');

Route::post('/chat',AiController::class)->name('chat');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
