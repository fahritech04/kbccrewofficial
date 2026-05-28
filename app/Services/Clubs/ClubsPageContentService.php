<?php

namespace App\Services\Clubs;

use App\Services\Competition\CompetitionDataService;

class ClubsPageContentService
{
    private const CLUBS_LIMIT = 12;

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
            'clubs' => $this->competitionDataService->teams(self::CLUBS_LIMIT),
        ];
    }
}
