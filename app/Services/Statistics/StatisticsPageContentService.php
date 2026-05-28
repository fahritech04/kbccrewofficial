<?php

namespace App\Services\Statistics;

use App\Models\TournamentMatch;
use App\Services\Competition\CompetitionDataService;

class StatisticsPageContentService
{
    private const TOP_TEAMS_LIMIT = 5;

    public function __construct(
        private readonly CompetitionDataService $competitionDataService,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function getContent(): array
    {
        $standings = $this->competitionDataService->standings();
        $statusCounts = TournamentMatch::query()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $averageTotalPoints = TournamentMatch::query()
            ->where('status', 'finished')
            ->selectRaw('AVG(COALESCE(home_score, 0) + COALESCE(away_score, 0)) as avg_total')
            ->value('avg_total');

        return [
            'summary' => [
                'total_matches' => TournamentMatch::query()->count(),
                'scheduled_matches' => (int) ($statusCounts['scheduled'] ?? 0),
                'live_matches' => (int) ($statusCounts['live'] ?? 0),
                'finished_matches' => (int) ($statusCounts['finished'] ?? 0),
                'average_total_points' => $averageTotalPoints ? round((float) $averageTotalPoints, 1) : 0,
            ],
            'top_offense' => $standings->sortByDesc('points_for')->first(),
            'top_defense' => $standings->sortBy('points_against')->first(),
            'top_point_diff' => $standings->sortByDesc('point_diff')->take(self::TOP_TEAMS_LIMIT)->values(),
        ];
    }
}
