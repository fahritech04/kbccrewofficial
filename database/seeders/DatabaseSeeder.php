<?php

namespace Database\Seeders;

use App\Models\NewsItem;
use App\Models\Standing;
use App\Models\Team;
use App\Models\TournamentMatch;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        TournamentMatch::truncate();
        Standing::truncate();
        NewsItem::truncate();
        Team::truncate();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        User::factory()->create([
            'name' => 'Admin Kotabaru',
            'email' => 'admin@kotabarubasket.test',
        ]);

        Team::insert([
            [
                'name' => 'Kotabaru Hawks',
                'short_name' => 'KHB',
                'city' => 'Kotabaru',
                'logo_url' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=120&q=80',
                'home_color' => '#ff005f',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tanjung Tigers',
                'short_name' => 'TTG',
                'city' => 'Tanjung',
                'logo_url' => 'https://images.unsplash.com/photo-1519861531473-9200262188bf?auto=format&fit=crop&w=120&q=80',
                'home_color' => '#00f2ff',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sungai United',
                'short_name' => 'SUN',
                'city' => 'Sungai Danau',
                'logo_url' => 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?auto=format&fit=crop&w=120&q=80',
                'home_color' => '#8b5cf6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Borneo Warriors',
                'short_name' => 'BRW',
                'city' => 'Banjarmasin',
                'logo_url' => 'https://images.unsplash.com/photo-1471295253337-3ceaaedca402?auto=format&fit=crop&w=120&q=80',
                'home_color' => '#ff9f1c',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Barito Blaze',
                'short_name' => 'BLZ',
                'city' => 'Barito',
                'logo_url' => 'https://images.unsplash.com/photo-1599058917212-d750089bc07e?auto=format&fit=crop&w=120&q=80',
                'home_color' => '#22c55e',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pelaihari Storm',
                'short_name' => 'PLS',
                'city' => 'Pelaihari',
                'logo_url' => 'https://images.unsplash.com/photo-1518063319789-7217e6706b04?auto=format&fit=crop&w=120&q=80',
                'home_color' => '#f97316',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

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

        NewsItem::insert([
            [
                'title' => 'Kotabaru Hawks Menang Dramatis dan Kunci Puncak Klasemen',
                'slug' => 'kotabaru-hawks-kunci-puncak',
                'category' => 'Highlights',
                'image_url' => 'https://images.unsplash.com/photo-1544919982-b61976f0ba43?auto=format&fit=crop&w=1400&q=80',
                'excerpt' => 'Tripoin penentu di 8 detik terakhir membawa Hawks unggul tipis atas rival terdekat.',
                'content' => 'Kotabaru Hawks menampilkan pertahanan solid dan transisi cepat sepanjang laga.',
                'is_featured' => true,
                'published_at' => now()->subHours(6),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Jadwal Week 9 Resmi Dirilis: Big Match Hawks vs Tigers',
                'slug' => 'jadwal-week-9-resmi-dirilis',
                'category' => 'Matches',
                'image_url' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=1000&q=80',
                'excerpt' => 'Pertemuan dua tim teratas akan digelar Sabtu malam di GOR Kotabaru.',
                'content' => 'Pekan ke-9 diprediksi menentukan peta playoff secara signifikan.',
                'is_featured' => false,
                'published_at' => now()->subHours(9),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Sungai United Fokus Benahi Rebound Jelang Fase Akhir',
                'slug' => 'sungai-united-benahi-rebound',
                'category' => 'Teams',
                'image_url' => 'https://images.unsplash.com/photo-1517927033932-b3d18e61fb3a?auto=format&fit=crop&w=1000&q=80',
                'excerpt' => 'Pelatih menilai duel rebound jadi titik pembeda dalam dua laga terakhir.',
                'content' => 'Program latihan tambahan difokuskan pada box-out dan second chance points.',
                'is_featured' => false,
                'published_at' => now()->subHours(13),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Borneo Warriors Perkenalkan Jersey Edisi Kandangan',
                'slug' => 'borneo-warriors-jersey-edisi-kandangan',
                'category' => 'Club',
                'image_url' => 'https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=1000&q=80',
                'excerpt' => 'Desain baru terinspirasi motif lokal dan akan debut di kandang pekan ini.',
                'content' => 'Jersey anyar diproduksi terbatas dan langsung diserbu penggemar.',
                'is_featured' => false,
                'published_at' => now()->subDay(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Barito Blaze Siap Rotasi Lebih Dalam untuk Jaga Intensitas',
                'slug' => 'barito-blaze-siap-rotasi',
                'category' => 'Tactics',
                'image_url' => 'https://images.unsplash.com/photo-1504450758481-7338eba7524a?auto=format&fit=crop&w=1000&q=80',
                'excerpt' => 'Rotasi 10 pemain dirancang untuk menjaga tempo sejak kuarter pertama.',
                'content' => 'Staf pelatih mengincar efisiensi serangan dari second unit.',
                'is_featured' => false,
                'published_at' => now()->subDays(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
