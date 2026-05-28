<?php

namespace Database\Seeders;

use App\Models\NewsItem;
use App\Models\Standing;
use App\Models\Team;
use App\Models\TournamentMatch;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->truncateTournamentData();

        $this->call([
            AdminUserSeeder::class,
            TeamSeeder::class,
            StandingSeeder::class,
            TournamentMatchSeeder::class,
            NewsItemSeeder::class,
        ]);
    }

    private function truncateTournamentData(): void
    {
        Schema::disableForeignKeyConstraints();
        TournamentMatch::truncate();
        Standing::truncate();
        NewsItem::truncate();
        Team::truncate();
        User::truncate();
        Schema::enableForeignKeyConstraints();
    }
}
