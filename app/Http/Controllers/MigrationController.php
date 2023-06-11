<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MigrationController extends Controller
{
    

    public function migrate()
    {
        Artisan::call('migrate:fresh --seed');
        return redirect()->route('players.registration');
    }
}
