<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required','email','max:255'],
            'password' => ['required','string','min:6'],
        ]);

        $credentials = $request->only('email', 'password');
        $credentials['is_active'] = true;

        $remember = $request->boolean('remember');

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $admin = Auth::guard('admin')->user();
            $admin->last_login_at = now();
            $admin->save();

            ActivityLog::create([
                'admin_id' => $admin->id,
                'action' => 'login',
                'description' => 'Login dari IP '.$request->ip(),
                'ip_address' => $request->ip(),
            ]);

            return redirect()->intended(route('admin.dashboard'));
        }

        ActivityLog::create([
            'admin_id' => null,
            'action' => 'failed_login',
            'description' => 'Gagal login email '.$request->input('email').' dari IP '.$request->ip(),
            'ip_address' => $request->ip(),
        ]);

        throw ValidationException::withMessages([
            'email' => 'Kredensial tidak valid atau akun tidak aktif.',
        ]);
    }

    public function logout(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        if ($admin) {
            ActivityLog::create([
                'admin_id' => $admin->id,
                'action' => 'logout',
                'ip_address' => $request->ip(),
            ]);
        }
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
