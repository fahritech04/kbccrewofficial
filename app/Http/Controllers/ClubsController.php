<?php

namespace App\Http\Controllers;

use App\Http\Resources\Competition\CompetitionTeamResource;
use App\Services\Clubs\ClubsPageContentService;
use Inertia\Inertia;
use Inertia\Response;

class ClubsController extends Controller
{
    public function index(ClubsPageContentService $clubsPageContentService): Response
    {
        $content = $clubsPageContentService->getContent();

        return Inertia::render('Clubs', [
            'clubs' => CompetitionTeamResource::collection($content['clubs'])->resolve(),
        ]);
    }
}
