<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login
     * Jika sudah login, langsung redirect ke dashboard
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.optimal');
        }
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required'    => 'Alamat email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Catat log aktivitas login
            try {
                \App\Models\LogAktivitas::catat(
                    'Login ke sistem dari IP: ' . $request->ip(),
                    Auth::id()
                );
            } catch (\Exception $e) {
                // Abaikan jika tabel log belum ada
            }

            // Redirect ke dashboard baru
            return redirect()->intended(route('dashboard.optimal'))
                ->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
        }

        return back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'Email atau kata sandi yang Anda masukkan salah.',
            ]);
    }

    /**
     * Logout
     */
    public function logout(Request $request): RedirectResponse
    {
        // Catat log aktivitas logout
        try {
            \App\Models\LogAktivitas::catat(
                'Logout dari sistem',
                Auth::id()
            );
        } catch (\Exception $e) {
            //
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('status', 'Anda telah berhasil keluar dari sistem.');
    }
}
