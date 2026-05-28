<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\TournamentMatch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class TournamentMatchSeeder extends Seeder
{
    public function run(): void
    {
        $teamIds = Team::query()->pluck('id', 'short_name');

        $matches = [
            ['home' => 'KHB', 'away' => 'TTG', 'round' => 'Week 9', 'venue' => 'GOR Kotabaru', 'date' => now()->addDays(2), 'status' => 'scheduled'],
            ['home' => 'SUN', 'away' => 'BRW', 'round' => 'Week 9', 'venue' => 'GOR Sungai Danau', 'date' => now()->addDays(3), 'status' => 'scheduled'],
            ['home' => 'BLZ', 'away' => 'PLS', 'round' => 'Week 9', 'venue' => 'GOR Barito', 'date' => now()->addDays(4), 'status' => 'scheduled'],
            ['home' => 'TTG', 'away' => 'SUN', 'round' => 'Week 8', 'venue' => 'GOR Tanjung', 'date' => now()->subDays(3), 'status' => 'finished', 'home_score' => 83, 'away_score' => 79, 'is_highlight' => true],
            ['home' => 'BRW', 'away' => 'KHB', 'round' => 'Week 8', 'venue' => 'GOR Borneo', 'date' => now()->subDays(4), 'status' => 'finished', 'home_score' => 70, 'away_score' => 88, 'is_highlight' => true],
            ['home' => 'PLS', 'away' => 'BLZ', 'round' => 'Week 8', 'venue' => 'GOR Pelaihari', 'date' => now()->subDays(5), 'status' => 'finished', 'home_score' => 69, 'away_score' => 75, 'is_highlight' => false],
        ];

        foreach ($matches as $match) {
            TournamentMatch::create([
                'home_team_id' => $teamIds[$match['home']],
                'away_team_id' => $teamIds[$match['away']],
                'round' => $match['round'],
                'venue' => $match['venue'],
                'match_date' => $match['date'],
                'status' => $match['status'],
                'home_score' => Arr::get($match, 'home_score'),
                'away_score' => Arr::get($match, 'away_score'),
                'is_highlight' => Arr::get($match, 'is_highlight', false),
            ]);
        }
    }
}
