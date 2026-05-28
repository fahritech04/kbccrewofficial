<?php

namespace App\Services\Home;

use App\Services\Competition\CompetitionDataService;

class HomePageContentService
{
    private const NEWS_LIMIT = 5;

    private const STANDINGS_LIMIT = 10;

    private const MATCHES_LIMIT = 6;

    public function __construct(
        private readonly CompetitionDataService $competitionDataService,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function getContent(): array
    {
        return [
            'featured_news' => $this->competitionDataService->featuredNews(),
            'news' => $this->competitionDataService->latestNews(self::NEWS_LIMIT),
            'standings' => $this->competitionDataService->standings(self::STANDINGS_LIMIT),
            'matches' => $this->competitionDataService->matchSchedule(self::MATCHES_LIMIT),
        ];
    }
}
