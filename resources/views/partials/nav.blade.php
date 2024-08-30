<nav>
    <a href="/">Artikelen</a>
    @if(Session::get('username') == null)
    <a href="/users/login">Inloggen</a>
    @else
    <a href="/users/articles">Mijn Artikelen</a>
    <a href="/users/logout">Uitloggen</a>
    @endif
</nav>