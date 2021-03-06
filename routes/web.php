<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth', 'our:admin'])->group(function () {
    Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::resource('posts', PostController::class)->except('show');
Route::put('posts/{post}/complete', [PostController::class, 'complete'])->middleware('our:admin')->name('post.complete');
Route::resource('categories', CategoryController::class);
});



require __DIR__.'/auth.php';
