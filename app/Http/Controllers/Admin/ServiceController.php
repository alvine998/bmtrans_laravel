<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\ActivityLog;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Format;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::ordered()->paginate(20);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.form', ['service' => new Service()]);
    }

    public function store(StoreServiceRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        $data['body'] = isset($data['body']) ? clean($data['body']) : null;
        $data['is_active'] = $request->boolean('is_active', true);
        $data['order'] = $data['order'] ?? 0;

        // handle image
        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request->file('image'), 'services');
        }

        $service = Service::create($data);

        ActivityLog::create([
            'admin_id' => Auth::guard('admin')->id(),
            'action' => 'created',
            'subject_type' => Service::class,
            'subject_id' => $service->id,
            'description' => 'Buat layanan '.$service->title,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Layanan dibuat.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.form', compact('service'));
    }

    public function update(UpdateServiceRequest $request, Service $service): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        if (isset($data['body'])) $data['body'] = clean($data['body']);
        $data['is_active'] = $request->boolean('is_active', false);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request->file('image'), 'services');
        }

        $service->update($data);

        ActivityLog::create([
            'admin_id' => Auth::guard('admin')->id(),
            'action' => 'updated',
            'subject_type' => Service::class,
            'subject_id' => $service->id,
            'description' => 'Update layanan '.$service->title,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Layanan diupdate.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Layanan dihapus.');
    }

    private function storeImage($file, string $folder): string
    {
        $manager = new ImageManager(GdDriver::class);
        $name = Str::random(32).'.webp';
        $rel = $folder.'/'.$name;

        Storage::disk('public')->makeDirectory($folder);
        $full = Storage::disk('public')->path($rel);

        $manager->decodePath($file->getRealPath())
            ->scaleDown(width: 1600)
            ->encodeUsingFormat(Format::WEBP, quality: 80)
            ->save($full);

        return $rel;
    }
}
