<?php

use App\Http\Controllers\Admin\ArticleAPIController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
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

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::get('register', [LoginController::class, 'register'])->name('register');
Route::get('image/{filename}', [ImageController::class, 'showImage'])->where('filename', '.*')->name('showimage');
Route::post('actionregist', [LoginController::class, 'registerStore'])->name('actionRegist');
Route::post('actionloginss', [LoginController::class, 'loginStore'])->name('actionLogin');
// Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('actionregister', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');
// Route::resource('article', ArticleController::class)->middleware('isAdmin');
Route::get('article', [ArticleController::class, 'index'])->name('article.index');
Route::middleware('auth')->group(function () {
    Route::get('article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('article', [ArticleController::class, 'store'])->name('article.store');
    Route::get('article/{id}', [ArticleController::class, 'show'])->name('article.show');
    Route::get('article/{id}/edit', [ArticleController::class, 'edit'])->name('article.edit');
    Route::put('article/{id}', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('article/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');
});
Route::resource('user', UserController::class)->middleware('auth');
// Route::group(['middleware' => 'auth', 'role:visitor'])
// Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
// Route::post('register', [RegisterController::class, 'actionregister'])->name('actionregist');
