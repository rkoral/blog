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


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function(){	
	Route::get('/login' , [App\Http\Controllers\Back\AuthController::class, 'login'])->name('login')->withoutMiddleware('auth');
	Route::post('/login' , [App\Http\Controllers\Back\AuthController::class, 'loginPost'])->name('login.post')->withoutMiddleware('auth');
	Route::get('/logout', [App\Http\Controllers\Back\AuthController::class, 'logout'])->name('logout');
	Route::get('/panel' , [App\Http\Controllers\Back\DashboardController::class, 'index'])->name('dashboard');
	Route::resource('/makaleler' , App\Http\Controllers\Back\ArticleController::class);
});




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


