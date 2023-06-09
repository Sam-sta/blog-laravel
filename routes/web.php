<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Post;

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
//PUBLIC ROUTES
Route::get('/home', function () {
    return view('allPosts', [
        'posts' => Post::where('active', true)->get()
    ]);
})->name('home');


//PRIVATE ROUTES
Route::get('/dashboard', function () {
    return view('dashboard');
})->withoutMiddleware('user')->name('dashboard');

Route::get('/posts', [PostController::class, 'index'])->withoutMiddleware('user')->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'view'])->name('posts.view');
Route::post('/posts', [PostController::class, 'store'])->withoutMiddleware('user')->name('posts.store');
Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->withoutMiddleware('user')->name('posts.edit');
Route::post('/posts/update/{id}', [PostController::class, 'update'])->withoutMiddleware('user')->name('posts.update');
Route::get('/posts/delete/{id}', [PostController::class, 'destroy'])->withoutMiddleware('user')->name('posts.delete');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'view'])->name('categories.view');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->withoutMiddleware('user')->name('categories.edit');
Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->withoutMiddleware('user')->name('categories.update');
Route::get('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
