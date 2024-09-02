@extends('layouts.app')
@section('title', 'Categorie Toevoegen')

@section('content')
<div id="centered-form">
    <form action="{{route('categories.store')}}" method="POST">
        @csrf
        <div class="centered-content">
        <label for="category">Categorie naam:</label>
        <input type=text id="category" name="category_name" minlength="3" maxlength="255" required>
        </div>
        <div class="centered-content">
        <button type="submit">Toevoegen</button>
        </div>
    </form>
</div>
@endsection