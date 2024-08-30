@extends('layouts.app')
@section('title', 'Mijn Artikelen')

@section('content')
<div id="delete-content">
    <h2>Weet je zeker dat je dit artikel permanent wilt verwijderen?</h2>
    <form action="{{ route('users.destroy', $article->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Ja</button>
    </form>
    <div class="link-button">
        <a href="{{route('users.articles')}}">Nee</a>
    </div>
</div>
@endsection