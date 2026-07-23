<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Format;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\ImageManager;

class GalleryController extends Controller
{
    public function index()
    {
        $items = GalleryItem::latest()->paginate(24);
        return view('admin.gallery.index', compact('items'));
    }

    public function create()
    {
        return view('admin.gallery.form', ['item' => new GalleryItem()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['nullable','string','max:200'],
            'type' => ['required','in:image,video'],
            'file' => ['required','file','mimes:jpg,jpeg,png,webp,mp4,mov','max:20480'],
            'category' => ['nullable','string','max:100'],
            'caption' => ['nullable','string','max:500'],
            'alt_text' => ['nullable','string','max:500'],
            'order' => ['nullable','integer'],
        ]);

        $data = [
            'title' => strip_tags($request->input('title','')),
            'type' => $request->input('type'),
            'category' => $request->input('category'),
            'caption' => strip_tags($request->input('caption','')),
            'alt_text' => strip_tags($request->input('alt_text','')),
            'order' => $request->input('order',0),
            'is_active' => true,
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            if ($data['type'] === 'image') {
                $manager = new ImageManager(GdDriver::class);
                $name = Str::random(32).'.webp';
                $rel = "gallery/{$name}";
                Storage::disk('public')->makeDirectory('gallery');
                $full = Storage::disk('public')->path($rel);
                $manager->decodePath($file->getRealPath())
                    ->scaleDown(width: 1600)
                    ->encodeUsingFormat(Format::WEBP, quality: 80)
                    ->save($full);
                $data['file_path'] = $rel;
            } else {
                $name = Str::random(32).'.'.$file->getClientOriginalExtension();
                $stored = $file->storeAs('gallery/videos', $name, 'public');
                $data['file_path'] = $stored;
            }
        }

        GalleryItem::create($data);
        return redirect()->route('admin.gallery.index')->with('success','Galeri ditambahkan.');
    }

    public function destroy(GalleryItem $gallery)
    {
        if ($gallery->file_path && Storage::disk('public')->exists($gallery->file_path)) {
            Storage::disk('public')->delete($gallery->file_path);
        }
        $gallery->delete();
        return back()->with('success','Galeri dihapus.');
    }
}
