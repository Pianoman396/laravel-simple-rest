<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class CheckRole
 * @package App\Http\Middleware
 */
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $roles = [
          'admin' => [1],
          'user' => [2,3,1]
        ];
        $roleIds = $roles[$role] ?? [];
        $roleId = auth()->guard('api')->user()->role_id ?? 999999999;
        if( !in_array($roleId, $roleIds) ) {
            abort(403);
        }

        return $next($request);
    }
}
