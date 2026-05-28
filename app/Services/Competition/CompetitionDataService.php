<?php

namespace App\Services\Competition;

use App\Models\NewsItem;
use App\Models\Standing;
use App\Models\Team;
use App\Models\TournamentMatch;
use Illuminate\Database\Eloquent\Collection;

class CompetitionDataService
{
    public function featuredNews(): ?NewsItem
    {
        return NewsItem::query()
            ->where('is_featured', true)
            ->latest('published_at')
            ->first() ?? NewsItem::query()->latest('published_at')->first();
    }

    public function latestNews(int $limit = 5): Collection
    {
        return NewsItem::query()
            ->latest('published_at')
            ->take($limit)
            ->get();
    }

    public function standings(int $limit = 10): Collection
    {
        return Standing::query()
            ->with('team:id,name,short_name,logo_url,city,home_color')
            ->orderBy('position')
            ->take($limit)
            ->get();
    }

    public function upcomingMatches(int $limit = 6): Collection
    {
        return TournamentMatch::query()
            ->with($this->matchRelations())
            ->whereIn('status', ['scheduled', 'live'])
            ->orderBy('match_date')
            ->take($limit)
            ->get();
    }

    public function recentMatches(int $limit = 6): Collection
    {
        return TournamentMatch::query()
            ->with($this->matchRelations())
            ->where('status', 'finished')
            ->latest('match_date')
            ->take($limit)
            ->get();
    }

    public function matchSchedule(int $limit = 12): Collection
    {
        return TournamentMatch::query()
            ->with($this->matchRelations())
            ->orderBy('match_date')
            ->take($limit)
            ->get();
    }

    public function teams(int $limit = 12): Collection
    {
        return Team::query()
            ->with('standing')
            ->withCount(['homeMatches', 'awayMatches'])
            ->orderBy('name')
            ->take($limit)
            ->get();
    }

    /**
     * @return array<int, string>
     */
    private function matchRelations(): array
    {
        return [
            'homeTeam:id,name,short_name,logo_url',
            'awayTeam:id,name,short_name,logo_url',
        ];
    }
}
