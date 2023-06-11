<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Team;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour',
        'name',
        'played',
    ];

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }
}
