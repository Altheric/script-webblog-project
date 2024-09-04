<nav>
    <a href="/">Artikelen</a>
    @if(Auth::id() == null)
        <a href="{{ route('users.login') }}">Inloggen</a>
    @else
        <a href="{{ route('users.index') }}">Mijn Artikelen</a>
        @if(Auth::id() == false)
            <a href="{{ route('users.premium') }}">Upgrade naar Premium</a>
        @endif
        <a href="{{ route('users.logout') }}">Uitloggen</a>
    @endif
</nav>