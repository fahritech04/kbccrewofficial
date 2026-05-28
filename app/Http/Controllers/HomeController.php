<?php

namespace App\Http\Controllers;

use App\Http\Resources\Home\HomeMatchResource;
use App\Http\Resources\Home\HomeNewsResource;
use App\Http\Resources\Home\HomeStandingResource;
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
                ? HomeNewsResource::make($homePageContent['featured_news'])->resolve()
                : null,
            'news' => HomeNewsResource::collection($homePageContent['news'])->resolve(),
            'standings' => HomeStandingResource::collection($homePageContent['standings'])->resolve(),
            'matches' => HomeMatchResource::collection($homePageContent['matches'])->resolve(),
        ]);
    }
}
