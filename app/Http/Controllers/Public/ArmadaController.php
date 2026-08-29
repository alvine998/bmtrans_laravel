<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Armada;
use App\Models\SiteSetting;

class ArmadaController extends Controller
{
    public function index()
    {
        $armadas = Armada::active()->ordered()->get();

        // Group by type for UI sections (optional)
        $grouped = $armadas->groupBy(fn($a) => $a->type ?: 'Lainnya');

        $whatsapp = SiteSetting::getValue('contact.whatsapp', '6285220868477');
        $waMessage = rawurlencode("Halo BM Trans, saya ingin negosiasi harga armada. Bisa dibantu?");

        return view('armada.index', compact('armadas', 'grouped', 'whatsapp', 'waMessage'), [
            'seoTitle' => 'Daftar Armada & Harga Mulai — PT Berkah Makmur Transport',
            'seoDescription' => 'Daftar armada BM Trans mulai dari 200rb: Pickup, Colt Diesel, Fusso, Tronton Wingbox. Harga negotiable, hubungi admin untuk penawaran terbaik.',
            'canonical' => route('armada.index'),
        ]);
    }
}
