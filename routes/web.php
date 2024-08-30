<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;

Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/filter', [ArticleController::class, 'filter'])->name('articles.filter');
Route::get('/article/{id}', [ArticleController::class,'article'])->name('articles.article');

Route::get('/users/login', [UserController::class, 'login'])->name('users.login');
Route::post('/users/login', [UserController::class, 'entry'])->name('users.entry');
Route::get('/users/logout', [UserController::class, 'logout'])->name('users.logout');

Route::get('/users/premium', [UserController::class, 'premium'])->name('users.premium');
Route::post('/users/payment', [UserController::class, 'upgrade'])->name('users.upgrade');

Route::get('/users/articles', [UserController::class, 'articles'])->name('users.articles');
Route::get('/users/articles/{article}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::get('/users/delete/{article}', [UserController::class, 'destroyConfirm'])->name('users.destroyConfirm');
Route::delete('/users/articles/{article}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/articles/{article}&{mutator}', [UserController::class, 'exclusivity'])->name('users.exclusivity');

