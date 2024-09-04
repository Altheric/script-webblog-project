@extends('layouts.app')
@section('title', 'Premium')

@section('content')
<div id="centered-form">
    <img src="https://i.redd.it/qgtakbz2g1o61.gif" alt="Lucky Star Credit Card Gif">
    <form action="{{route('users.upgrade')}}" method="POST">
        @csrf
        <div class="centered-content">
        <button type="submit">Waardeer op naar premium</button>
        </div>
    </form>
</div>
@endsection