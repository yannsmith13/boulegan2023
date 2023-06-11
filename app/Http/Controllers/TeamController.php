<?php

namespace App\Http\Controllers;


use App\Models\Player;
use App\Models\Setting;
use App\Models\Team;

class TeamController extends Controller
{
    public function generateTeam(string $tours)
    {
        if ($tours === "eliminatories") {

            // Close inscriptions
            Setting::find(1)->update([
                'inscriptions' => false,
            ]);

            // On détermine combien il y aura d'équipes de 3 selon le nombre de joueurs inscrits
            $numberOfTeamsWithThreePlayers = Player::count() - 16;

            for($tour = 0; $tour < 3; $tour++) {
                // On remplit les équipes
                $players = Player::get()->shuffle();
                $teams = Team::whereIn('game_id', [
                    ($tour * 4) + 1, 
                    ($tour * 4) + 2,
                    ($tour * 4) + 3,
                    ($tour * 4) + 4])
                ->get()->shuffle();

                $indexPlayer = 0;
                $indexTeam = 0;

                foreach($teams as $team) {
                    // Équipes de 3 joueurs
                    if ($indexTeam < $numberOfTeamsWithThreePlayers) {
                        for($i = 0; $i < 3; $i++) {
                            $team->players()->attach($players[$indexPlayer]);
                            $indexPlayer++;
                        }
                        $indexTeam++;
                    }
                    // Équipes de 2 joueurs
                    else {
                        for($i = 0; $i < 2; $i++) {
                            $team->players()->attach($players[$indexPlayer]);
                            $indexPlayer++;
                        }
                        $indexTeam++;
                    }
                    
                }
            }
        }

        return redirect()->route('games.displayTour', [1]);
    }

    public function generateSemiFinals()
    {
        Setting::find(1)->update(["semifinals" => true]);
        
        $players = Player::all();
        foreach($players as $player) {
            $player->update([
                'qualified' => false,
            ]);
        }
        $ranking = Player::orderBy('win', "desc")
                         ->orderBy('diff', "desc")
                         ->orderBy('points', "desc")
                         ->get();
                         
        $qualifiedPlayers = $ranking->take(8)->shuffle();

        foreach($qualifiedPlayers as $player) {
            $player->update([
                'qualified' => true,
            ]);
        }

        // Faire 4 équipes pour les 1/2
        for($i = 0; $i < 4; $i++) {
            
            for($j = 0; $j < 2; $j++) {
                // dd($qualifiedPlayers[($i * 2) + $j] ); die();
                Team::find($i + 25)->players()->attach($qualifiedPlayers[($i * 2) + $j]);
            }
            
        }
        // Afficher la page des 1/2
        return redirect()->route('games.displayTour', [4]); 
    }
}
