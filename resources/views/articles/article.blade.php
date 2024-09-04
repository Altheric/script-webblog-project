@extends('layouts.app')
@section('title', 'Artikelen')

@section('content')
<h2>{{$article->title}}</h2>
<p>Door: {{$article->user->username}}. Geplaatst op: {{$article->created_at}}.</p>
{{--Check if the article has an image with it. Using emoji's for the image data because faker's image methods dont work anymore.--}}
<p>{{$article->image == null ? null : $article::find($article->id)->image->image_data}}</p>
<p>{{$article->content}}</p>
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