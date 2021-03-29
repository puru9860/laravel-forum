<?php

use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ProfilesController;
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
    return redirect(route('threads.index'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/threads', [ThreadsController::class, 'index'])->name('threads.index');
Route::post('/threads', [ThreadsController::class, 'store'])->name('threads.store');
Route::get('/threads/create', [ThreadsController::class, 'create'])->name('threads.create');
Route::get('threads/{channel}/{thread}',[ThreadsController::class,'show'])->name('threads.show');
Route::delete('/threads/{channel}/{thread}', [ThreadsController::class, 'destroy'])->name('thread.delete');



Route::get('/threads/{channel}', [ThreadsController::class, 'index'])->name('channels.show');


Route::post('/threads/{channel}/{thread}/replies',[RepliesController::class,'store'])->name('replies.store');
Route::delete('/replies/{reply}',[RepliesController::class,'destroy'])->name('replies.delete');


Route::post('/replies/{reply}/favorites',[FavoritesController::class,'store'])->name('favorites.store');

Route::get('/profiles/{user}',[ProfilesController::class,'show'])->name('profile.show');
