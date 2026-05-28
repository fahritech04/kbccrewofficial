<?php

namespace App\Http\Controllers;

use App\Http\Resources\Competition\CompetitionStandingResource;
use App\Services\Statistics\StatisticsPageContentService;
use Inertia\Inertia;
use Inertia\Response;

class StatisticsController extends Controller
{
    public function index(StatisticsPageContentService $statisticsPageContentService): Response
    {
        $content = $statisticsPageContentService->getContent();

        return Inertia::render('Statistics', [
            'summary' => $content['summary'],
            'topOffense' => $content['top_offense']
                ? CompetitionStandingResource::make($content['top_offense'])->resolve()
                : null,
            'topDefense' => $content['top_defense']
                ? CompetitionStandingResource::make($content['top_defense'])->resolve()
                : null,
            'topPointDiff' => CompetitionStandingResource::collection($content['top_point_diff'])->resolve(),
        ]);
    }
}
