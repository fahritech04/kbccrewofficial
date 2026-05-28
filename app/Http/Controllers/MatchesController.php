<?php

namespace App\Http\Controllers;

use App\Http\Resources\Competition\CompetitionMatchResource;
use App\Services\Matches\MatchesPageContentService;
use Inertia\Inertia;
use Inertia\Response;

class MatchesController extends Controller
{
    public function index(MatchesPageContentService $matchesPageContentService): Response
    {
        $content = $matchesPageContentService->getContent();

        return Inertia::render('Matches', [
            'upcomingMatches' => CompetitionMatchResource::collection($content['upcoming_matches'])->resolve(),
            'recentMatches' => CompetitionMatchResource::collection($content['recent_matches'])->resolve(),
        ]);
    }
}
