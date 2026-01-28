<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (!$user) {
            abort(403, 'Unauthorized.');
        }

        $allowed = array_map('strval', $roles);

        if (!in_array((string) $user->role, $allowed, true)) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
