@extends('layouts.app')
@section('title', 'Artikelen')

@section('content')
<h2>{{$article->title}}</h2>
<p>Door: {{$article->user->username}}. Geplaatst op: {{$article->created_at}}.</p>
{{--Check if the article has a image with it. Using emoji's for the image data because faker's image methods dont work anymore.--}}
<p>{{$article->image == null ? null : $article::find($article->id)->image->image_data}}</p>
<p>{{$article->content}}</p>
@endsection