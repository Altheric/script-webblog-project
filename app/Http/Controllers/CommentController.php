<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Article $article){
        $validated = $request->validated();

        $creationArray = ['comment' => $validated['comment'], 'user_id' => Auth::id(), 'article_id' => $article->id];

        Comment::create($creationArray);

        return redirect()->route('articles.article', $article->id);
    }
}