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
//ayrı grup yaptık çünkü login ve isAdmin middleware'i arasında sonsuz döngü oldu hata verdi. 
Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function(){
	Route::get('/login' , [App\Http\Controllers\Back\AuthController::class, 'login'])->name('login');
	Route::post('/login' , [App\Http\Controllers\Back\AuthController::class, 'loginPost'])->name('login.post');
});


Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
	Route::get('/panel' , [App\Http\Controllers\Back\DashboardController::class, 'index'])->name('dashboard');

	Route::get('/logout', [App\Http\Controllers\Back\AuthController::class, 'logout'])->name('logout');




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


