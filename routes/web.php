<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderTemplateContentController;
use App\Http\Controllers\OrderTemplateController;
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
Route::get('/users/emails', [UserController::class, 'emails'])->name('user.emails')->middleware('auth');
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


Route::get('/ordertemplate', [OrderTemplateController::class, 'index'])->name('orderTemplate.list')->middleware('auth');
Route::get('/ordertemplate/all', [OrderTemplateController::class, 'listOfAllOrderTemplate'])->name('orderTemplate.allOrderTemplates')->middleware('auth');
Route::get('/ordertemplate/draft', [OrderTemplateController::class, 'listOfDraftOrderTemplate'])->name('orderTemplate.draftOrderTemplates')->middleware('auth');
Route::get('/ordertemplate/open', [OrderTemplateController::class, 'listOfOpenedOrderTemplate'])->name('orderTemplate.openedOrderTemplates')->middleware('auth');
Route::get('/ordertemplate/close', [OrderTemplateController::class, 'listOfClosedOrderTemplate'])->name('orderTemplate.closedOrderTemplates')->middleware('auth');
Route::get('/ordertemplate/delivered', [OrderTemplateController::class, 'listOfDeliveredOrderTemplate'])->name('orderTemplate.deliveredOrderTemplates')->middleware('auth');
Route::get('/ordertemplate/create', [OrderTemplateController::class, 'create'])->name('orderTemplate.create');
Route::get('/ordertemplate/{orderTemplate}', [OrderTemplateController::class, 'show'])->name('orderTemplate.show')->middleware('auth');
Route::get('/ordertemplate/{orderTemplate}/edit', [OrderTemplateController::class, 'edit'])->name('orderTemplate.edit')->middleware('auth');
Route::get('/ordertemplate/{orderTemplate}/duplicate', [OrderTemplateController::class, 'duplicate'])->name('orderTemplate.duplicate')->middleware('auth');
Route::get('/ordertemplate/{orderTemplate}/print', [OrderTemplateController::class, 'print'])->name('orderTemplate.print')->middleware('auth');
Route::patch('/ordertemplate/{orderTemplate}',[OrderTemplateController::class, 'update'])->name('orderTemplate.update');
Route::post('/ordertemplate',[OrderTemplateController::class, 'store'])->name('orderTemplate.store');
Route::delete('/ordertemplate/{orderTemplate}',[OrderTemplateController::class, 'destroy'])->name('orderTemplate.destroy');
Route::get('/order', [OrderTemplateController::class, 'listOfOrder'])->name('order.index')->middleware('auth');
Route::get('/order/draft', [OrderTemplateController::class, 'listOfDraftOrder'])->name('order.draftOrders')->middleware('auth');
Route::get('/order/open', [OrderTemplateController::class, 'listOfOpenedOrder'])->name('order.openedOrders')->middleware('auth');
Route::get('/order/close', [OrderTemplateController::class, 'listOfClosedOrder'])->name('order.closedOrders')->middleware('auth');
Route::get('/order/delivered', [OrderTemplateController::class, 'listOfDeliveredOrder'])->name('order.deliveredOrders')->middleware('auth');
Route::get('/order/{orderTemplate}/edit', [OrderTemplateController::class, 'edit_for_user'])->name('order.edit')->middleware('auth');
Route::patch('/order/{orderTemplate}',[OrderTemplateController::class, 'update_for_user'])->name('order.update');
Route::delete('/order/{orderTemplate}',[OrderTemplateController::class, 'destroy_for_user'])->name('order.destroy');


Route::get('/ordertemplatecontent', [OrderTemplateContentController::class, 'index'])->name('orderTemplateContent.list')->middleware('auth');
Route::get('/ordertemplatecontent/{orderTemplate}/create', [OrderTemplateContentController::class, 'create'])->name('orderTemplateContent.create');
Route::get('/ordertemplatecontent/{orderTemplateContent}/duplicate', [OrderTemplateContentController::class, 'duplicate'])->name('orderTemplateContent.duplicate');
Route::get('/ordertemplatecontent/{orderTemplateContent}', [OrderTemplateContentController::class, 'show'])->name('orderTemplateContent.show')->middleware('auth');
Route::get('/ordertemplatecontent/{orderTemplateContent}/edit', [OrderTemplateContentController::class, 'edit'])->name('orderTemplateContent.edit')->middleware('auth');
Route::patch('/ordertemplatecontent/{orderTemplateContent}',[OrderTemplateContentController::class, 'update'])->name('orderTemplateContent.update');
Route::post('/ordertemplatecontent',[OrderTemplateContentController::class, 'store'])->name('orderTemplateContent.store');
Route::delete('/ordertemplatecontent/{orderTemplateContent}',[OrderTemplateContentController::class, 'destroy'])->name('orderTemplateContent.destroy');


Route::get('/language/{lang}', [MainController::class, 'language'])->name('language');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
