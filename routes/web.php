<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator;




/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
|
*/

Route::get('/admin/panel' , [App\Http\Controllers\Back\DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/login' , [App\Http\Controllers\Back\AuthController::class, 'login'])->name('admin.login');



/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
|
|
*/

Route::get('/', [App\Http\Controllers\Front\HomepageController::class, 'index'])->name('homepage');
Route::get('/iletisim', [App\Http\Controllers\Front\HomepageController::class, 'contact'])->name('contact');
Route::post('/iletisim', [App\Http\Controllers\Front\HomepageController::class, 'contactPost'])->name('contact.post');
Route::get('/sayfa', [App\Http\Controllers\Front\HomepageController::class, 'index']);
Route::get('/kategori/{category}', [App\Http\Controllers\Front\HomepageController::class, 'category'])->name('category');
Route::get('/{category}/{slug}', [App\Http\Controllers\Front\HomepageController::class, 'post'])->name('post');
Route::get('/{sayfa}', [App\Http\Controllers\Front\HomepageController::class, 'page'])->name('page');
Route::get('/iletisim', [App\Http\Controllers\Front\HomepageController::class, 'contact'])->name('contact');


