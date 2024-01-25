<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



// Controller

// Admin
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ComicController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\ChapterController;


// Client
use App\Http\Controllers\IndexController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index']);

Auth::routes();

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');


Route::middleware('auth')->resource('categories', CategoryController::class);
Route::middleware('auth')->resource('comics', ComicController::class);
Route::middleware('auth')->resource('books', BookController::class);

// Status
Route::post('/outstanding', [ComicController::class, 'outstanding'])->name('outstanding');
Route::post('/full', [ComicController::class, 'full'])->name('full');

Route::resource('chapters', ChapterController::class);

Route::get('/trang-chu', [IndexController::class, 'index'])->name('trang-chu');

// search high leave
Route::post('search-ajax', [IndexController::class, 'search_ajax'])->name('search-ajax');
Route::post('/search', [IndexController::class, 'search'])->name('search');
Route::get('/keywords/{slug}', [IndexController::class, 'keywords'])->name('keywords');
Route::post('/read_now', [IndexController::class, 'read_now'])->name('read_now');


Route::get('/the-loai/{slug}', [IndexController::class, 'kinds'])->name('the-loai');
Route::get('/danh-muc/{slug}', [IndexController::class, 'categories'])->name('danh-muc');
Route::get('/truyen/{slug}', [IndexController::class, 'detail'])->name('truyen');
Route::get('/chuong/{slug}', [IndexController::class, 'chapter'])->name('chuong');

Route::get('/sach', [IndexController::class, 'books'])->name('sach');
