<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $user = auth()->user();

        if (!$user->hasRole($role)) {
            alert()->warning('you not admin.','DANGER')->persistent('close');

            return redirect()->route('products.index');
        }

        return $next($request);
    }
}
