<?php

namespace App\Services\Players;

use App\Services\Competition\CompetitionDataService;

class PlayersPageContentService
{
    private const SPOTLIGHT_LIMIT = 6;

    public function __construct(
        private readonly CompetitionDataService $competitionDataService,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function getContent(): array
    {
        $standings = $this->competitionDataService->standings(self::SPOTLIGHT_LIMIT);
        $news = $this->competitionDataService->latestNews(self::SPOTLIGHT_LIMIT);

        return [
            'spotlight_teams' => $standings,
            'stories' => $news,
        ];
    }
}
