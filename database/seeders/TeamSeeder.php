<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Eliminatoires (3 tours de 4 parties)
        for($i = 0; $i < 3; $i++) {
            for($j = 0; $j < 4; $j++) {
                for($k = 0; $k < 2; $k ++) {
                    $team = Team::create();
                }
            }
        }
        // 1/2 finales
        for($j = 0; $j < 2; $j++) {
            for($k = 0; $k < 2; $k ++) {
                $team = Team::create();
            }
        }
        // Finale
        for($k = 0; $k < 2; $k ++) {
            $team = Team::create();
        }
    }
}
