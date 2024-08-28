@extends('layouts.app')
@section('title', 'Artikelen')

@section('content')
@foreach($articles as $article)


<div class="articles">
    <h2>{{$article->title}}</h2>
    <p>Door: {{$article->user->username}}. Geplaatst op: {{$article->created_at}}.</p>
</div>
@endforeach
@endsection