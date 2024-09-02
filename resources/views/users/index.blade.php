@extends('layouts.app')
@section('title', 'Mijn Artikelen')

@section('content')
<div id="sidebar">
    <div class="link-button">
        <a href="link-button">Nieuw Artikel</a>
    </div>
    <div class="link-button">
        <a href="{{ route('categories.index') }}">Nieuwe Categorie</a>
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
            <a href="{{ route('users.destroyConfirm', $article->id) }}">Verwijderen</a>
        </div>
    </div>    
    <div class="article-options">
        @if($article->premium_article == false)
            <div class="link-button">
                <a href="{{ route('users.exclusivity',  [$article->id, 1]) }}">Maak Premium</a>
            </div>
        @else
            <div class="link-button">
                <a href="{{ route('users.exclusivity',  [$article->id, 0]) }}">Maak Gratis</a>
            </div>
        @endif
    </div>
</div>
@endforeach
@endsection