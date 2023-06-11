<?php

namespace App\Http\Livewire\Games;

use App\Models\Player;
use App\Models\Setting;
use App\Models\Team;
use Livewire\Component;

class Game extends Component
{
    public $game;
    public $score1, $score2;


    protected $rules = [
        'score1' => "required|int|max:13|min:0",
        'score2' => "required|int|max:13|min:0",
    ];

    public function submitScore()
    {
        if($this->game->played) { return; }
        
        $this->validate();

        if (
            ($this->score1 != 13 && $this->score2 != 13) ||
            ($this->score1 == 13 && $this->score2 == 13) ||
            ($this->score1 < 0 || $this->score2 < 0)
        ) {
            return;
        }

        // Phases éliminatoires
        if ($this->game->tour == 1 || $this->game->tour == 2 || $this->game->tour == 3) {
            if ($this->score1 == 13) {
                // Teams[0] gagne et marque 13 points (idem joueur de l'équipe)
                $this->game->teams[0]->update([
                    "win" => true,
                    "points" => 13,
                ]);
                // Teams[1] marque $this->score2 points (idem joueur de l'équipe)
                $this->game->teams[1]->update([
                    "win" => false,
                    "points" => $this->score2,
                ]);

                // Calcul de la différence de points pour les joueurs des équipes
                foreach ($this->game->teams[0]->players as $player) {
                    $player->update([
                        "win" => $player->win + 1,
                        "points" => $player->points + 13,
                        "diff" => $player->diff + (13 - $this->score2),
                    ]);
                }
                foreach ($this->game->teams[1]->players as $player) {
                    $player->update([
                        "points" => $player->points + $this->score2,
                        "diff" => $player->diff + ($this->score2 - 13),
                    ]);
                }
            } elseif ($this->score2 == 13) {
                // Teams[1] gagne et marque 13 points (idem joueur de l'équipe)
                $this->game->teams[1]->update([
                    "win" => true,
                    "points" => 13,
                ]);
                // Teams[0] marque $this->score1 points (idem joueur de l'équipe)
                $this->game->teams[0]->update([
                    "win" => false,
                    "points" => $this->score1,
                ]);

                // Calcul de la différence de points pour les joueurs des équipes
                foreach ($this->game->teams[1]->players as $player) {
                    $player->update([
                        "win" => $player->win + 1,
                        "points" => $player->points + 13,
                        "diff" => $player->diff + (13 - $this->score1),
                    ]);
                }
                foreach ($this->game->teams[0]->players as $player) {
                    $player->update([
                        "points" => $player->points + $this->score1,
                        "diff" => $player->diff + ($this->score1 - 13),
                    ]);
                }
            } else {
                return;
            }
        }
        // Demi-finales
        elseif ($this->game->tour == 4) {


            // Teams[0] gagne
            if ($this->score1 == 13) {
                // Teams[0] marque 13 points (idem joueur de l'équipe)
                $this->game->teams[0]->update([
                    "win" => true,
                    "points" => 13,
                ]);
                // Teams[1] marque $this->score2 points et les joueurs sont disqualifiés
                $this->game->teams[1]->update([
                    "win" => false,
                    "points" => $this->score2,
                ]);
                foreach ($this->game->teams[1]->players as $player) {
                    $player->update(['qualified' => false]);
                }
            }
            // Teams[1] gagne
            elseif ($this->score2 == 13) {
                // Teams[1] marque 13 points (idem joueur de l'équipe)
                $this->game->teams[1]->update([
                    "win" => true,
                    "points" => 13,
                ]);
                // Teams[0] marque $this->score2 points et les joueurs sont disqualifiés
                $this->game->teams[0]->update([
                    "win" => false,
                    "points" => $this->score2,
                ]);
                foreach ($this->game->teams[0]->players as $player) {
                    $player->update(['qualified' => false]);
                }
            } else {
                return;
            }



            if (Player::where('qualified', true)->count() == 4) {
                // Les finales sont prêtes
                Setting::find(1)->update(['final' => true]);
                // On met les joueurs qualifiés dans les équipes finalistes
                $players = Player::where('qualified', true)->get()->shuffle();
                $teams = Team::whereIn('id', [29, 30])->get();
                for ($i = 0; $i < 2; $i++) {
                    for ($j = 0; $j < 2; $j++) {
                        $teams[$i]->players()->attach($players[($i * 2) + $j]);
                    }
                }

                $this->game->update([
                    "played" => true,
                ]);

                return redirect()->route('games.displayTour', 5);
            }
        }

        // Finale
        elseif ($this->game->tour == 5) {
            // Teams[0] gagne
            if ($this->score1 == 13) {
                // Teams[0] marque 13 points (idem joueur de l'équipe)
                $this->game->teams[0]->update([
                    "win" => true,
                    "points" => 13,
                ]);
                // Teams[1] marque $this->score2 points et les joueurs sont disqualifiés
                $this->game->teams[1]->update([
                    "win" => false,
                    "points" => $this->score2,
                ]);
                foreach ($this->game->teams[1]->players as $player) {
                    $player->update(['qualified' => false]);
                }
            }
            // Teams[1] gagne
            elseif ($this->score2 == 13) {
                // Teams[1] marque 13 points (idem joueur de l'équipe)
                $this->game->teams[1]->update([
                    "win" => true,
                    "points" => 13,
                ]);
                // Teams[0] marque $this->score2 points et les joueurs sont disqualifiés
                $this->game->teams[0]->update([
                    "win" => false,
                    "points" => $this->score1,
                ]);
                foreach ($this->game->teams[0]->players as $player) {
                    $player->update(['qualified' => false]);
                }
            } else {
                return;
            }
        } else {
            dd('error');
            die();
        }

        $this->game->update([
            "played" => true,
        ]);
    }


    public function render()
    {

        return view('livewire.games.game');
    }
}
