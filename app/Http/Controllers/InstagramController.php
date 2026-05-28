<?php

namespace App\Http\Controllers;

use App\Services\Instagram\InstagramFeedService;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Inertia\Response;

class InstagramController extends Controller
{
    public function index(InstagramFeedService $instagramFeedService): Response
    {
        return Inertia::render('Instagram', [
            'instagram' => $instagramFeedService->getFeed(),
        ]);
    }

    public function media(Request $request): HttpResponse
    {
        $sourceUrl = (string) $request->query('src', '');

        if (! filter_var($sourceUrl, FILTER_VALIDATE_URL)) {
            abort(404);
        }

        $host = parse_url($sourceUrl, PHP_URL_HOST) ?? '';
        $isAllowedHost = str_ends_with($host, 'cdninstagram.com')
            || str_ends_with($host, 'fbcdn.net');

        if (! $isAllowedHost) {
            abort(403);
        }

        $remote = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
            'Referer' => 'https://www.instagram.com/',
            'Accept' => 'image/avif,image/webp,image/apng,image/*,*/*;q=0.8',
        ])->timeout(20)->get($sourceUrl);

        if ($remote->failed()) {
            abort(404);
        }

        return response($remote->body(), 200, [
            'Content-Type' => $remote->header('Content-Type', 'image/jpeg'),
            'Cache-Control' => 'public, max-age=300',
        ]);
    }
}
