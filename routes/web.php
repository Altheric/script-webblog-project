<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;


Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/filter', [ArticleController::class, 'filter'])->name('articles.filter');
Route::get('/article/{id}', [ArticleController::class,'article'])->name('articles.article');