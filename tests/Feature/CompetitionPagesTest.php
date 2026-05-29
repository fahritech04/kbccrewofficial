<?php

namespace Tests\Feature;

use Database\Seeders\NewsItemSeeder;
use Database\Seeders\StandingSeeder;
use Database\Seeders\TeamSeeder;
use Database\Seeders\TournamentMatchSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
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

    public function test_home_page_returns_200_and_expected_props_structure(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Home')
                ->whereType('featuredNews', 'array')
                ->whereType('news', 'array')
                ->whereType('standings', 'array')
                ->whereType('matches', 'array')
                ->has('featuredNews', fn (Assert $news) => $news
                    ->hasAll([
                        'id',
                        'title',
                        'slug',
                        'category',
                        'image_url',
                        'published_at',
                    ])
                    ->etc())
                ->has('news.0')
                ->has('standings.0')
                ->has('matches.0')
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

    public function test_instagram_page_returns_200_and_expected_props_structure(): void
    {
        Cache::flush();

        Http::fake([
            'https://www.instagram.com/api/v1/users/web_profile_info/*' => Http::response([
                'data' => [
                    'user' => [
                        'username' => 'kbccrewofficial',
                        'profile_pic_url' => 'https://scontent.cdninstagram.com/profile.jpg',
                        'edge_followed_by' => ['count' => 1621],
                        'edge_owner_to_timeline_media' => [
                            'count' => 506,
                            'edges' => [[
                                'node' => [
                                    'id' => 'ig-1',
                                    'shortcode' => 'ABC123',
                                    'taken_at_timestamp' => 1770000000,
                                    'is_video' => false,
                                    'display_url' => 'https://scontent.cdninstagram.com/post.jpg',
                                    'edge_media_to_caption' => [
                                        'edges' => [[
                                            'node' => ['text' => 'Caption test'],
                                        ]],
                                    ],
                                    'edge_media_to_comment' => ['count' => 5],
                                    'edge_liked_by' => ['count' => 20],
                                ],
                            ]],
                        ],
                    ],
                ],
            ], 200),
        ]);

        $this->get(route('instagram.index'))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Instagram')
                ->whereType('instagram', 'array')
                ->where('instagram.is_live', true)
                ->has('instagram.profile', fn (Assert $profile) => $profile
                    ->hasAll([
                        'username',
                        'profile_url',
                        'followers_count',
                        'media_count',
                        'profile_picture_url',
                    ])
                    ->etc())
                ->has('instagram.posts.0', fn (Assert $post) => $post
                    ->hasAll([
                        'id',
                        'caption',
                        'comments_count',
                        'like_count',
                        'media_type',
                        'image_url',
                        'permalink',
                        'timestamp',
                        'comments',
                    ])
                    ->etc())
                ->etc());
    }
}
