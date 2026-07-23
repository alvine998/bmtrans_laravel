<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArmadaRequest;
use App\Http\Requests\UpdateArmadaRequest;
use App\Models\ActivityLog;
use App\Models\Armada;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Format;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class ArmadaController extends Controller
{
    public function index()
    {
        $armadas = Armada::ordered()->paginate(50);
        return view('admin.armada.index', compact('armadas'));
    }

    public function create()
    {
        return view('admin.armada.form', ['armada' => new Armada(['price_note' => 'Mulai dari', 'is_active' => true])]);
    }

    public function store(StoreArmadaRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', true);
        $data['order'] = $data['order'] ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request->file('image'), 'armada');
        }

        $armada = Armada::create($data);

        ActivityLog::create([
            'admin_id' => Auth::guard('admin')->id(),
            'action' => 'created',
            'subject_type' => Armada::class,
            'subject_id' => $armada->id,
            'description' => 'Buat armada '.$armada->name,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.armada.index')->with('success', 'Armada dibuat.');
    }

    public function edit(Armada $armada)
    {
        return view('admin.armada.form', compact('armada'));
    }

    public function update(UpdateArmadaRequest $request, Armada $armada): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', false);

        // remove flag
        if ($request->boolean('remove_image')) {
            $this->deleteImage($armada->image);
            $data['image'] = null;
        }

        if ($request->hasFile('image')) {
            // delete old first
            if (! empty($armada->image) && empty($data['image'])) {
                $this->deleteImage($armada->image);
            } elseif (! empty($armada->image) && $request->hasFile('image')) {
                $this->deleteImage($armada->image);
            }
            $data['image'] = $this->storeImage($request->file('image'), 'armada');
        }

        $armada->update($data);

        ActivityLog::create([
            'admin_id' => Auth::guard('admin')->id(),
            'action' => 'updated',
            'subject_type' => Armada::class,
            'subject_id' => $armada->id,
            'description' => 'Update armada '.$armada->name,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.armada.index')->with('success', 'Armada diupdate.');
    }

    public function destroy(Armada $armada): RedirectResponse
    {
        $this->deleteImage($armada->image);
        $armada->delete();
        return redirect()->route('admin.armada.index')->with('success', 'Armada dihapus.');
    }

    private function storeImage($file, string $folder): string
    {
        $manager = new ImageManager(GdDriver::class);
        $name = Str::random(32).'.webp';
        $path = $folder.'/'.$name;

        Storage::disk('public')->makeDirectory($folder);
        $full = Storage::disk('public')->path($path);

        $manager->decodePath($file->getRealPath())
            ->scaleDown(width: 1400)
            ->encodeUsingFormat(Format::WEBP, quality: 82)
            ->save($full);

        return $path;
    }

    private function deleteImage(?string $relPath): void
    {
        if (! $relPath) return;
        if (Storage::disk('public')->exists($relPath)) {
            Storage::disk('public')->delete($relPath);
        }
    }
}
