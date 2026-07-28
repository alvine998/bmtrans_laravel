<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartnerRequest;
use App\Http\Requests\UpdatePartnerRequest;
use App\Models\ActivityLog;
use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Format;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::ordered()->paginate(20);
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.form', ['partner' => new Partner()]);
    }

    public function store(StorePartnerRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['order'] = $data['order'] ?? 0;

        if ($request->hasFile('logo')) {
            $data['logo'] = $this->storeImage($request->file('logo'), 'partners');
        }

        $partner = Partner::create($data);

        ActivityLog::create([
            'admin_id' => Auth::guard('admin')->id(),
            'action' => 'created',
            'subject_type' => Partner::class,
            'subject_id' => $partner->id,
            'description' => 'Tambah partner '.$partner->name,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.partners.index')->with('success', 'Partner ditambahkan.');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.form', compact('partner'));
    }

    public function update(UpdatePartnerRequest $request, Partner $partner): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active', false);

        if ($request->hasFile('logo')) {
            $data['logo'] = $this->storeImage($request->file('logo'), 'partners');
        }

        $partner->update($data);

        ActivityLog::create([
            'admin_id' => Auth::guard('admin')->id(),
            'action' => 'updated',
            'subject_type' => Partner::class,
            'subject_id' => $partner->id,
            'description' => 'Update partner '.$partner->name,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.partners.index')->with('success', 'Partner diupdate.');
    }

    public function destroy(Partner $partner): RedirectResponse
    {
        $partner->delete();
        return redirect()->route('admin.partners.index')->with('success', 'Partner dihapus.');
    }

    private function storeImage($file, string $folder): string
    {
        $manager = new ImageManager(GdDriver::class);
        $name = Str::random(32).'.webp';
        $rel = $folder.'/'.$name;

        Storage::disk('public')->makeDirectory($folder);
        $full = Storage::disk('public')->path($rel);

        $manager->decodePath($file->getRealPath())
            ->scaleDown(width: 800)
            ->encodeUsingFormat(Format::WEBP, quality: 75)
            ->save($full);

        return $rel;
    }
}
