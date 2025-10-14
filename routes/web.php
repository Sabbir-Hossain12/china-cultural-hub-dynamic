<?php

use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Web\AiController;
use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;

// home route
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('page/{slug}', [HomeController::class, 'pagedata'])->name('page');
Route::post('/search',[HomeController::class, 'search'])->name('search');

Route::get('category-details/{slug}',[HomeController::class, 'categoryDetails'])->name('categoryDetails');

//Core
Route::get('/geography',[HomeController::class, 'geography'])->name('geography');
Route::get('/history', [HomeController::class, 'history'])->name('history');
Route::get('/tradition',[HomeController::class, 'tradition'])->name('tradition');
Route::get('/lives',[HomeController::class, 'lives'])->name('lives');
Route::get('/technology',[HomeController::class, 'technology'])->name('technology');
Route::get('/china-migration',[HomeController::class, 'chinaMigration'])->name('chinaMigration');
Route::get('/collision',[HomeController::class,'collision'])->name('collision');
Route::get('/modern',[HomeController::class,'modern'])->name('modern');
Route::get('/contemporary',[HomeController::class,'contemporary'])->name('contemporary');
Route::get('/political',[HomeController::class,'political'])->name('political');
Route::get('/community',[HomeController::class,'community'])->name('community');




Route::view('demo', 'frontend.content.category-details');
//ChatGPT
Route::get('/ai-assistant', [AiController::class,'aiAssistant'])->name('ai-assistant');

Route::post('/chat',AiController::class)->name('chat');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
