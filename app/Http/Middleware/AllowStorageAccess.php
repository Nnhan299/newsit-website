<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AllowStorageAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cho phép truy cập vào các file trong thư mục storage
        if (preg_match('/^\/storage\//', $request->path())) {
            return $next($request);
        }

        return response('Forbidden', 403);
    }
}