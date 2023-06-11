<?php

namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $player = Player::factory(23)->create();
        $registredPlayers = [
            "Momich", // 1
            "P'tit Bru",
            "Yvon",
            "Magali",
            "Alain",
            "Laurence",
            "Michel",
            "Ju Pontes",
            "Doug'",
            "Sven",
            "Pep", // 11
            "Sarah",
            "Lulu",
            "Bombe",
            "Yannsmith",
            "Jeje Pas de la Bouilla",
            "Peupeu",
            "Laurent 144",
            "Arthur",
            "Christian",
            "Lorenzo", // 21
            "Tonio",
            "Bast",
            "Pierre-Alex", // 24
        ];
        
        foreach($registredPlayers as $player) {
            Player::create(["name" => $player]);
        }
        
    }
}
