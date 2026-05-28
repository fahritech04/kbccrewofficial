<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TournamentMatch extends Model
{
    protected $appends = [
        'scoreboard',
    ];

    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'round',
        'venue',
        'match_date',
        'status',
        'home_score',
        'away_score',
        'is_highlight',
    ];

    protected $casts = [
        'match_date' => 'datetime',
        'is_highlight' => 'boolean',
    ];

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    protected function scoreboard(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === 'finished'
                ? "{$this->home_score} - {$this->away_score}"
                : 'VS',
        );
    }
}
