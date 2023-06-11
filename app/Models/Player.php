<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Team;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'qualified', // bool
        'win', // int
        'points', // int
        'diff', // int
    ];

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }
}
