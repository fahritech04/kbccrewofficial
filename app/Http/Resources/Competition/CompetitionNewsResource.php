<?php

namespace App\Http\Resources\Competition;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompetitionNewsResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'category' => $this->category,
            'image_url' => $this->image_url,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'is_featured' => $this->is_featured,
            'published_at' => $this->published_at?->toIso8601String(),
        ];
    }
}
