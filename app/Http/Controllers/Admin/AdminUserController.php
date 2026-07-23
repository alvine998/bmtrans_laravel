<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminUserRequest;
use App\Http\Requests\UpdateAdminUserRequest;
use App\Models\ActivityLog;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));
        $role = $request->query('role');
        $allowedRoles = ['super_admin', 'editor'];

        $users = Admin::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($inner) use ($q) {
                    $inner->where('name', 'like', '%'.$q.'%')
                        ->orWhere('email', 'like', '%'.$q.'%');
                });
            })
            ->when(in_array($role, $allowedRoles, true), fn ($query) => $query->where('role', $role))
            ->orderByRaw("CASE role WHEN 'super_admin' THEN 0 WHEN 'editor' THEN 1 ELSE 2 END")
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'q', 'role'));
    }

    public function create(): View
    {
        return view('admin.users.form', ['admin' => new Admin(['role' => 'editor', 'is_active' => true])]);
    }

    public function store(StoreAdminUserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', true);

        $admin = Admin::create($data);

        $this->log($request, 'created', $admin, 'Buat admin '.$admin->email);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna admin dibuat.');
    }

    public function edit(Admin $admin): View
    {
        return view('admin.users.form', compact('admin'));
    }

    public function update(UpdateAdminUserRequest $request, Admin $admin): RedirectResponse
    {
        if ($this->wouldRemoveLastSuperAdmin($admin, $request)) {
            return back()->withInput()->with('error', 'Tidak bisa demote/nonaktifkan super admin terakhir.');
        }

        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', false);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $admin->update($data);

        $this->log($request, 'updated', $admin, 'Update admin '.$admin->email);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna admin diupdate.');
    }

    public function destroy(Request $request, Admin $admin): RedirectResponse
    {
        $me = Auth::guard('admin')->user();

        if ($me && $me->id === $admin->id) {
            return back()->with('error', 'Tidak bisa hapus akun sendiri.');
        }

        if ($admin->isSuperAdmin() && $this->activeSuperAdminCount() <= 1) {
            return back()->with('error', 'Tidak bisa hapus super admin terakhir.');
        }

        $email = $admin->email;
        $admin->delete();

        $this->log($request, 'deleted', null, 'Hapus admin '.$email);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna admin dihapus.');
    }

    private function wouldRemoveLastSuperAdmin(Admin $admin, Request $request): bool
    {
        if (! $admin->isSuperAdmin() || ! $admin->is_active) {
            return false;
        }

        $newRole = $request->input('role');
        $stillSuper = $newRole === 'super_admin';
        $stillActive = $request->boolean('is_active', false);

        if ($stillSuper && $stillActive) {
            return false;
        }

        return $this->activeSuperAdminCount() <= 1;
    }

    private function activeSuperAdminCount(): int
    {
        return Admin::where('role', 'super_admin')->where('is_active', true)->count();
    }

    private function log(Request $request, string $action, ?Admin $subject, string $description): void
    {
        ActivityLog::create([
            'admin_id' => Auth::guard('admin')->id(),
            'action' => $action,
            'subject_type' => $subject ? Admin::class : null,
            'subject_id' => $subject?->id,
            'description' => $description,
            'ip_address' => $request->ip(),
        ]);
    }
}
