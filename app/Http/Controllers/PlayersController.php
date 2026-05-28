<?php

namespace App\Http\Controllers;

use App\Http\Resources\Competition\CompetitionNewsResource;
use App\Http\Resources\Competition\CompetitionStandingResource;
use App\Services\Players\PlayersPageContentService;
use Inertia\Inertia;
use Inertia\Response;

class PlayersController extends Controller
{
    public function index(PlayersPageContentService $playersPageContentService): Response
    {
        $content = $playersPageContentService->getContent();

        return Inertia::render('Players', [
            'spotlightTeams' => CompetitionStandingResource::collection($content['spotlight_teams'])->resolve(),
            'stories' => CompetitionNewsResource::collection($content['stories'])->resolve(),
        ]);
    }
}
