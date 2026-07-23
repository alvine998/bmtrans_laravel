<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Format;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::orderBy('key')->get()->groupBy(fn($s) => explode('.', $s->key)[0] ?? 'general');
        $logo = SiteSetting::getValue('branding.logo');
        return view('admin.settings.index', compact('settings', 'logo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'keys' => ['nullable','array'],
            'keys.*' => ['string','max:200'],
            'settings_data' => ['nullable','array'],
            'settings_data.*' => ['nullable','string','max:5000'],
            'new_key' => ['nullable','string','max:200','regex:/^[a-z0-9_.-]+$/'],
            'new_value' => ['nullable','string','max:5000'],
            'logo' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        if ($request->hasFile('logo')) {
            SiteSetting::setValue('branding.logo', $this->storeLogo($request->file('logo')), 'image');
        }

        // Map encoded form keys back to real keys
        $keysMap = $request->input('keys', []);
        $dataMap = $request->input('settings_data', []);

        foreach ($keysMap as $formKey => $realKey) {
            // validate real key pattern server-side (whitelist)
            if (! preg_match('/^[a-z0-9_.-]+$/', $realKey)) continue;
            if ($realKey === 'branding.logo') continue; // handled by dedicated file upload above, never via generic text loop
            if (! array_key_exists($formKey, $dataMap)) continue;

            $value = $dataMap[$formKey];
            // Prevent empty overwrite when user didn't intend — but allow empty string to clear? We'll skip if both empty and existing
            // Use setValue which handles cache invalidation
            SiteSetting::setValue($realKey, $value, 'text');
        }

        // Handle new key/value creation
        if ($request->filled('new_key') && $request->filled('new_value')) {
            $newKey = $request->input('new_key');
            if (preg_match('/^[a-z0-9_.-]+$/', $newKey)) {
                SiteSetting::setValue($newKey, $request->input('new_value'), 'text');
            }
        } elseif ($request->filled('new_key') && ! $request->filled('new_value')) {
            // Allow creating key with empty value is not desired — ignore
        }

        return back()->with('success','Pengaturan disimpan. Cache setting di-reset.');
    }

    private function storeLogo($file): string
    {
        $manager = new ImageManager(GdDriver::class);
        $name = Str::random(32).'.webp';
        $rel = 'branding/'.$name;

        Storage::disk('public')->makeDirectory('branding');
        $full = Storage::disk('public')->path($rel);

        $manager->decodePath($file->getRealPath())
            ->scaleDown(width: 480)
            ->encodeUsingFormat(Format::WEBP, quality: 90)
            ->save($full);

        return $rel;
    }
}
