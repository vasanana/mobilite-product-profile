<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\AboutController;

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
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//FAQ
Route::get('/FAQ', [FAQController::class, 'index']);

Route::get('/FAQ/create', [FAQController::class, 'create'])->name('FAQ.create');

Route::post('/FAQ', [FAQController::class, 'store'])->name('FAQ.store');

//Insight
Route::get('/insight', [InsightController::class, 'index']);

Route::get('/insight/create', [InsightController::class, 'create'])->name('insight.create');

Route::post('/insight', [InsightController::class, 'store'])->name('insight.store');

Route::get('/insight/edit/{id}', [InsightController::class, 'edit'])->name('insight.edit');

Route::post('/insight/update/{id}', [InsightController::class, 'update'])->name('insight.update');

//About
Route::get('/about', [AboutController::class, 'index']);

Route::get('/about/create', [AboutController::class, 'create'])->name('about.create');

Route::post('/about', [AboutController::class, 'store'])->name('about.store');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
