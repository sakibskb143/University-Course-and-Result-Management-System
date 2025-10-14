<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();
        if (!$user || strtolower((string)$user->role) !== strtolower((string)$role)) {
            // Redirect guests to the appropriate role-specific login page
            // so existing auth views like auth/student_login.blade.php are used
            $loginRoute = match ($role) {
                'admin' => 'admin.login',
                'teacher' => 'teacher.login',
                'student' => 'student.login',
                default => null,
            };

            if ($loginRoute) {
                return redirect()->guest(route($loginRoute));
            }

            return redirect()->guest(url('/'));
        }

        return $next($request);
    }
}


