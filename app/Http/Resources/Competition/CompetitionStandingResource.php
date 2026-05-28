<?php

namespace App\Http\Resources\Competition;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompetitionStandingResource extends JsonResource
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
            'position' => $this->position,
            'played' => $this->played,
            'won' => $this->won,
            'lost' => $this->lost,
            'points_for' => $this->points_for,
            'points_against' => $this->points_against,
            'point_diff' => $this->point_diff,
            'points' => $this->points,
            'team' => [
                'id' => $this->team?->id,
                'name' => $this->team?->name,
                'short_name' => $this->team?->short_name,
                'logo_url' => $this->team?->logo_url,
                'city' => $this->team?->city,
                'home_color' => $this->team?->home_color,
            ],
        ];
    }
}
