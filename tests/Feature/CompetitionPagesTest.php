<?php

namespace Tests\Feature;

use Database\Seeders\NewsItemSeeder;
use Database\Seeders\StandingSeeder;
use Database\Seeders\TeamSeeder;
use Database\Seeders\TournamentMatchSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class CompetitionPagesTest extends TestCase
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

    public function test_matches_page_returns_200_and_expected_props_structure(): void
    {
        $this->get(route('matches.index'))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Matches')
                ->whereType('upcomingMatches', 'array')
                ->whereType('recentMatches', 'array')
                ->has('upcomingMatches.0', fn (Assert $match) => $match
                    ->hasAll([
                        'id',
                        'round',
                        'venue',
                        'match_date',
                        'status',
                        'scoreboard',
                        'home_team',
                        'away_team',
                    ])
                    ->whereType('home_team', 'array')
                    ->whereType('away_team', 'array')
                    ->etc())
                ->has('recentMatches.0')
                ->etc());
    }

    public function test_table_page_returns_200_and_expected_props_structure(): void
    {
        $this->get(route('table.index'))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Table')
                ->whereType('standings', 'array')
                ->whereType('leader', 'array')
                ->has('standings.0', fn (Assert $standing) => $standing
                    ->hasAll([
                        'id',
                        'position',
                        'played',
                        'won',
                        'lost',
                        'point_diff',
                        'points',
                        'team',
                    ])
                    ->whereType('team', 'array')
                    ->etc())
                ->etc());
    }

    public function test_statistics_page_returns_200_and_expected_props_structure(): void
    {
        $this->get(route('statistics.index'))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Statistics')
                ->whereType('summary', 'array')
                ->whereType('topOffense', 'array')
                ->whereType('topDefense', 'array')
                ->whereType('topPointDiff', 'array')
                ->has('summary', fn (Assert $summary) => $summary
                    ->hasAll([
                        'total_matches',
                        'scheduled_matches',
                        'live_matches',
                        'finished_matches',
                        'average_total_points',
                    ])
                    ->etc())
                ->has('topPointDiff.0')
                ->etc());
    }

    public function test_players_page_returns_200_and_expected_props_structure(): void
    {
        $this->get(route('players.index'))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Players')
                ->whereType('spotlightTeams', 'array')
                ->whereType('stories', 'array')
                ->has('spotlightTeams.0')
                ->has('stories.0', fn (Assert $story) => $story
                    ->hasAll([
                        'id',
                        'title',
                        'slug',
                        'category',
                        'image_url',
                        'published_at',
                    ])
                    ->etc())
                ->etc());
    }

    public function test_clubs_page_returns_200_and_expected_props_structure(): void
    {
        $this->get(route('clubs.index'))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Clubs')
                ->whereType('clubs', 'array')
                ->has('clubs.0', fn (Assert $club) => $club
                    ->hasAll([
                        'id',
                        'name',
                        'short_name',
                        'city',
                        'logo_url',
                        'home_color',
                        'matches_count',
                    ])
                    ->etc())
                ->etc());
    }
}
