<?php

namespace App\Services\Matches;

use App\Services\Competition\CompetitionDataService;

class MatchesPageContentService
{
    private const UPCOMING_LIMIT = 8;

    private const RECENT_LIMIT = 8;

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
            'upcoming_matches' => $this->competitionDataService->upcomingMatches(self::UPCOMING_LIMIT),
            'recent_matches' => $this->competitionDataService->recentMatches(self::RECENT_LIMIT),
        ];
    }
}
