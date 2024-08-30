@extends('layouts.app')
@section('title', 'Inloggen')

@section('content')
<div id="login-form">
    <form action="{{route('users.entry')}}" method="POST">
        @csrf
        <div class="login-content">
            <label for="username">Naam:</label>
            <input type="text" id="username" name="username" required minlength="3" maxlength="60">
        <div>
        <div class="login-content">
        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required minlength="8" maxlength="60">
        <div>
        <div class="login-content">
        <button type="submit">Inloggen</button>
        </div>
    </form>
</div>
@if($loginError == true)
<div class="login-content">
    <p>De gebruikersnaam of wachtwoord klopt niet.</p>
</div>
@endif
@endsection