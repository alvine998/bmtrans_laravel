<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Models\ActivityLog;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Format;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('order')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.form', ['testimonial' => new Testimonial()]);
    }

    public function store(StoreTestimonialRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', true);
        $data['order'] = $data['order'] ?? 0;
        $data['rating'] = $data['rating'] ?? 5;

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->storeImage($request->file('photo'), 'testimonials');
        }

        $testimonial = Testimonial::create($data);

        ActivityLog::create([
            'admin_id' => Auth::guard('admin')->id(),
            'action' => 'created',
            'subject_type' => Testimonial::class,
            'subject_id' => $testimonial->id,
            'description' => 'Tambah testimoni '.$testimonial->name,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni ditambahkan.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.form', compact('testimonial'));
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', false);

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->storeImage($request->file('photo'), 'testimonials');
        }

        $testimonial->update($data);

        ActivityLog::create([
            'admin_id' => Auth::guard('admin')->id(),
            'action' => 'updated',
            'subject_type' => Testimonial::class,
            'subject_id' => $testimonial->id,
            'description' => 'Update testimoni '.$testimonial->name,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni diupdate.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni dihapus.');
    }

    private function storeImage($file, string $folder): string
    {
        $manager = new ImageManager(GdDriver::class);
        $name = Str::random(32).'.webp';
        $rel = $folder.'/'.$name;

        Storage::disk('public')->makeDirectory($folder);
        $full = Storage::disk('public')->path($rel);

        $manager->decodePath($file->getRealPath())
            ->scaleDown(width: 400)
            ->encodeUsingFormat(Format::WEBP, quality: 75)
            ->save($full);

        return $rel;
    }
}
