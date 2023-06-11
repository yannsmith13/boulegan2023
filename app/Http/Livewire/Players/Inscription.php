<?php

namespace App\Http\Livewire\Players;

use App\Models\Player;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Inscription extends Component
{
    public $settings;
    public $players;
    public int $count;
    public $closed;

    public string $name;

    protected $rules = [
        "name" => "required|min:2",
    ];

    public function mount()
    {
        $this->settings = Setting::find(1);
        $this->refresh();
    }

    public function refresh() {
        $this->players = Player::all()->reverse();
        $this->count = $this->players->count();
        if ($this->count >= 24) {
            $this->closed = true;
        } else {
            $this->closed = false;
        }
    }

    public function register()
    {
        if(!$this->closed) {
            $validatedData = $this->validate();
            Player::create($validatedData);
            $this->name = ""; 
            $this->refresh();
        }
    }

    public function remove(Player $player) 
    {
        $player->delete();
        $this->refresh();
    }

    public function render()
    {
        return view('livewire.players.inscription');
    }
}
