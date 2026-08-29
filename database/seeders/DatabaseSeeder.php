<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Armada;
use App\Models\ArticleCategory;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Admin::firstOrCreate(
            ['email' => 'superadmin@bmtrans.co.id'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'),
                'role' => 'super_admin',
                'is_active' => true,
            ]
        );

        Admin::firstOrCreate(
            ['email' => 'editor@bmtrans.co.id'],
            [
                'name' => 'Editor',
                'password' => Hash::make('password123'),
                'role' => 'editor',
                'is_active' => true,
            ]
        );

        // Settings
        $defaults = [
            'contact.phone' => '+62 711-123-456',
            'contact.whatsapp' => '6285220868477',
            'contact.email' => 'info@berkahmakmurtransport.co.id',
            'contact.address' => 'Jl. Raya Jakarta Timur No. 88, Cakung, Jakarta 13910',
            'payment.term' => '14 hari',
            'social.instagram' => '',
            'social.tiktok' => '',
            'seo.home_title' => 'PT Berkah Makmur Transport — Logistic Express Indonesia | Armada 24/7',
            'seo.home_description' => 'Spesialis trucking, sea freight & pengiriman udara sejak 2017. 120+ armada GPS real-time, asuransi all-risk. Penawaran 2 jam.',
            'stats.total_shipments' => '12.847',
            'site.name' => 'PT Berkah Makmur Transport',
        ];
        foreach ($defaults as $k => $v) {
            SiteSetting::updateOrCreate(['key' => $k], ['value' => $v, 'type' => 'text']);
        }

        // Categories
        $catLog = ArticleCategory::firstOrCreate(['slug' => 'logistik'], ['name' => 'Logistik', 'description' => 'Tips & regulasi logistik']);
        ArticleCategory::firstOrCreate(['slug' => 'armada'], ['name' => 'Armada']);


        // Services (DB driven, nav dynamic)
        Service::firstOrCreate(['slug' => 'pengiriman-darat'], [
            'title' => 'Pengiriman Darat',
            'excerpt' => 'Jalur Sumatera–Jawa–Bali, truk CDD s/d trailer 40ft, manajemen ODOL, GPS live.',
            'body' => '<p><strong>Trucking Sumatera—Jawa—Bali</strong> dengan 127 unit aktif. CDD bak, Fuso wingbox, tronton, trailer lowbed. Semua driver tetap, bukan harian lepas. SOP muat: cek surat, foto 4 sisi, segel, baru jalan.</p><p>Coverage: Jakarta—Bandung—Semarang—Surabaya—Bali—Lampung—Medan. Transit time rata-rata Jakarta–Surabaya 2–3 hari (tergantung antrian penyeberangan).</p>',
            'features' => ['Armada GPS real-time', 'Asuransi all-risk', 'SOP foto 4 sisi + video segel', 'Driver tetap bersertifikat', 'Laporan POD digital'],
            'order' => 1,
            'is_active' => true,
            'seo_title' => 'Pengiriman Darat Sumatera-Jawa-Bali | Truk Fuso Tronton',
        ]);

        Service::firstOrCreate(['slug' => 'sea-freight-kargo'], [
            'title' => 'Sea Freight & Kargo',
            'excerpt' => 'Kontainer 20/40ft LCL/FCL Tanjung Priok–Panjang–Belawan, handling pelabuhan.',
            'body' => '<p>LCL dan FCL via Tanjung Priok, Panjang, Belawan, Tanjung Perak. Kami handle trucking ke pelabuhan + dokumen + stuffing supervision.</p>',
            'features' => ['LCL Consolidation', 'FCL 20/40ft', 'Handling dokumen PEB/PIB', 'Trucking pelabuhan'],
            'order' => 2,
            'is_active' => true,
        ]);

        Service::firstOrCreate(['slug' => 'pengiriman-udara'], [
            'title' => 'Pengiriman Udara',
            'excerpt' => 'Kargo udara door-to-door, customs handling, real-time tracking untuk pengiriman cepat & urgent.',
            'body' => '<p>Layanan pengiriman udara untuk kargo ringan hingga berat, mencakup door-to-door pickup & delivery, penanganan customs & dokumentasi (AWB, PEB/PIB), serta real-time tracking. Cocok untuk pengiriman urgent, spare parts, elektronik, dan barang bernilai tinggi dengan lead time 1-3 hari.</p>',
            'features' => ['Door-to-door pickup & delivery', 'Customs handling (AWB/PEB/PIB)', 'Real-time tracking', 'Express 1-3 hari'],
            'order' => 3,
            'is_active' => true,
        ]);

        // Pages - hero wording now split into editable keys
        $berandaSections = [
            'hero_kicker' => 'Sejak 2017 — Jakarta • Bandung • Surabaya',
            'hero_title_1' => 'Logistik',
            'hero_title_2' => 'tidak boleh',
            'hero_title_3' => 'bermain-',
            'hero_title_4' => 'main.',
            'hero_subtitle' => 'Kami mengangkut muatan industri berat dan distribusi FMCG dengan 120+ armada GPS, asuransi all-risk, dan SOP muat-bongkar yang disiplin.',
            'hero_cta_primary' => 'Dapat Penawaran 2 Jam',
            'hero_cta_secondary' => 'Lihat Armada',
            'hero_badge_1' => '12.847 pengiriman selesai',
            'hero_badge_2' => 'ISO 9001:2015',
            'hero_badge_3' => 'Asuransi ACA',
            'hero_manifest_id' => 'BMT-2026-1847',
            'hero_manifest_note' => 'SOP bongkar wajib foto 4 sisi + video segel. Tidak ada kompromi.',
        ];
        $beranda = Page::firstOrCreate(['slug' => 'beranda'], [
            'title' => 'Beranda',
            'seo_title' => 'PT Berkah Makmur Transport — Logistic Express',
        ]);
        if(empty($beranda->sections) || !isset($beranda->sections['hero_title_1'])){
            $beranda->update(['sections' => $berandaSections]);
        } else {
            // backfill missing keys only
            $beranda->update(['sections' => array_merge($berandaSections, $beranda->sections)]);
        }
        // Armada — from user-provided price list, negotiable via WA
        $armadas = [
            ['name' => 'Pickup Bak', 'type' => 'pickup', 'price_start' => 200000, 'price_label' => '200rb', 'order' => 1, 'description' => 'Kapasitas ~2 ton, cocok dalam kota, barang ringan, pindahan kecil.'],
            ['name' => 'Pickup Box', 'type' => 'pickup', 'price_start' => 200000, 'price_label' => '200rb', 'order' => 2, 'description' => 'Pickup tertutup, aman hujan, akses gang sempit.'],
            ['name' => 'Colt Diesel Engkel Bak', 'type' => 'colt_diesel', 'price_start' => 400000, 'price_label' => '400rb', 'order' => 3, 'description' => '4 ban, bak kayu/besi, 6-7 ton area, distribusi toko.'],
            ['name' => 'Colt Diesel Engkel Box', 'type' => 'colt_diesel', 'price_start' => 450000, 'price_label' => '450rb', 'order' => 4, 'description' => 'CDD Box engkel, aman cuaca, muatan retail.'],
            ['name' => 'Colt Diesel Double Bak', 'type' => 'colt_diesel', 'price_start' => 600000, 'price_label' => '600rb', 'order' => 5, 'description' => '6 ban dobel, kapasitas 8-10 ton, antar kota.'],
            ['name' => 'Colt Diesel Double Box', 'type' => 'colt_diesel', 'price_start' => 600000, 'price_label' => '600rb', 'order' => 6, 'description' => 'CDD Box dobel, 12-14 kubik, aman & tertutup.'],
            ['name' => 'Fusso Engkel Bak', 'type' => 'fusso', 'price_start' => 1200000, 'price_label' => '1,2jt', 'order' => 7, 'description' => 'Engkel besar, 12-14 ton, muatan industri, bahan bangunan.'],
            ['name' => 'Fusso Engkel Box', 'type' => 'fusso', 'price_start' => 1200000, 'price_label' => '1,2jt', 'order' => 8, 'description' => 'Fusso box engkel, kapasitas besar, tertutup, paletized.'],
            ['name' => 'Tronton Bak', 'type' => 'tronton', 'price_start' => 1600000, 'price_label' => '1,6jt', 'order' => 9, 'description' => 'Tronton 10 ban, 20 ton, rute panjang Sumatera-Jawa.'],
            ['name' => 'Tronton Wingbox', 'type' => 'tronton', 'price_start' => 1600000, 'price_label' => '1,6jt', 'order' => 10, 'description' => 'Wingbox buka samping, bongkar cepat, FMCG & retail.'],
        ];
        foreach ($armadas as $row) {
            Armada::firstOrCreate(['name' => $row['name']], array_merge($row, [
                'price_note' => 'Mulai dari',
                'is_active' => true,
            ]));
        }

        $tentangSections = [
            'hero_kicker' => 'Tentang Kami',
            'hero_title_1' => 'Bukan sekadar',
            'hero_title_2' => 'angkut-angkut.',
            'intro_1' => 'PT Berkah Makmur Transport berdiri 2017 di Jakarta. Awalnya hanya 3 truk CDD untuk angkutan distribusi, kini mencakup jalur darat Sumatera–Jawa–Bali, sea freight LCL via Tanjung Priok, dan pengiriman udara ke seluruh Indonesia.',
            'intro_2' => 'Kami menolak overloading di atas toleransi, menolak jalan tikus tanpa izin, menolak bongkar tanpa dokumentasi. Mahal sedikit di depan, tapi murah di klaim belakang.',
            'visi' => 'Menjadi logistik industri paling dapat diandalkan di koridor barat Indonesia.',
            'misi' => 'Disiplin SOP, transparan tracking, driver sejahtera, kargo selamat.',
            'legal_siup' => 'SIUP: 503/XXX/2012',
            'legal_npwp' => 'NPWP: 00.000.000.0-000.000',
            'legal_tdp' => 'TDP: 06033520xxxx',
            'legal_iso' => 'ISO 9001:2015',
            'fleet_cdd' => '42 unit',
            'fleet_fuso' => '38 unit',
            'fleet_tronton' => '28 unit',
            'fleet_trailer' => '19 unit',
        ];
        $tentang = Page::firstOrCreate(['slug' => 'tentang-kami'], [
            'title' => 'Tentang Kami',
            'seo_title' => 'Tentang Kami — Legalitas, Armada, Visi Misi',
            'seo_description' => 'PT Berkah Makmur Transport berdiri 2017, armada 120+ unit, gudang 5000m2, legalitas lengkap.',
            'sections' => $tentangSections,
        ]);
        if (empty($tentang->sections) || ! isset($tentang->sections['hero_title_1'])) {
            $tentang->update(['sections' => $tentangSections]);
        } else {
            $tentang->update(['sections' => array_merge($tentangSections, $tentang->sections)]);
        }

        $kontakSections = [
            'hero_kicker' => 'Hubungi Kami',
            'hero_title' => 'Siap angkut. Siap jawab.',
            'intro' => 'Isi form atau chat WA. Estimasi tarif 2 jam kerja untuk rute reguler.',
        ];
        $kontak = Page::firstOrCreate(['slug' => 'kontak'], [
            'title' => 'Hubungi Kami',
            'sections' => $kontakSections,
        ]);
        if (empty($kontak->sections) || ! isset($kontak->sections['hero_title'])) {
            $kontak->update(['sections' => $kontakSections]);
        } else {
            $kontak->update(['sections' => array_merge($kontakSections, $kontak->sections)]);
        }

        // Testimonials
        $testimonials = [
            ['name' => 'Ahmad Rizky', 'company' => 'PT Sumber Makmur Abadi', 'quote' => 'Sudah 3 tahun pakai BM Trans untuk distribusi. On-time, driver disiplin, komunikasi lancar.', 'rating' => 5, 'order' => 1],
            ['name' => 'Budi Santoso', 'company' => 'CV Logistik Baja', 'quote' => 'Muatan butuh handling khusus. BM Trans handlingnya rapi dan profesional.', 'rating' => 5, 'order' => 2],
            ['name' => 'Dewi Lestari', 'company' => 'PT Indah Jaya Logistik', 'quote' => 'Pengiriman Surabaya–Jakarta selalu sampai tepat waktu. Tracking real-time sangat membantu.', 'rating' => 5, 'order' => 3],
            ['name' => 'Hendra Wijaya', 'company' => 'PT Multi Makmur Sejahtera', 'quote' => 'Armada lengkap, harga transparan. Koordinasi dengan tim operasional sangat mudah.', 'rating' => 5, 'order' => 4],
            ['name' => 'Rina Marlina', 'company' => 'PT Nusantara Freight', 'quote' => 'Distribusi FMCG kami lancar sejak pakai BM Trans. Lead time konsisten untuk semua rute.', 'rating' => 4, 'order' => 5],
            ['name' => 'Deni Kurniawan', 'company' => 'CV Sukses Mandiri', 'quote' => 'Pengiriman alat berat dengan trailer lowbed ditangani dari awal sampai akhir. Profesional.', 'rating' => 5, 'order' => 6],
            ['name' => 'Sari Permata', 'company' => 'PT Citra Logistics', 'quote' => 'SOP foto 4 sisi + video segel bikin kami tenang. Tidak ada klaim lagi soal kehilangan.', 'rating' => 5, 'order' => 7],
            ['name' => 'Andi Pratama', 'company' => 'PT Bangun Persada', 'quote' => 'Harga negotiable dan responsif. Kalau ada kendala di lapangan, langsung dikomunikasikan.', 'rating' => 4, 'order' => 8],
            ['name' => 'Maya Sari', 'company' => 'PT Delta Perkasa', 'quote' => 'Pengiriman ke Kalimantan dan Sulawesi juga ditangani. Jangkauan luas, armada siap.', 'rating' => 5, 'order' => 9],
            ['name' => 'Fajar Nugroho', 'company' => 'CV Abadi Jaya', 'quote' => 'Partner logistik terbaik untuk UMKM. Fleksibel, pahami kebutuhan bisnis kecil.', 'rating' => 5, 'order' => 10],
        ];
        foreach ($testimonials as $t) {
            \App\Models\Testimonial::firstOrCreate(
                ['name' => $t['name']],
                array_merge($t, ['is_active' => true])
            );
        }

        // Partners
        $partners = [
            ['name' => 'Shopee', 'order' => 1],
            ['name' => 'J&T Express', 'order' => 2],
            ['name' => 'Mr.DIY', 'order' => 3],
            ['name' => 'PT. Tifyco', 'order' => 4],
            ['name' => 'Lazada', 'order' => 5],
            ['name' => 'Kubikasi', 'order' => 6],
            ['name' => 'PT. GAS', 'order' => 7],
        ];
        foreach ($partners as $p) {
            Partner::firstOrCreate(['name' => $p['name']], array_merge($p, [
                'is_active' => true,
            ]));
        }

        $this->call(ArticleSeeder::class);
    }
}
