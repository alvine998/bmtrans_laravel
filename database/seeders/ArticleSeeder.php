<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $catId = fn (string $slug) => ArticleCategory::where('slug', $slug)->value('id');
        $log = $catId('logistik');
        $armada = $catId('armada');
        $author = Admin::value('id');

        $articles = [
            ['title' => 'Cara Menghitung Ongkos Kirim Trucking Antar Kota', 'category_id' => $log, 'excerpt' => 'Panduan menghitung tarif trucking berdasarkan jarak, tonase, dan jenis muatan.', 'body' => '<p>Tarif trucking dihitung dari kombinasi jarak tempuh, berat/volume muatan, jenis armada, dan risiko rute. Berikut komponen utama yang mempengaruhi harga.</p><p>Perusahaan logistik umumnya menggunakan rumus dasar: tarif per km dikali jarak, ditambah biaya bongkar muat dan asuransi. Untuk rute Sumatera-Jawa, biaya penyeberangan turut mempengaruhi total ongkos.</p>'],
            ['title' => 'Regulasi ODOL dan Dampaknya bagi Perusahaan Trucking', 'category_id' => $log, 'excerpt' => 'Memahami aturan Over Dimension Over Load dan cara perusahaan trucking mematuhi regulasi ini.', 'body' => '<p>ODOL (Over Dimension Over Load) menjadi perhatian serius pemerintah untuk menekan kerusakan jalan dan kecelakaan lalu lintas. Perusahaan trucking wajib memastikan muatan sesuai dimensi dan tonase kendaraan.</p><p>Kami menerapkan SOP timbang ulang sebelum keberangkatan untuk memastikan kepatuhan penuh terhadap regulasi Kementerian Perhubungan.</p>'],
            ['title' => 'Tips Memilih Ekspedisi untuk Bisnis FMCG', 'category_id' => $log, 'excerpt' => 'Kriteria penting memilih mitra logistik untuk distribusi produk cepat saji.', 'body' => '<p>Bisnis FMCG membutuhkan mitra logistik dengan lead time konsisten dan jaringan distribusi luas. Beberapa kriteria penting: ketersediaan armada box tertutup, sistem tracking real-time, dan rekam jejak ketepatan waktu.</p>'],
            ['title' => 'Mengenal Sistem GPS Tracking pada Armada Trucking', 'category_id' => $armada, 'excerpt' => 'Bagaimana teknologi GPS membantu memantau pengiriman secara real-time.', 'body' => '<p>Seluruh armada kami dilengkapi GPS tracking yang memungkinkan klien memantau posisi kendaraan secara real-time melalui dashboard. Teknologi ini juga membantu tim operasional mengoptimalkan rute dan merespons kendala di jalan lebih cepat.</p>'],
            ['title' => 'Perawatan Berkala Armada: Kunci Ketepatan Waktu Pengiriman', 'category_id' => $armada, 'excerpt' => 'Jadwal maintenance rutin yang kami terapkan untuk menjaga performa 127 unit armada.', 'body' => '<p>Setiap unit armada menjalani pemeriksaan berkala meliputi rem, ban, mesin, dan sistem kelistrikan. Perawatan preventif ini mengurangi risiko mogok di jalan yang dapat mengganggu jadwal pengiriman klien.</p>'],
            ['title' => 'Jenis-Jenis Truk dan Kegunaannya dalam Logistik', 'category_id' => $armada, 'excerpt' => 'Dari pickup hingga tronton wingbox, kenali fungsi masing-masing jenis armada.', 'body' => '<p>Pemilihan jenis truk yang tepat sangat menentukan efisiensi pengiriman. Pickup cocok untuk muatan ringan dalam kota, sementara tronton dan trailer digunakan untuk muatan besar antar provinsi.</p><p>Colt Diesel Double menjadi pilihan populer untuk rute menengah karena keseimbangan kapasitas dan biaya operasional.</p>'],

        ];

        foreach ($articles as $i => $a) {
            Article::firstOrCreate(
                ['title' => $a['title']],
                [
                    'category_id' => $a['category_id'],
                    'excerpt' => $a['excerpt'],
                    'body' => $a['body'],
                    'author_id' => $author,
                    'status' => 'published',
                    'published_at' => now()->subDays(count($articles) - $i),
                    'views' => rand(20, 500),
                ]
            );
        }
    }
}
