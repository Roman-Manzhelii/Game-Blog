<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CommentsController;


Route::get('/', [PagesController::class, 'index']);


Route::resource('/blog', PostsController::class);   
Route::resource('reviews', ReviewController::class);

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/guides', [PagesController::class, 'guides'])->name('guides');
Route::get('/news', [PagesController::class, 'news'])->name('news');
Route::get('/phpinfo', function () {
    return file_get_contents(public_path('phpinfo.php'));
});


Route::post('/comments/{review}', [CommentsController::class, 'store'])->name('comments.store');
Route::get('/comments/{comment}/edit', [CommentsController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{comment}', [CommentsController::class, 'update'])->name('comments.update');

