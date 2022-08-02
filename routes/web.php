<?php

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use PHPUnit\TextUI\XmlConfiguration\Group;
use PHPUnit\TextUI\XmlConfiguration\Groups;

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

Auth::routes();
Route::middleware('auth')->group(function () {

    Route::middleware('Check')->group(function () {
      // Rotas que só o admin pode acessar
    });
    Route::middleware('admin')->group(function(){

    });

    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
});

Route::get('/', [ProductController::class, 'index'])->name('index');
Route::get('/home', [ProductController::class, 'index'])->name('home');
Route::get('/view/{id}', [CategoryController::class,'categories']);
