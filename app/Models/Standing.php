<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Standing extends Model
{
    protected $fillable = [
        'team_id',
        'position',
        'played',
        'won',
        'lost',
        'points_for',
        'points_against',
        'point_diff',
        'points',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
