<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/filter', [ArticleController::class, 'filter'])->name('articles.filter');
Route::get('/article/{article}', [ArticleController::class,'article'])->name('articles.article');
Route::get('/article/{article}/edit', [ArticleController::class,'edit'])->name('articles.edit');
Route::put('/article/{article}', [ArticleController::class,'update'])->name('articles.update');
Route::get('/article/confirm/{article}&{action}', [ArticleController::class, 'confirm'])->name('articles.confirm');
Route::delete('/article/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
Route::get('/article/{article}&{action}', [ArticleController::class, 'exclusivity'])->name('articles.exclusivity');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/login', [UserController::class, 'login'])->name('users.login');
Route::post('/users/login', [UserController::class, 'entry'])->name('users.entry');
Route::get('/users/logout', [UserController::class, 'logout'])->name('users.logout');

Route::get('/users/premium', [UserController::class, 'premium'])->name('users.premium');
Route::post('/users/payment', [UserController::class, 'upgrade'])->name('users.upgrade');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
