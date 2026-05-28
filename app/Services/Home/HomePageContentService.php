<?php

namespace App\Services\Home;

use App\Models\NewsItem;
use App\Models\Standing;
use App\Models\TournamentMatch;

class HomePageContentService
{
    private const NEWS_LIMIT = 5;

    private const STANDINGS_LIMIT = 10;

    private const MATCHES_LIMIT = 6;

    /**
     * @return array<string, mixed>
     */
    public function getContent(): array
    {
        return [
            'featured_news' => $this->featuredNews(),
            'news' => $this->latestNews(),
            'standings' => $this->standings(),
            'matches' => $this->matches(),
        ];
    }

    private function featuredNews(): ?NewsItem
    {
        return NewsItem::query()
            ->where('is_featured', true)
            ->latest('published_at')
            ->first() ?? NewsItem::query()->latest('published_at')->first();
    }

    private function latestNews()
    {
        return NewsItem::query()
            ->latest('published_at')
            ->take(self::NEWS_LIMIT)
            ->get();
    }

    private function standings()
    {
        return Standing::query()
            ->with('team:id,name,short_name,logo_url')
            ->orderBy('position')
            ->take(self::STANDINGS_LIMIT)
            ->get();
    }

    private function matches()
    {
        return TournamentMatch::query()
            ->with([
                'homeTeam:id,name,short_name,logo_url',
                'awayTeam:id,name,short_name,logo_url',
            ])
            ->orderBy('match_date')
            ->take(self::MATCHES_LIMIT)
            ->get();
    }
}
