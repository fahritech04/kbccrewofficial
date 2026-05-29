<?php

namespace Tests\Feature;

use App\Http\Resources\Competition\CompetitionMatchResource;
use App\Http\Resources\Competition\CompetitionNewsResource;
use App\Http\Resources\Competition\CompetitionStandingResource;
use App\Http\Resources\Competition\CompetitionTeamResource;
use App\Models\NewsItem;
use App\Models\Standing;
use App\Models\Team;
use App\Models\TournamentMatch;
use Database\Seeders\NewsItemSeeder;
use Database\Seeders\StandingSeeder;
use Database\Seeders\TeamSeeder;
use Database\Seeders\TournamentMatchSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompetitionResourceContractTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            TeamSeeder::class,
            StandingSeeder::class,
            TournamentMatchSeeder::class,
            NewsItemSeeder::class,
        ]);
    }

    public function test_competition_match_resource_contract_keys_are_stable(): void
    {
        $match = TournamentMatch::query()
            ->with(['homeTeam:id,name,short_name,logo_url', 'awayTeam:id,name,short_name,logo_url'])
            ->firstOrFail();

        $payload = CompetitionMatchResource::make($match)->resolve();

        $this->assertArrayHasKey('id', $payload);
        $this->assertArrayHasKey('round', $payload);
        $this->assertArrayHasKey('venue', $payload);
        $this->assertArrayHasKey('match_date', $payload);
        $this->assertArrayHasKey('status', $payload);
        $this->assertArrayHasKey('scoreboard', $payload);
        $this->assertArrayHasKey('home_team', $payload);
        $this->assertArrayHasKey('away_team', $payload);
        $this->assertArrayHasKey('name', $payload['home_team']);
        $this->assertArrayHasKey('short_name', $payload['away_team']);
    }

    public function test_competition_standing_resource_contract_keys_are_stable(): void
    {
        $standing = Standing::query()
            ->with('team:id,name,short_name,logo_url,city,home_color')
            ->firstOrFail();

        $payload = CompetitionStandingResource::make($standing)->resolve();

        $this->assertArrayHasKey('id', $payload);
        $this->assertArrayHasKey('position', $payload);
        $this->assertArrayHasKey('played', $payload);
        $this->assertArrayHasKey('won', $payload);
        $this->assertArrayHasKey('lost', $payload);
        $this->assertArrayHasKey('point_diff', $payload);
        $this->assertArrayHasKey('points', $payload);
        $this->assertArrayHasKey('team', $payload);
        $this->assertArrayHasKey('name', $payload['team']);
        $this->assertArrayHasKey('logo_url', $payload['team']);
    }

    public function test_competition_team_resource_contract_keys_are_stable(): void
    {
        $team = Team::query()
            ->with('standing')
            ->withCount(['homeMatches', 'awayMatches'])
            ->firstOrFail();

        $payload = CompetitionTeamResource::make($team)->resolve();

        $this->assertArrayHasKey('id', $payload);
        $this->assertArrayHasKey('name', $payload);
        $this->assertArrayHasKey('short_name', $payload);
        $this->assertArrayHasKey('city', $payload);
        $this->assertArrayHasKey('logo_url', $payload);
        $this->assertArrayHasKey('matches_count', $payload);
        $this->assertArrayHasKey('standing', $payload);
        $this->assertArrayHasKey('position', $payload['standing']);
        $this->assertArrayHasKey('points', $payload['standing']);
    }

    public function test_competition_news_resource_contract_keys_are_stable(): void
    {
        $news = NewsItem::query()->firstOrFail();

        $payload = CompetitionNewsResource::make($news)->resolve();

        $this->assertArrayHasKey('id', $payload);
        $this->assertArrayHasKey('title', $payload);
        $this->assertArrayHasKey('slug', $payload);
        $this->assertArrayHasKey('category', $payload);
        $this->assertArrayHasKey('image_url', $payload);
        $this->assertArrayHasKey('excerpt', $payload);
        $this->assertArrayHasKey('content', $payload);
        $this->assertArrayHasKey('is_featured', $payload);
        $this->assertArrayHasKey('published_at', $payload);
    }
}
