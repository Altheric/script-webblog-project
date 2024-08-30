@extends('layouts.app')
@section('title', 'Mijn Artikelen')

@section('content')
<div id="sidebar">
    <div class="sidebar-link">
        <a href="sidebar-link">Nieuw Artikel</a>
    </div>
</div>
@foreach($articles as $article)
<div class="user-articles">
    <h2>{{$article->title}}</h2>
    <p>Geplaatst op: {{$article->created_at}}.</p>
    <div class="article-options">
        <a href="{{ route('users.edit', $article) }}">Bewerken</a>
        <form action="{{ route('users.destroy', $article->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Verwijderen</button>
        </form>
    </div>
</div>
@endforeach
@endsection