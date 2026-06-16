<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     * Cek apakah user yang login memiliki role yang dibutuhkan.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('auth.login');
        }

        $user = auth()->user();

        // Cek is_active — jika belum diaktifkan admin, arahkan ke halaman pending
        if (!$user->is_active) {
            auth()->logout();
            return redirect()->route('auth.pending')
                ->with('info', 'Akun Anda belum diaktifkan oleh Admin.');
        }

        // Cek apakah role user ada dalam daftar role yang diizinkan
        if (!empty($roles) && !in_array($user->role, $roles)) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk halaman ini.');
        }

        return $next($request);
    }
}
