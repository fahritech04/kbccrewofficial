<?php

namespace Database\Seeders;

use App\Models\NewsItem;
use Illuminate\Database\Seeder;

class NewsItemSeeder extends Seeder
{
    public function run(): void
    {
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
