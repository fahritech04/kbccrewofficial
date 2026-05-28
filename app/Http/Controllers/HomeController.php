<?php

namespace App\Http\Controllers;

use App\Http\Resources\Competition\CompetitionMatchResource;
use App\Http\Resources\Competition\CompetitionNewsResource;
use App\Http\Resources\Competition\CompetitionStandingResource;
use App\Services\Home\HomePageContentService;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(HomePageContentService $homePageContentService): Response
    {
        $homePageContent = $homePageContentService->getContent();

        return Inertia::render('Home', [
            'featuredNews' => $homePageContent['featured_news']
                ? CompetitionNewsResource::make($homePageContent['featured_news'])->resolve()
                : null,
            'news' => CompetitionNewsResource::collection($homePageContent['news'])->resolve(),
            'standings' => CompetitionStandingResource::collection($homePageContent['standings'])->resolve(),
            'matches' => CompetitionMatchResource::collection($homePageContent['matches'])->resolve(),
        ]);
    }
}
