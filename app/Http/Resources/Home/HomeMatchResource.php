<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeMatchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'round' => $this->round,
            'venue' => $this->venue,
            'match_date' => $this->match_date?->toIso8601String(),
            'status' => $this->status,
            'home_score' => $this->home_score,
            'away_score' => $this->away_score,
            'is_highlight' => $this->is_highlight,
            'scoreboard' => $this->scoreboard,
            'home_team' => [
                'id' => $this->homeTeam?->id,
                'name' => $this->homeTeam?->name,
                'short_name' => $this->homeTeam?->short_name,
                'logo_url' => $this->homeTeam?->logo_url,
            ],
            'away_team' => [
                'id' => $this->awayTeam?->id,
                'name' => $this->awayTeam?->name,
                'short_name' => $this->awayTeam?->short_name,
                'logo_url' => $this->awayTeam?->logo_url,
            ],
        ];
    }
}
