<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamsInGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $games = Game::all();
        $teams = Team::all();

        $i = 0;
        foreach($games as $game) {
            $teams[$i]->update(['game_id' => $game->id]);
            $teams[$i + 1]->update(['game_id' => $game->id]);

            $i = $i + 2;
        }
    }
}
