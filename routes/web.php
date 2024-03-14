<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\GuidesController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\CommentsController;


Route::get('/', [PagesController::class, 'index']);


Route::resource('/blog', PostsController::class);   
Route::resource('/reviews', ReviewController::class);
Route::resource('/games', GameController::class);
Route::resource('/guides', GuidesController::class);

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/news', [PagesController::class, 'news'])->name('news');


Route::post('/comments/{review}', [CommentsController::class, 'store'])->name('comments.store');
Route::get('/comments/{comment}/edit', [CommentsController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{comment}', [CommentsController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}', [CommentsController::class, 'destroy'])->name('comments.destroy');
