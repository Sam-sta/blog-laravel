<?php

use App\Http\Controllers\api\ApiCategoryController;
use App\Http\Controllers\api\ApiPostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', [ApiCategoryController::class, 'index']);
Route::post('/categories', [ApiCategoryController::class, 'store']);
Route::get('/categories/{category}', [ApiCategoryController::class, 'show']);
Route::put('/categories/{category}', [ApiCategoryController::class, 'update']);
Route::delete('/categories/{category}', [ApiCategoryController::class, 'destroy']);

Route::get('/posts', [ApiPostController::class, 'index']);
Route::post('/posts', [ApiPostController::class, 'store']);
Route::get('/posts/{post}', [ApiPostController::class, 'show']);
Route::put('/posts/{post}', [ApiPostController::class, 'update']);
Route::delete('/posts/{post}', [ApiPostController::class, 'destroy']);

Route::get('/posts/category', [ApiPostController::class, 'showByCategory']);