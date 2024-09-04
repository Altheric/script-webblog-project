@extends('layouts.app')
@section('title', 'Mijn Artikelen')

@section('content')
@if($validAction == 'del')
    <div id="confirm-content">
        <h2>Weet je zeker dat je dit artikel permanent wilt verwijderen?</h2>
        <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Ja</button>
        </form>
        <div class="link-button">
            <a href="{{route('users.index')}}">Nee</a>
        </div>
    </div>
@endif
@endsection