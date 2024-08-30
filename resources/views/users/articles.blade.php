@extends('layouts.app')
@section('title', 'Mijn Artikelen')

@section('content')
<div id="sidebar">
    <div class="link-button">
        <a href="link-button">Nieuw Artikel</a>
    </div>
</div>
@foreach($articles as $article)
<div class="user-articles">
    <h2>{{$article->title}}</h2>
    <p>Geplaatst op: {{$article->created_at}}.</p>
    <div class="article-options">
        <div class="link-button">
            <a href="{{ route('users.edit', $article) }}">Bewerken</a>
        </div>
        <div class="link-button">
            <a href="{{ route('users.destroyconfirm', $article->id) }}">Verwijderen</a>
        </div>
    </div>
</div>
@endforeach
@endsection