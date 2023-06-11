<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 4; $i++) {
            Game::create(['tour' => 1, 'name' => "Éliminatoire phase 1"]);
        }
        for ($i = 0; $i < 4; $i++) {
            Game::create(['tour' => 2, 'name' => "Éliminatoire phase 2"]);
        }
        for ($i = 0; $i < 4; $i++) {
            Game::create(['tour' => 3, 'name' => "Éliminatoire phase 3"]);
        }
        
        for ($i = 0; $i < 2; $i++) {
            Game::create(['tour' => 4, 'name' => "Demi-finale"]);
        }

        Game::create(['tour' => 5, 'name' => "Finale"]);
        
    }
}
