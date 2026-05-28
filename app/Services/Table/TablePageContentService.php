<?php

namespace App\Services\Table;

use App\Services\Competition\CompetitionDataService;

class TablePageContentService
{
    private const STANDINGS_LIMIT = 12;

    public function __construct(
        private readonly CompetitionDataService $competitionDataService,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function getContent(): array
    {
        $standings = $this->competitionDataService->standings(self::STANDINGS_LIMIT);

        return [
            'standings' => $standings,
            'leader' => $standings->first(),
        ];
    }
}
