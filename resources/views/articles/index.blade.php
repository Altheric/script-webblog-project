@extends('layouts.app')
@section('title', 'Artikelen')

@section('content')
<div id="sidebar">
    <form action="{{ route('articles.filter') }}" method="GET">
        <label for="category">Categorie&euml;n</label>
        <select name="category" id="category">
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->category_name}}</option>
            @endforeach
        </select>
        <button type="submit">Filter</button>
    </form>
</div>
@foreach($articles as $article)
<div class="articles">
    <a href="/article/{{$article->id}}"> 
        <h2>{{$article->title}}</h2>
        <p>Door: {{$article->user->username}}. Geplaatst op: {{$article->created_at}}.</p>   
    </a>
</div>
@endforeach

@endsection