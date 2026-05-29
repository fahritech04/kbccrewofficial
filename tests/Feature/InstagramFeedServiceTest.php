<?php

namespace Tests\Feature;

use App\Services\Instagram\InstagramFeedService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class InstagramFeedServiceTest extends TestCase
{
    public function test_get_feed_returns_unavailable_payload_when_public_instagram_request_fails(): void
    {
        Cache::flush();

        config()->set('services.instagram', [
            'username' => 'kbccrewofficial',
            'user_id' => null,
            'access_token' => null,
            'graph_version' => 'v23.0',
            'cache_minutes' => 1,
            'comments_limit' => 3,
        ]);

        Http::fake([
            '*' => Http::response([], 500),
        ]);

        $feed = app(InstagramFeedService::class)->getFeed(3);

        $this->assertFalse($feed['is_live']);
        $this->assertSame('kbccrewofficial', $feed['profile']['username']);
        $this->assertIsArray($feed['posts']);
        $this->assertCount(0, $feed['posts']);
        $this->assertSame(
            'Instagram feed belum tersedia saat ini. Coba isi credential API resmi atau refresh lagi beberapa saat.',
            $feed['message'],
        );
    }
}
