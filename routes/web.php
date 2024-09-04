<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;

Route::controller(ArticleController::class)->group(function () {
    Route::get('/', 'index')->name('articles.index');
    Route::get('/filter','filter')->name('articles.filter');
    Route::get('/article/{article}', 'article')->name('articles.article');

    Route::get('/create', 'create')->name('articles.create')->middleware('auth');
    Route::post('/store', 'store')->name('articles.store')->middleware('auth');

    Route::get('/{article}/edit', 'edit')->name('articles.edit')->middleware('auth');
    Route::put('/{article}', 'update')->name('articles.update')->middleware('auth');

    Route::get('/confirm/{article}&{action}', 'confirm')->name('articles.confirm')->middleware('auth');
    Route::delete('/{article}', 'destroy')->name('articles.destroy')->middleware('auth');

    Route::get('/{article}&{action}/exclusivity', 'exclusivity')->name('articles.exclusivity')->middleware('auth');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index')->name('users.index')->middleware('auth');
    Route::get('/users/login', 'login')->name('users.login');
    Route::post('/users/login', 'entry')->name('users.entry');
    Route::get('/users/logout', 'logout')->name('users.logout');

    Route::get('/users/premium', 'premium')->name('users.premium')->middleware('auth');
    Route::post('/users/payment', 'upgrade')->name('users.upgrade')->middleware('auth');
});

Route::post('/comments/{article}', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index')->middleware('auth');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store')->middleware('auth');

