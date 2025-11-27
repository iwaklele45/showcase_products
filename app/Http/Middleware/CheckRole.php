<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            Log::info('CheckRole: User not logged in');
            abort(403);
        }

        $userRole = Auth::user()->role;
        Log::info("CheckRole: User ID " . Auth::id() . " has role '{$userRole}'. Required roles: " . implode(', ', $roles));

        // Normalize role values to avoid false negatives due to casing/whitespace
        $userRole = strtolower(trim((string) Auth::user()->role));
        $normalizedRoles = array_map(fn($r) => strtolower(trim((string) $r)), $roles);

        Log::info('CheckRole: User ID ' . Auth::id() . " has role '" . $userRole . "'. Required roles: " . implode(', ', $normalizedRoles));

        if (empty($normalizedRoles) || !in_array($userRole, $normalizedRoles, true)) {
            Log::info('CheckRole: Role mismatch, aborting 403');
            abort(403);
        }

        return $next($request);
    }
}
