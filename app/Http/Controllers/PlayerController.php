<?php

namespace App\Http\Controllers;


use App\Models\Player;
use App\Models\Game;
use App\Models\Setting;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function registration()
    {
        return view('players.registration');
    }

    
    public function ranking()
    {
        $ranking = Player::orderBy('win', "desc")
                         ->orderBy('diff', "desc")
                         ->orderBy('points', "desc")
                         ->get();
        $qualifiedPlayers = $ranking->take(8);

        $games = Game::where('played', false)
        ->whereIn('tour', [1, 2, 3])
        ->get();

        if($games->count() > 0) {
            $qualificationsAreClosed = false;
        }
        else {
            $qualificationsAreClosed = true;
        }

        $semiFinalsAreOpen = Setting::find(1)->semifinals;
        
        return view('players.ranking', compact('ranking', 'qualifiedPlayers', "qualificationsAreClosed", "semiFinalsAreOpen"));
    }

    
}
