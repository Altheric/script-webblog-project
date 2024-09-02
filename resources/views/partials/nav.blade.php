<nav>
    <a href="/">Artikelen</a>
    @if(Session::get('user_id') == null)
        <a href="/users/login">Inloggen</a>
    @else
        <a href="/users">Mijn Artikelen</a>
        @if(Session::get('premium') == false)
            <a href="/users/premium">Upgrade naar Premium</a>
        @endif
        <a href="/users/logout">Uitloggen</a>
    @endif
</nav>