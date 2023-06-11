<header>
    <ul>
        @if ($settings->inscriptions)
            <a href="{{ route('players.registration') }}">
                <li>Inscriptions</li>
            </a>
        @endif


        @if (!$settings->inscriptions)
            <a href="{{ route('players.ranking') }}">
                <li>Classement poules</li>
            </a>

            <a href="{{ route('games.displayTour', 1) }}">
                <li>1er tour</li>
            </a>
            <a href="{{ route('games.displayTour', 2) }}">
                <li>2ème tour</li>
            </a>
            <a href="{{ route('games.displayTour', 3) }}">
                <li>3ème tour</li>
            </a>

            @if ($settings->semifinals)
                <a href="{{ route('games.displayTour', 4) }}">
                    <li>Demi-finales</li>
                </a>
            @endif

            @if ($settings->final)
                <a href="{{ route('games.displayTour', 5) }}">
                    <li>Finale</li>
                </a>
            @endif



        @endif


    </ul>
</header>
