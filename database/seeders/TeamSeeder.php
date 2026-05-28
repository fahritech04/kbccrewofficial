<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
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
    }
}
