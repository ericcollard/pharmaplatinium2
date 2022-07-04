<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
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
//Route::redirect('/home', '/index');

require __DIR__ . '/auth.php';

Route::get('/', [MainController::class, 'landing'])->name('landing');
Route::get('/home', [MainController::class, 'home'])->name('home');
Route::get('/users', [UserController::class, 'index'])->name('user.list')->middleware('auth');
Route::get('/users/jsonIndex', [UserController::class, 'jsonIndex'])->name('user.jsonIndex')->middleware('auth');
Route::get('/users/{user}', [UserController::class, 'show'])->name('user.show')->middleware('auth');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('auth');
Route::patch('/users/{user}',[UserController::class, 'update'])->name('user.update');
Route::delete('/users/{user}',[UserController::class, 'destroy'])->name('user.destroy');
Route::post('/users/{user}/avatar',[UserController::class, 'storeAvatar'])->name('user.avatar.store');

Route::get('/brands', [BrandController::class, 'index'])->name('brand.list')->middleware('auth');
Route::get('/brands/create', [BrandController::class, 'create'])->name('brand.create');
Route::get('/brands/{brand}', [BrandController::class, 'show'])->name('brand.show')->middleware('auth');
Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brand.edit')->middleware('auth');
Route::patch('/brands/{brand}',[BrandController::class, 'update'])->name('brand.update');
Route::post('/brands',[BrandController::class, 'store'])->name('brand.store');
Route::delete('/brands/{brand}',[BrandController::class, 'destroy'])->name('brand.destroy');



Route::get('/language/{lang}', [MainController::class, 'language'])->name('language');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
