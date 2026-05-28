<?php

namespace Database\Seeders;

use App\Models\Standing;
use App\Models\Team;
use Illuminate\Database\Seeder;

class StandingSeeder extends Seeder
{
    public function run(): void
    {
        $teamIds = Team::query()->pluck('id', 'short_name');

        $standings = [
            ['team' => 'KHB', 'played' => 8, 'won' => 7, 'lost' => 1, 'points_for' => 686, 'points_against' => 592, 'points' => 15],
            ['team' => 'TTG', 'played' => 8, 'won' => 6, 'lost' => 2, 'points_for' => 671, 'points_against' => 619, 'points' => 14],
            ['team' => 'SUN', 'played' => 8, 'won' => 5, 'lost' => 3, 'points_for' => 643, 'points_against' => 628, 'points' => 13],
            ['team' => 'BRW', 'played' => 8, 'won' => 4, 'lost' => 4, 'points_for' => 620, 'points_against' => 624, 'points' => 12],
            ['team' => 'BLZ', 'played' => 8, 'won' => 2, 'lost' => 6, 'points_for' => 588, 'points_against' => 660, 'points' => 10],
            ['team' => 'PLS', 'played' => 8, 'won' => 0, 'lost' => 8, 'points_for' => 551, 'points_against' => 636, 'points' => 8],
        ];

        foreach ($standings as $index => $row) {
            Standing::create([
                'team_id' => $teamIds[$row['team']],
                'position' => $index + 1,
                'played' => $row['played'],
                'won' => $row['won'],
                'lost' => $row['lost'],
                'points_for' => $row['points_for'],
                'points_against' => $row['points_against'],
                'point_diff' => $row['points_for'] - $row['points_against'],
                'points' => $row['points'],
            ]);
        }
    }
}
