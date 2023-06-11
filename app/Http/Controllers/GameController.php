<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function displayTour(int $tour) {

        
        $games = Game::where('tour', $tour)->get();
        
        return view('games.display', ['games' => $games]);

        
    }
}
