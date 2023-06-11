<div class="registration-container">
    {{-- REGISTER FORM --}}
    @if (!$closed)
        @if ($settings->inscriptions)
            <section>
                <h1 class="title-section">Inscriptions ({{ $count }} participants)</h1>
                <form wire:submit.prevent="register">
                    <div class="form-group">
                        <label for="name">Nom :</label>
                        <input type="text" wire:model="name">
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <button class="btn" type="submit">Valider</button>
                </form>
            </section>
        @endif

    @endif

    {{-- INDEX --}}
    <section class="index-players">
        <h2 class="title-section">
            Joueurs inscrits ({{ $players->count() }})
            @if ($closed)
                <span>(inscriptions closes)</span>
            @endif
        </h2>
        <ul class="players-list">
            @foreach ($players as $player)
                <li class="item-players">
                    <span>{{ $player->name }}</span>
                    @if ($settings->inscriptions)
                        <span class="remove-player" wire:click="remove({{ $player }})">retirer</span>
                    @endif
                    
                </li>
            @endforeach
        </ul>

        @if ($settings->inscriptions)
            @if ($count >= 16)
                <div class="btn-section">
                    <a href="{{ route('teams.generateTeam', 'eliminatories') }}" class="btn">Démarrer phases
                        éliminatoires</a>
                </div>
            @endif
        @endif



    </section>



</div>
