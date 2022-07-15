<?php

use App\Http\Controllers\API\ArticleAPIController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [LoginController::class, 'actionlogin'])->name('loginStore');
Route::post('register', [LoginController::class, 'actionregister'])->name('registerStore');
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
Route::post('email/verification-notification', [LoginController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
Route::get('verify-email/{id}/{hash}', [LoginController::class, 'verify'])->name('verification.verify')->middleware('auth:sanctum');
Route::post('forgot-password', [LoginController::class, 'forgot']);
Route::post('reset-password', [LoginController::class, 'reset']);
Route::get('article', [ArticleAPIController::class, 'index']);
Route::post('article/image', [ArticleAPIController::class, 'imagePath']);
Route::post('article', [ArticleAPIController::class, 'store'])->name('articleStoreAPI');
Route::get('article/{id}', [ArticleAPIController::class, 'show']);
Route::post('article/update/{id}', [ArticleAPIController::class, 'update']);
Route::post('article/delete/{id}', [ArticleAPIController::class, 'destroy']);
