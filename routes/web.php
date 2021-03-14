<?php

use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\ThreadsController;
use Database\Factories\ThreadFactory;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('threads', ThreadsController::class)->except(['show']);

Route::get('threads/{channel}/{thread}',[ThreadsController::class,'show'])->name('threads.show');

Route::get('/threads/{channel}', [ThreadsController::class, 'index'])->name('channels.show');


Route::post('/threads/{channel}/{thread}/replies',[RepliesController::class,'store'])->name('replies.store');

Route::post('/replies/{reply}/favorites',[FavoritesController::class,'store'])->name('favorites.store');

