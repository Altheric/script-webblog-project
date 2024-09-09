<nav>
    <a href="{{ route('articles.index') }}">Artikelen</a>
    @if(Auth::check() == null)
        <a href="{{ route('users.login') }}">Inloggen</a>
    @else
        <a href="{{ route('users.index') }}">Mijn Artikelen</a>
        @if(Session::get('premium_user') == false)
            <a href="{{ route('users.premium') }}">Upgrade naar Premium</a>
        @endif
        <a href="{{ route('users.logout') }}">Uitloggen</a>
    @endif
</nav>