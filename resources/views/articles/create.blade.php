@extends('layouts.app')
@section('title', 'Artikel Schrijven')

@section('content')
<div id="centered-form">
    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="centered-content">
            <label for="title">Titel: </label>
            <input type="text" name="title" id="title" minlength="3" maxlength="255" required>
        </div>
        <div class="centered-content">
            <label for="article-content" id="content-label">Tekst: </label>
            <textarea name="content" id="article-content" minlength="3" maxlength="20000" required>
            </textarea>
        </div>
        <div id="category-select-box">
            <label for="category-select">Categorie&euml;n:</label>
            <select name="category[]" id="category-select" multiple required>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="centered-content">
            <label for="image-upload">Afbeelding Toevoegen</label>
            <input type="file" name="image_data" id="image-upload" accept="image/png, image/jpeg">
            <label for="subtitle">Ondertiteling</label>
            <input type="text" name="image_subtitle" id="subtitle" minlength="3" maxlength="255">
        </div>
        
        <div class="centered-content">
            <button type="submit">Artikel Plaatsen</button>
        </div>
    </form>
</div>
@endsection