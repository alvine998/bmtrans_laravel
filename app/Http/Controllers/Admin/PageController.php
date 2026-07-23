<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /** @var array<string, array<string, string>> */
    private const SECTIONS_BY_SLUG = [
        'beranda' => [
            'hero_kicker'        => 'Hero kicker — small label above title',
            'hero_title_1'       => 'Hero Title baris 1',
            'hero_title_2'       => 'Hero Title baris 2 (yellow accent)',
            'hero_title_3'       => 'Hero Title baris 3',
            'hero_title_4'       => 'Hero Title baris 4 (red box)',
            'hero_subtitle'      => 'Hero subtitle paragraf',
            'hero_cta_primary'   => 'CTA primary text',
            'hero_cta_secondary' => 'CTA secondary text',
            'hero_badge_1'       => 'Trust badge 1',
            'hero_badge_2'       => 'Trust badge 2',
            'hero_badge_3'       => 'Trust badge 3',
            'hero_manifest_id'   => 'Manifest card ID',
            'hero_manifest_note' => 'Manifest floating note',
            'stats_label'        => 'Track record label',
            'cta_kicker'         => 'CTA section kicker',
            'cta_title'          => 'CTA section title',
        ],
        'tentang-kami' => [
            'hero_kicker'     => 'Label di atas judul',
            'hero_title_1'    => 'Judul baris 1',
            'hero_title_2'    => 'Judul baris 2 (kuning)',
            'intro_1'         => 'Paragraf intro 1',
            'intro_2'         => 'Paragraf intro 2',
            'visi'            => 'Visi',
            'misi'            => 'Misi',
            'legal_siup'      => 'SIUP',
            'legal_npwp'      => 'NPWP',
            'legal_tdp'       => 'TDP',
            'legal_iso'       => 'ISO / sertifikasi',
            'fleet_cdd'       => 'Jumlah unit CDD',
            'fleet_fuso'      => 'Jumlah unit Fuso',
            'fleet_tronton'   => 'Jumlah unit Tronton',
            'fleet_trailer'   => 'Jumlah unit Trailer 40ft',
        ],
        'kontak' => [
            'hero_kicker'  => 'Label di atas judul',
            'hero_title'   => 'Judul hero',
            'intro'        => 'Paragraf intro',
        ],
    ];

    /** Keys allowed as HTML (purified). Rest = plain text strip_tags. */
    private const HTML_KEYS = ['intro_1', 'intro_2', 'visi', 'misi', 'intro'];

    public function index()
    {
        $pages = Page::orderBy('slug')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function edit(Page $page)
    {
        $editable = self::SECTIONS_BY_SLUG[$page->slug] ?? [];

        return view('admin.pages.form', [
            'page' => $page,
            'editable' => $editable,
        ]);
    }

    public function update(Request $request, Page $page): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'slug' => ['required', 'string', 'max:200', 'regex:/^[a-z0-9-]+$/'],
            'seo_title' => ['nullable', 'string', 'max:300'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'sections' => ['nullable', 'array'],
            'sections.*' => ['nullable', 'string', 'max:5000'],
        ]);

        $data = $request->only(['title', 'seo_title', 'seo_description']);

        $slug = Str::slug($request->input('slug'));
        if (Page::where('slug', $slug)->where('id', '!=', $page->id)->exists()) {
            return back()->withErrors(['slug' => 'Slug sudah dipakai halaman lain.'])->withInput();
        }
        $data['slug'] = $slug;

        $whitelist = self::SECTIONS_BY_SLUG[$page->slug] ?? [];
        $sections = [];
        foreach (($request->input('sections', [])) as $k => $v) {
            if (! array_key_exists($k, $whitelist)) {
                continue;
            }
            $v = is_string($v) ? $v : '';
            if (in_array($k, self::HTML_KEYS, true)) {
                $sections[$k] = clean($v);
            } else {
                $sections[$k] = trim(strip_tags($v));
            }
        }

        $existing = $page->sections ?? [];
        $data['sections'] = array_merge($existing, $sections);

        $page->update($data);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman diperbarui.');
    }
}
