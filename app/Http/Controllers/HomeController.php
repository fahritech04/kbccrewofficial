<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use App\Models\Standing;
use App\Models\TournamentMatch;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        $featuredNews = NewsItem::query()
            ->where('is_featured', true)
            ->latest('published_at')
            ->first() ?? NewsItem::query()->latest('published_at')->first();

        $news = NewsItem::query()
            ->latest('published_at')
            ->take(5)
            ->get();

        $standings = Standing::query()
            ->with('team:id,name,short_name,logo_url')
            ->orderBy('position')
            ->take(10)
            ->get();

        $matches = TournamentMatch::query()
            ->with([
                'homeTeam:id,name,short_name,logo_url',
                'awayTeam:id,name,short_name,logo_url',
            ])
            ->orderBy('match_date')
            ->take(6)
            ->get();

        return Inertia::render('Home', [
            'featuredNews' => $featuredNews,
            'news' => $news,
            'standings' => $standings,
            'matches' => $matches,
        ]);
    }
}
