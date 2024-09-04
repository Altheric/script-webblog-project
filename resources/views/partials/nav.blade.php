<nav>
    <a href="/">Artikelen</a>
    @if(Auth::id() == null)
        <a href="/users/login">Inloggen</a>
    @else
        <a href="/users">Mijn Artikelen</a>
        @if(Auth::id() == false)
            <a href="/users/premium">Upgrade naar Premium</a>
        @endif
        <a href="/users/logout">Uitloggen</a>
    @endif
</nav>