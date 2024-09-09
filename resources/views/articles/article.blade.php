@extends('layouts.app')
@section('title', 'Artikelen')

@section('content')
<h2>{{$article->title}}</h2>
<p>Door: {{$article->user->username}}. Geplaatst op: {{$article->created_at}}.</p>
<p>{{$article->content}}</p>
{{--Check if the article has an image with it.--}}
@if($article->image != null)
    <img src="{{$image->image_path}}" alt="{{$image->image_alt}}">
    <p id="subtitle">{{$image->image_subtitle}}<p>
@endif
<div id="comments">
    <h2>Comments</h2>
    @foreach ($comments as $comment)
        <div class="comment">
            <h4>{{$comment->user->username}}</h4>
            <p>{{$comment->comment}}</p>
        </div>
    @endforeach
    <form action="{{ route('comments.store', $article) }}" method="POST">
        @csrf
        <h2>Post Your Comment: </h2>
        <input type="text" name="comment" id="comment-text" minlength="3" maxlength="300" required>
        <button type="submit">Post</button>
    </form>
</div>
@endsection