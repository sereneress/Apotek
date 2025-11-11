<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // ✅ Admin bebas akses semua halaman
        if ($user->hasRole('admin')) {
            return $next($request);
        }

        // ✅ Jika user punya salah satu role yang diperbolehkan
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        // ❌ Jika tidak cocok, log & redirect
        Log::warning("Unauthorized access by {$user->username} ({$user->id}) to {$request->path()}");

        if ($user->hasRole('apoteker')) {
            return redirect()->route('apoteker.dashboard')->with('error', 'Anda tidak punya akses ke halaman tersebut.');
        }

        if ($user->hasRole('gudang')) {
            return redirect()->route('gudang.dashboard')->with('error', 'Anda tidak punya akses ke halaman tersebut.');
        }

        return abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
