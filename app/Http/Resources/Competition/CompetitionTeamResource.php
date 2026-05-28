<?php

namespace App\Http\Resources\Competition;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompetitionTeamResource extends JsonResource
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
            'name' => $this->name,
            'short_name' => $this->short_name,
            'city' => $this->city,
            'logo_url' => $this->logo_url,
            'home_color' => $this->home_color,
            'matches_count' => (int) (($this->home_matches_count ?? 0) + ($this->away_matches_count ?? 0)),
            'standing' => $this->whenLoaded('standing', function () {
                return [
                    'position' => $this->standing?->position,
                    'played' => $this->standing?->played,
                    'won' => $this->standing?->won,
                    'lost' => $this->standing?->lost,
                    'points' => $this->standing?->points,
                    'point_diff' => $this->standing?->point_diff,
                ];
            }),
        ];
    }
}
