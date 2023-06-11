<li class="game-section">
    @foreach ($game->teams as $team)
        <div class="teams-section">
            <ul
                @if ($team->win && $game->played) class="team-item win"
            @elseif (!$team->win && $game->played)
                class="team-item lose"
            @else
                class="team-item" @endif>
                <div>
                    @foreach ($team->players as $player)
                        <li class="player-item">- {{ $player->name }} -</li>
                    @endforeach
                </div>

                @if ($loop->first)
                    @if (!$this->game->played)
                        <input type="number" class="float-input-game float-input-game1" min="0" max="13"
                            wire:model="score1">
                    @else
                        <div class="float-input-game float-input-game1">{{ $team->points }}</div>
                    @endif
                @else
                    @if (!$this->game->played)
                        <input type="number" class="float-input-game float-input-game2" min="0" max="13"
                            wire:model="score2">
                    @else
                        <div class="float-input-game float-input-game2">{{ $team->points }}</div>
                    @endif
                @endif

            </ul>
        </div>
        @if ($loop->first)
            @if (!$game->played)
                <div class="vs-team" wire:click="submitScore">VS</div>
            @else
                <div></div>
            @endif
        @endif
    @endforeach
</li>
